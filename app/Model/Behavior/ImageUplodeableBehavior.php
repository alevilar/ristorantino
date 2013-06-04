<?php

class ImageUplodeableBehavior extends ModelBehavior
{

    public $fieldName = 'image_url';

    public function check_upload_error()
    {
        if (!empty($this->data[$this->name][$this->fieldName])) {
            if ($this->data[$this->name][$this->fieldName]['error'] != UPLOAD_ERR_OK) {
                return false;
            }
        }
        return true;
    }

    public function check_folders_permisions()
    {
        $path = IMAGES . $this->imageFolderName;
        if (!is_writable($path)) {
            return false;
        }
        return true;
    }

    public function check_file()
    {
        if (!empty($this->data[$this->name][$this->fieldName])) {
            $path = IMAGES . $this->imageFolderName . '/';
            $tmpFile = $this->data[$this->name][$this->fieldName]['tmp_name'];
            $filePath = $path . $this->data[$this->name][$this->fieldName]['name'];

            if (!is_dir($path)) {
                mkdir($path, 0777);
            }
//                    
//                    if ( file_exists($filePath) ) {                  
//                        $i = 0;
//                        do {
//                            $filePath .= $i++;
//                        } while (file_exists($filePath));
//                    }

            if (!move_uploaded_file($tmpFile, $filePath)) {
                return false;
            }
        }
        return true;
    }

    public function beforeSave($options = array())
    {
        if (!empty($this->data[$this->name][$this->fieldName])) {
            $this->data[$this->name][$this->fieldName] = $this->imageFolderName . '/' . $this->data[$this->name][$this->fieldName]['name'];
        }
        return true;
    }

    /**
     * Updates validation errors if there was an error uploading the file.
     * presents the user the errors.
     */
    function beforeValidate(&$Model)
    {
        
        $Model->validationErrors[$this->options[$Model->alias]['fileVar']] = $this->Uploader[$Model->alias]->showErrors();
        
        return $Model->beforeValidate();
    }

    /**
     * Automatically remove the uploaded file.
     */
    function beforeDelete(&$Model, $cascade)
    {
        $Model->recursive = -1;
        $data = $Model->read();

        $this->Uploader[$Model->alias]->removeFile($data[$Model->alias][$this->options[$Model->alias]['fields']['name']]);
        return $Model->beforeDelete($cascade);
    }

}