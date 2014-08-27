<?php 

class AccountAppModel extends AppModel{
    
	var $tablePrefix = 'account_';
        
        /**
         * Array containing the name of the in FORM and in DB
         * file: internal and form input type file var name
         * image_url: DB field name
         * @var string
         */
        public $files = array(
            'file' => 'image_url'
        );
        
        function beforeSave( $options = array() )
        {
            parent::beforeSave($options);
            $this->_uploadFile();
            return true;
        }
        
        
        
        private function _uploadFile(){
            foreach ($this->files as $dataName => $dbName) {
                 if (empty($this->request->data[$this->name][$dataName])) continue;
                if ( is_uploaded_file($this->request->data[$this->name][$dataName]['tmp_name']) )
                {
                    $path = IMAGES;
                    $newFile = $this->request->data[$this->name][$dataName];

                    $name = Inflector::slug(strstr($newFile['name'], '.', true));
                    $ext = substr(strrchr($newFile['name'], "."), 1);
                    $nameFile = $name . ".$ext";

                    if (!file_exists(IMAGES_THUMB)){
                        if (!mkdir(IMAGES_THUMB)) {
                            throw new Exception("No se pudo crear el directorio");
                        }
                    }
                    
                    if (file_exists($path . $nameFile)) {
                        $i = 1;
                        $nameFile = $name . "_$i.$ext";
                        while (file_exists($path . $nameFile)) {
                            $i++;
                            $nameFile = $name . "_$i.$ext";
                        }
                    }
                    
                    if (move_uploaded_file( $newFile['tmp_name'], $path . $nameFile)) {
                        $this->_generate_image_thumbnail($path . $nameFile, IMAGES_THUMB.$nameFile);

                        // store the filename in the array to be saved to the db
                        $this->request->data[$this->name][$dbName] = $nameFile;
                    } else {
                        throw new Exception("No se pudo copiar el archivo subido");
                    }
                } else {
                    unset($this->request->data[$this->name][$dataName]);
                }
            }
        }
        
        
        private function _generate_image_thumbnail($source_image_path, $thumbnail_image_path) {
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
                    default:
                        return false;
                }
                if ($source_gd_image === false) {
                    return false;
                }
                $source_aspect_ratio = $source_image_width / $source_image_height;
                $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
                if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
                    $thumbnail_image_width = $source_image_width;
                    $thumbnail_image_height = $source_image_height;
                } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
                    $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
                    $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
                } else {
                    $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
                    $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
                }
                $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
                imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
                imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
                imagedestroy($source_gd_image);
                imagedestroy($thumbnail_gd_image);
                return true;
            }

}
?>