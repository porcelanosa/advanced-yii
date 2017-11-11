<?php
namespace common\components\helpers;
use himiklab\thumbnail\EasyThumbnailImage;
    use Yii;
    use yii\helpers\FileHelper;
    use yii\helpers\Html;
    
    class ThumbHelper extends EasyThumbnailImage
{

	/**
	 * Creates and caches the image thumbnail and returns <img> tag.
	 *
	 * @param string $filename the image file path or path alias
	 * @param integer $width the width in pixels to create the thumbnail
	 * @param integer $height the height in pixels to create the thumbnail
	 * @param string $mode self::THUMBNAIL_INSET, the original image
	 * @param array $options options similarly with \yii\helpers\Html::img()
	 * @param integer $quality
	 * @return string
	 */
	public static function thumbnailImg($filename, $width, $height, $mode = self::THUMBNAIL_OUTBOUND, $options = [], $quality = null)
	{
		$filename = FileHelper::normalizePath(Yii::getAlias($filename));
		try {
			$thumbnailFileUrl = self::thumbnailFileUrl($filename, $width, $height, $mode);
		} catch (\Exception $e) {
			return static::errorHandler($e, $filename);
		}
		return Html::img(
			$thumbnailFileUrl,
			$options
		);
	}


	protected static function errorHandler($error, $filename)
	{
		if ($error instanceof \himiklab\thumbnail\FileNotFoundException) {
			//return \yii\helpers\Html::img('@web/img/img_not_found.gif');
			return Html::img('/img/img_not_found.svg',[ 'width' => 100, 'height' => 50]);
		} else {
			$filename = basename($filename);
			return \yii\helpers\Html::a($filename,"/files/$filename");
		}
	}
}