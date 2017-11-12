<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 11.11.2017
     * Time: 21:38
     */
    
    namespace common\components\traits;
        
        use porcelanosa\posts\components\helpers\ThumbHelper as Thumb;
        use Yii;
        use yii\helpers\FileHelper;
    
    
        trait ShowThumbTrait
        {
            /**
             *
             * @return string
             */
            public function showThumb($width, $height, $upload_folder_alias = null)
            {
                $upload_folder = ($upload_folder_alias == null) ? FileHelper::normalizePath(Yii::getAlias($this->uploadPath)) . DIRECTORY_SEPARATOR : FileHelper::normalizePath($upload_folder_alias);
                echo $upload_folder;
                if (
                    file_exists($upload_folder . $this->image)
                    AND is_file($upload_folder . $this->image)
                        AND $this->image != ''
                ) {
                    return
                        Thumb::thumbnailImg(
                            $upload_folder . $this->image,
                            $width,
                            $height,
                            Thumb::THUMBNAIL_INSET,
                            ['alt' => $this->name],
                            75
                        );
                } else {
                    return '';
                }
            }
        }