'use strict'
var pathPlugin = require('path')
var gulp = require('gulp'),
	watch = require('gulp-watch'),
	prefixer = require('gulp-autoprefixer'),
	uglify = require('gulp-uglify'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	rename = require('gulp-rename'),
	concat = require('gulp-concat'),
	rigger = require('gulp-rigger'),
	cleanCSS = require('gulp-clean-css'),
	imagemin = require('gulp-imagemin'),
	pngquant = require('imagemin-pngquant'),
	svgSymbols = require('gulp-svg-symbols'),
	svgmin = require('gulp-svgmin'),
	rimraf = require('rimraf'),
	browserSync = require('browser-sync'),
	gutil = require('gulp-util'),
	plumber = require('gulp-plumber'),
	notify = require('gulp-notify'),
	reload = browserSync.reload

var path = {
	build: {
		html: 'build/',
		js: 'frontend/web/js/',
		css: 'frontend/web/css/',
		admin_css: 'backend/web/css/',
		img: 'build/img/',
		svgicons: 'frontend/web/img/icons/sprite',
		fonts: 'build/fonts/'
	},
	src: {
		html: 'src/*.html',
		js: 'frontend/web/js/src/**/*.js',
		style: 'frontend/web/css/scss/site.scss',
		admin_style: 'backend/web/css/scss/admin.scss',
		img: 'src/img/**/*.*',
		fonts: 'src/fonts/**/*.*',
		svgicons: 'frontend/web/img/icons/*.svg',
		other: ['src/.htacces']
	},
	watch: {
		html: 'src/**/*.html',
		js: 'frontend/web/js/src/**/*.js',
		style: 'frontend/web/css/scss/**/*.scss',
		admin_style: 'backend/web/css/scss/**/*',
		img: 'src/img/**/*.*',
		svgicons: 'frontend/web/img/icons/*.svg',
		fonts: 'src/fonts/**/*.*'
	},
	clean: './build'
}

var config = {
	server: {
		baseDir: './build'
	},
	tunnel: true,
	host: 'localhost',
	port: 9000,
	logPrefix: 'Frontend_Devil'
}

gulp.task('webserver', function () {
	browserSync(config)
})

gulp.task('clean', function (cb) {
	rimraf(path.clean, cb)
})

gulp.task('html:build', function () {
	gulp.src(path.src.html)
		.pipe(rigger())
		.pipe(gulp.dest(path.build.html))
		.pipe(reload({stream: true}))
})

gulp.task('other:copy', function () {
	gulp.src(path.src.other)
		.pipe(gulp.dest(path.build.html))
})
gulp.task('js:build', function () {
	gulp.src(path.src.js)
		.pipe(rigger())
		.pipe(sourcemaps.init())
		.pipe(uglify())
		.pipe(concat('all.js'))
		/*.pipe(rename({
		 suffix: '.min'
		 }))*/
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(path.build.js))
		.pipe(reload({stream: true}))
})

gulp.task('style:build', function () {
	gulp.src(path.src.style)
		.pipe(plumber({
			errorHandler: function (err) {
				notify.onError({
					title: 'Gulp error in ' + err.plugin,
					message: err.toString()
				})(err)
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass({
			includePaths: ['frontend/web/css/', pathPlugin.join(__dirname, '/vendor/twbs/bootstrap/dist/scss/')],
			outputStyle: 'compressed',
			sourceMap: false,
			errLogToConsole: true
		}))
		.pipe(prefixer())
		.pipe(cleanCSS({level:2}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(path.build.css))
		.pipe(reload({stream: true}))
})

gulp.task('admin_style:build', function () {
	gulp.src(path.src.admin_style)
		.pipe(sourcemaps.init())
		.pipe(sass({
			//includePaths: ['backend/web/static/css/'],
			outputStyle: 'compressed',
			sourceMap: false,
			errLogToConsole: true
		}))
		.pipe(prefixer())
		.pipe(cleanCSS())
		.pipe(rename('admin.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(path.build.admin_css))
})

gulp.task('image:build', function () {
	gulp.src(path.src.img)
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: true}],
			use: [pngquant()],
			interlaced: true
		}))
		.pipe(gulp.dest(path.build.img))
		.pipe(reload({stream: true}))
})
gulp.task('svgsprites', function () {
	return gulp.src(path.src.svgicons)
		.pipe(svgmin())
		.pipe(svgSymbols(
			{
				slug: function (name) {
					return 'svgicon-'+name.replace(/\s/g, '-')
				},
				svgClassname: 'svg-icon-lib',
			}
		))
		.pipe(gulp.dest(path.build.svgicons))
})
gulp.task('fonts:build', function () {
	gulp.src(path.src.fonts)
		.pipe(gulp.dest(path.build.fonts))
})

gulp.task('build', [
	'html:build',
	'js:build',
	'style:build',
	'fonts:build',
	'image:build'
])

gulp.task('watch', function () {
	/*watch([path.watch.html], function(event, cb) {
	 gulp.start('html:build');
	 });*/
	watch([path.watch.style], function (event, cb) {
		gulp.start('style:build')
	})
	watch([path.watch.admin_style], function (event, cb) {
		gulp.start('admin_style:build')
	})
	watch([path.watch.js], function (event, cb) {
		gulp.start('js:build')
	})
	/*watch([path.watch.img], function(event, cb) {
	 gulp.start('image:build');
	 });
	 watch([path.watch.fonts], function(event, cb) {
	 gulp.start('fonts:build');
	 });*/
})

//gulp.task('default', ['build', 'webserver', 'watch']);
gulp.task('default', ['watch'])
