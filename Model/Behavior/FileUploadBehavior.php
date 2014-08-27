<?php



class FileUploadBehavior extends ModelBehavior {
    
    static $THUMBNAIL_IMAGE_MAX_WIDTH = 150;
    static $THUMBNAIL_IMAGE_MAX_HEIGHT = 150;
    
    
    public function setup(Model $Model, $settings = array()) {
        if (!isset($this->settings[$Model->alias])) {
            $this->settings[$Model->alias] = array(
                'field' => 'image_url',
                'field_upload' => 'image_upload',
            );
        }
        $this->settings[$Model->alias] = array_merge(
                    $this->settings[$Model->alias], (array)$settings
                );
    }

    public function beforeSave(Model $Model, array $options) {
        $fileUploadName = $this->settings[$Model->alias]['field_upload'];
        $fileName = $this->settings[$Model->alias]['field'];
        if (!empty($Model->data[$Model->alias][$fileUploadName])) {

            $path = IMAGES;
            $newFile = $Model->data[$Model->alias][$fileUploadName];

            $name = Inflector::slug(strstr($newFile['name'], '.', true));
            $ext = substr(strrchr($newFile['name'], "."), 1);
            $nameFile = $name . ".$ext";

            if (file_exists($path . $nameFile)) {
                $i = 1;
                $nameFile = $name . "_$i.$ext";
                while (file_exists($path . $nameFile)) {
                    $i++;
                    $nameFile = $name . "_$i.$ext";
                }
            }

            $this->data[$this->name][$fileName] = $nameFile;
            move_uploaded_file($newFile['tmp_name'], $path . $nameFile);

            $this->generate_image_thumbnail($path . $nameFile, IMAGES_THUMB . DS . $nameFile);
        }
        return true;
    }
        
        
    private function generate_image_thumbnail($source_image_path, $thumbnail_image_path)
    {
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        if ($source_gd_image === false) {
            return false;
        }
        $source_aspect_ratio = $source_image_width / $source_image_height;
        $thumbnail_aspect_ratio = $FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_WIDTH / FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_HEIGHT;
        if ($source_image_width <= FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_HEIGHT) {
            $thumbnail_image_width = $source_image_width;
            $thumbnail_image_height = $source_image_height;
        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
            $thumbnail_image_width = (int) (FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
            $thumbnail_image_height = FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_HEIGHT;
        } else {
            $thumbnail_image_width = FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_WIDTH;
            $thumbnail_image_height = (int) (FileUploadBehavior::$THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
        }
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        return true;
    }


        
}