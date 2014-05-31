<?php

App::import('ConnectionManager');


class InstallShell extends Shell {


    function main() {
            $path = APP_DIR . DS . 'config' . DS . 'sql' . DS . 'ristorantino_base_data.sql';
            $pathDrop = APP_DIR . DS . 'config' . DS . 'sql' . DS . 'ristorantino_drop_tables.sql';
            
            
            $db = ConnectionManager::getDataSource('default');     
            
            
            if (!$db->isConnected()) {
                $this->out("Could not connect to database.");                
             } else {
                 $pathDrop = APP_DIR . DS . 'config' . DS . 'sql' . DS . 'ristorantino_drop_tables.sql';
            
                $dropsql = new File($pathDrop);
                $dropSql = $dropsql->read();
                $arrdropSql = explode(";",$dropSql);
                
                foreach ($arrdropSql as $query) {
                    if ( !$db->rawQuery($query) ) {
                        $this->out("Error al hacer DROP de las tablas");
                        die;
                    }
                }
                

                $this->out("Se hizo DROP de todas las tablas");


                $fsql = new File($path);
                $installDBSql = $fsql->read();
                $arrinstallSql = explode(";",$installDBSql);
                foreach ($arrinstallSql as $query) {
                    if ( !$db->rawQuery($query) ) {
                        $this->out("Error al guardar");
                        die;
                    }
                }

                $this->out("se insertaron las nuevas tablas con datos");

             }
            
            

            }         
}
