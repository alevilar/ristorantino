<?php 

class AccountAppModel extends AppModel{
	var $tablePrefix = 'account_';
        
        
        function beforeSave( $options = array() )
        {
            if ( is_uploaded_file($this->data[$this->name]['file']['tmp_name']) )
            {
                
                $filename_real = $this->data[$this->name]['file']['name'];
              
                $i = 0;
                $filename = $filename_real;
                while ( file_exists( IMAGES . $filename ) ) {
                    $filename = "$i.".$filename_real;
                    $i++;
                }
                     
                move_uploaded_file(
                    $this->data[$this->name]['file']['tmp_name'],
                    IMAGES . $filename
                );

                // store the filename in the array to be saved to the db
                $this->data[$this->name]['file'] = $filename;
            } else {
                unset($this->data[$this->name]['file']);
            }
            return true;
        }
}
?>