<?php
/*
 * Created on Mar 22, 2009
 *
 * @Author Eddie Webb
 * @Modified Pablo Alpha
 *
 * Set up basic ACL tables based on existing users
 * based on my readings of the book at cakephp.org
 *
*/
class AclprepController extends AppController {

    var $name = 'Aclprep';
    var $uses =array('User');
    var $components =array('Acl');

    // comentar una vez corridos los scripts por primera vez
    function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('*');
    }

    function buildAcos() {
        Configure::write('debug',1);
        if (!Configure::read('debug')) {
            return $this->_stop();
        }
        $log = array();

        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id;
            $log[] = 'Created Aco node for controllers';
        } else {
            $root = $root[0];
        }

        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';

        $Plugins = $this->_getPluginControllerNames();
        $Controllers = array_merge($Controllers, $Plugins);

        // look at each controller in app/controllers
        foreach ($Controllers as $ctrlName) {
            $methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

            // Do all Plugins First
            if ($this->_isPlugin($ctrlName)) {
                $pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
                if (!$pluginNode) {
                    $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
                    $pluginNode = $aco->save();
                    $pluginNode['Aco']['id'] = $aco->id;
                    $log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
                }
            }
            // find / make controller node
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                if ($this->_isPlugin($ctrlName)) {
                    $pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
                    $aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
                    $controllerNode = $aco->save();
                    $controllerNode['Aco']['id'] = $aco->id;
                    $log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
                } else {
                    $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                    $controllerNode = $aco->save();
                    $controllerNode['Aco']['id'] = $aco->id;
                    $log[] = 'Created Aco node for ' . $ctrlName;
                }
            } else {
                $controllerNode = $controllerNode[0];
            }

            //clean the methods. to remove those in Controller and private actions.
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Created Aco node for '. $method;
                }
            }
        }
        if(count($log)>0) {
            debug($log);
        }
    }

    function _getClassMethods($ctrlName = null) {
        App::import('Controller', $ctrlName);
        if (strlen(strstr($ctrlName, '.')) > 0) {
            // plugin's controller
            $num = strpos($ctrlName, '.');
            $ctrlName = substr($ctrlName, $num+1);
        }
        $ctrlclass = $ctrlName . 'Controller';
        $methods = get_class_methods($ctrlclass);

        // Add scaffold defaults if scaffolds are being used
        $properties = get_class_vars($ctrlclass);
        if (array_key_exists('scaffold',$properties)) {
            if($properties['scaffold'] == 'admin') {
                $methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
            } else {
                $methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
            }
        }
        return $methods;
    }

    function _isPlugin($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) > 1) {
            return true;
        } else {
            return false;
        }
    }

    function _getPluginControllerPath($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) == 2) {
            return $arr[0] . '.' . $arr[1];
        } else {
            return $arr[0];
        }
    }

    function _getPluginName($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) == 2) {
            return $arr[0];
        } else {
            return false;
        }
    }

    function _getPluginControllerName($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) == 2) {
            return $arr[1];
        } else {
            return false;
        }
    }

    /**
     * Get the names of the plugin controllers ...
     *
     * This function will get an array of the plugin controller names, and
     * also makes sure the controllers are available for us to get the
     * method names by doing an App::import for each plugin controller.
     *
     * @return array of plugin names.
     *
     */
    function _getPluginControllerNames() {
        App::import('Core', 'File', 'Folder');
        $paths = Configure::getInstance();
        $folder =& new Folder();
        $folder->cd(APP . 'plugins');

        // Get the list of plugins
        $Plugins = $folder->read();
        $Plugins = $Plugins[0];
        $arr = array();

        // Loop through the plugins
        foreach($Plugins as $pluginName) {
            // Change directory to the plugin
            $didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
            // Get a list of the files that have a file name that ends
            // with controller.php
            $files = $folder->findRecursive('.*_controller\.php');

            // Loop through the controllers we found in the plugins directory
            foreach($files as $fileName) {
                // Get the base file name
                $file = basename($fileName);

                // Get the controller name
                $file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
                if (strpos($pluginName, '.svn') === false && strpos($file, '.svn') === false) {
                    if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
                        if (!App::import('Controller', $pluginName.'.'.$file)) {
                            debug('Error importing '.$file.' for plugin '.$pluginName);
                        } else {
                            /// Now prepend the Plugin name ...
                            // This is required to allow us to fetch the method names.
                            $arr[] = Inflector::humanize($pluginName) . "/" . $file;
                        }
                    }
                }
            }
        }
        return $arr;
    }

    function buildAros() {
        //FIRST
        /*
     * creat tables by running cake schema run create DbAcl
        */



        /*
     * Define our main user groups, to keep it simpel i have users and admins
        */
        //always declare an Aro object to create and save
        $aro = new Aro();

        //iterate through groups adding to aro table
        $groups = array(
                1 => array(
                        'alias' => 'usuarios'
                ),
                2 => array(
                        'alias' => 'desarrolladores',
                        'parent_id' => '1'
                ),
                3 => array(
                        'alias' => 'administradores',
                        'parent_id' => '1'
                ),
                4 => array(
                        'alias' => 'editores',
                        'parent_id' => '1'
                ),
                5 => array(
                        'alias' => 'invitados',
                        'parent_id' => '1'
                ),
                6 => array(
                        'alias' => 'referentes',
                        'parent_id' => '1'
                ),
        );

        //Iterate and create ARO groups
        foreach($groups as $data) {
            //Remember to call create() when saving in loops...
            $aro->create();

            //Save data
            $aro->save($data);
        }


        /*
     * next we add our existing add users to users group
     * ! adds all users to user group, you may add some logic to
     * ! detemrine admins based on role, or edit manually later
     *
     * the   **whos**
        */


        $aro = new Aro();


        //pull users form existing user table
        $this->User->recursive = 0;
        $users=$this->User->find('all');

        //debug($users);


        $i=0;
        foreach($users as $user) {
            $parent_id='';
            switch ($user['User']['role']) {
                case 'desarrollo':      { $parent_id = 2; break; }
                case 'admin':           { $parent_id = 3; break; }
                case 'editor':          { $parent_id = 4; break; }
                case 'invitado':        { $parent_id = 5; break; }
                case 'referente':       { $parent_id = 6; break; }
                default:                { $parent_id = 5; }
            }

            $aroList[$i++]=
                    array(
                    'alias' => $user['User']['username'],
                    'parent_id' => $parent_id,
                    'model' => 'User',
                    'foreign_key' => $user['User']['id'],
            );
        }

        //print to screen to verify layout
        debug($aroList);



        //now save!
        foreach($aroList as $data) {
            //Remember to call create() when saving in loops...
            $aro->create();

            //Save data
            $aro->save($data);
        }
    }

    function assignPermissions() {
        // Desarrolladores
        $this->Acl->allow('desarrolladores', 'controllers');

        // Administradores
        // modificado 15/09/2010 administradores pasan a usar ALLOWS
        /*$this->Acl->allow('administradores', 'controllers');
        $this->Acl->deny('administradores',  'Fondos/index');
        $this->Acl->deny('administradores',  'FondoTemporales');
        $this->Acl->deny('administradores',  'Users/add');
        $this->Acl->deny('administradores',  'Users/edit');
        $this->Acl->deny('administradores',  'Users/delete');
        $this->Acl->deny('administradores',  'Acl');
        $this->Acl->deny('administradores',  'Aclprep');*/
        //$this->Acl->deny('desarrolladores/avilar',   'Fondos/index_x_instit');


        // Editores
        $this->Acl->allow('editores', 'Instits/add');
        $this->Acl->allow('editores', 'Instits/edit');
        $this->Acl->allow('editores', 'Instits/planes_relacionados');
        $this->Acl->allow('editores', 'Instits/depurar');
        $this->Acl->allow('editores', 'Planes/add');
        $this->Acl->allow('editores', 'Planes/edit');
        $this->Acl->allow('editores', 'Planes/delete');
        $this->Acl->allow('editores', 'Anios/add');
        $this->Acl->allow('editores', 'Anios/edit');
        $this->Acl->allow('editores', 'Anios/delete');
        $this->Acl->allow('editores', 'Queries/descargar_queries');
        $this->Acl->allow('editores', 'Queries/contruye_excel');
        $this->Acl->allow('editores', 'Queries/list_view');
        $this->Acl->allow('editores', 'Depuradores');
        $this->Acl->allow('editores', 'Sectores');
        $this->Acl->allow('editores', 'Tickets/add');
        $this->Acl->allow('editores', 'Tickets/edit');
        $this->Acl->allow('editores', 'Tickets/provincias_pendientes');
        $this->Acl->allow('editores', 'Titulos');

        // invitados;

        // referentes
        //$this->Acl->deny('referentes', 'Tickets/view');


        // todos
        $this->Acl->allow('usuarios', 'Instits/search');
        $this->Acl->allow('usuarios', 'Instits/ajax_search');
        $this->Acl->allow('usuarios', 'Instits/search_form');
        $this->Acl->allow('usuarios', 'Instits/old_search_form');
        $this->Acl->allow('usuarios', 'Instits/advanced_search_form');
        $this->Acl->allow('usuarios', 'Instits/view');
        $this->Acl->allow('usuarios', 'Planes/index');
        $this->Acl->allow('usuarios', 'Planes/view');
        $this->Acl->allow('usuarios', 'HistorialCues/search_form');
        $this->Acl->allow('usuarios', 'HistorialCues/search');
        $this->Acl->allow('usuarios', 'Tickets/index');
        $this->Acl->allow('usuarios', 'Tickets/view');
        $this->Acl->allow('usuarios', 'Users/cambiar_password');
        $this->Acl->allow('usuarios', 'Users/self_user_edit');
        $this->Acl->allow('usuarios', 'Fondos/index_x_instit');
        $this->Acl->allow('usuarios', 'Fondos/index_x_jurisdiccion');
        $this->Acl->allow('usuarios', 'Cuadros');
        $this->Acl->allow('usuarios', 'Ciclos/dame_ciclos');
        $this->Acl->allow('usuarios', 'Etapas/dame_nombre');
        $this->Acl->allow('usuarios', 'Jurisdicciones/get_name');
        $this->Acl->allow('usuarios', 'Jurisdicciones/listado');
        $this->Acl->allow('usuarios', 'Jurisdicciones/view');
        $this->Acl->allow('usuarios', 'Ofertas/dame_nombre');
        $this->Acl->allow('usuarios', 'Ofertas/dame_abrev');
        $this->Acl->allow('usuarios', 'Tipodocs/tipodoc_nombre');
        $this->Acl->allow('usuarios', 'Tipodocs/dame_tipodocs');
        $this->Acl->allow('usuarios', 'Tipoinstits/get_name');
        $this->Acl->allow('usuarios', 'Tipoinstits/ajax_select_form_por_jurisdiccion');
        $this->Acl->allow('usuarios', 'Departamentos/ajax_select_departamento_form_por_jurisdiccion');
        $this->Acl->allow('usuarios', 'Localidades/ajax_select_localidades_form_por_departamento');
        $this->Acl->allow('usuarios', 'Localidades/ajax_select_localidades_form_por_jurisdiccion');
        $this->Acl->allow('usuarios', 'Localidades/ajax_search_localidades');
        $this->Acl->allow('usuarios', 'Subsectores/ajax_select_subsector_form_por_sector');
        $this->Acl->allow('usuarios', 'Titulos/add_and_give_me_select_options');



        
        //$this->Acl->deny('warriors/Gimli',   'Weapons', 'delete');
        //$this->Acl->deny(array('model' => 'User', 'foreign_key' => 1564), 'Weapons', 'delete');

        //give users right to create and read main models
        //updates and deletes are set at a user level (so only owners can edit or delete their items)

        //$this->Acl->allow('users', 'Main_Models','create');
        //$this->Acl->allow('users', 'Main_Models','read');

        //let them use (read) aux, but nothing else!
        //$this->Acl->allow('users', 'Aux_Models','read');

        die('done');
    }

    function assignPermissions1Dot6() {

        // Administradores
        // modificado 15/09/2010 administradores pasan a usar ALLOWS
        /*$this->Acl->deny('administradores',  'Sugerencias/index');
        $this->Acl->deny('administradores',  'Sugerencias/view');
        $this->Acl->deny('administradores',  'Sugerencias/edit');
        $this->Acl->deny('administradores',  'Sugerencias/delete');
        $this->Acl->deny('administradores',  'EstructuraPlanes/add');
        $this->Acl->deny('administradores',  'EstructuraPlanes/edit');
        $this->Acl->deny('administradores',  'EstructuraPlanes/delete');
        $this->Acl->deny('administradores',  'JurisdiccionesEstructuraPlanes');*/
        // Administradores
        $this->Acl->allow('administradores', 'Instits/add');
        $this->Acl->allow('administradores', 'Instits/edit');
        $this->Acl->allow('administradores', 'Instits/planes_relacionados');
        $this->Acl->allow('administradores', 'Instits/depurar');
        $this->Acl->allow('administradores', 'Planes/add');
        $this->Acl->allow('administradores', 'Planes/edit');
        $this->Acl->allow('administradores', 'Planes/delete');
        $this->Acl->allow('administradores', 'Anios/add');
        $this->Acl->allow('administradores', 'Anios/edit');
        $this->Acl->allow('administradores', 'Anios/delete');
        $this->Acl->allow('administradores', 'Queries');
        $this->Acl->allow('administradores', 'Depuradores');
        $this->Acl->allow('administradores', 'Sectores');
        $this->Acl->allow('administradores', 'Tickets/add');
        $this->Acl->allow('administradores', 'Tickets/edit');
        $this->Acl->allow('administradores', 'Tickets/provincias_pendientes');
        $this->Acl->allow('administradores', 'Titulos');
        $this->Acl->allow('administradores', 'Users/listadoUsuarios');
        $this->Acl->allow('administradores', 'Ofertas');
        $this->Acl->allow('administradores', 'Ciclos');
        $this->Acl->allow('administradores', 'Dependencias');
        $this->Acl->allow('administradores', 'Etapas');
        $this->Acl->allow('administradores', 'Tipoinstits');
        $this->Acl->allow('administradores', 'Jurisdicciones');
        $this->Acl->allow('administradores', 'Departamentos');
        $this->Acl->allow('administradores', 'Localidades');
        $this->Acl->allow('administradores', 'Sectores');
        $this->Acl->allow('administradores', 'Subsectores');
        $this->Acl->allow('administradores', 'Orientaciones');
        $this->Acl->allow('administradores', 'EtpEstados');
        $this->Acl->allow('administradores', 'Claseinstits');

        $this->Acl->allow('administradores', 'Anios/save');
        $this->Acl->allow('administradores', 'Anios/saveAll');
        $this->Acl->allow('administradores', 'Anios/edit');
        $this->Acl->allow('administradores', 'Anios/editCiclo');
        $this->Acl->allow('administradores', 'Anios/deleteCiclo');
        $this->Acl->allow('administradores', 'Planes/edit');
        $this->Acl->allow('administradores', 'DepuradorPlanes');

        // Editores
        $this->Acl->allow('editores', 'Anios/save');
        $this->Acl->allow('editores', 'Anios/saveAll');
        $this->Acl->allow('editores', 'Anios/edit');
        $this->Acl->allow('editores', 'Anios/editCiclo');
        $this->Acl->allow('editores', 'Anios/deleteCiclo');
        $this->Acl->allow('editores', 'Planes/edit');
        $this->Acl->allow('editores', 'DepuradorPlanes');

        // todos
        $this->Acl->allow('usuarios', 'Sugerencias/add');
        $this->Acl->allow('usuarios', 'Instits/ajax_search');
        $this->Acl->allow('usuarios', 'Instits/search_form');
        $this->Acl->allow('usuarios', 'Instits/old_search_form');

        die('done 1.6');
    }

    function assignPermissions1Dot6Dot2() {

        // Administradores
        echo 'administradores => Anios/addSecTec<br />';
        $this->Acl->allow('administradores', 'Anios/addSecTec');

        // Editores
        echo 'editores => Anios/addSecTec<br />';
        $this->Acl->allow('editores', 'Anios/addSecTec');

        die('done 1.6.2');
    }

    function assignPermissions1Dot6Dot3() {
        // Usuarios
        $this->Acl->allow('usuarios', 'Planes/view_fp');
        $this->Acl->allow('usuarios', 'Planes/view_it_sec_sup');
        $this->Acl->allow('usuarios', 'Planes/index_clasico');

        die('done 1.6.3');
    }

    function assignPermissions1Dot6Dot4() {
        // Administradores
        $this->Acl->allow('administradores', 'Titulos/corrector_de_planes');
        $this->Acl->allow('administradores', 'Titulos/fusionar');
        // Usuarios
        $this->Acl->allow('usuarios', 'Subsectores/getSubSectoresBySector');
        $this->Acl->allow('usuarios', 'Titulos/ajax_index_search');
        $this->Acl->allow('usuarios', 'Titulos/ajax_search');
        $this->Acl->allow('usuarios', 'Titulos/ajax_similars');

        die('done 1.6.4');
    }

    function checkPermissions() {
        //These all return true:
        echo $this->Acl->check('administrators', 'Settings');
        echo $this->Acl->check('users', 'Items','create');
        echo $this->Acl->check('users', 'Actions','read');

        //Remember, we can use the model/foreign key syntax
        //for our user AROs
        // think can <User/Model> <x> access <Model> ,<action>
        // can    User   2356    acsess   Weapons
        //$this->Acl->check(array('model' => 'User', 'foreign_key' => 2356), 'Weapons');

        echo 'and dissallows...';

        //But these return false:
//users can not delete or edit auxilary models (inherited)
        echo $this->Acl->check('users', 'Actions', 'delete');
        echo $this->Acl->check('users', 'Actions', 'create');
//nor can they edit or delete main models (until we assign that on an individual basis)
        echo $this->Acl->check('users', 'Items', 'delete');
        echo $this->Acl->check('users', 'Items', 'update');
        die('done');
    }
}
?>