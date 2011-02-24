<?php

class AclController extends AclAppController {
	var $name = 'Acl';

	var $uses = array('Acl.AclAco', 'Acl.AclAro', 'Acl.AclAroAco');

	var $helpers = array('Html', 'Javascript');

	function admin_index() {

	}

	function admin_aros() {

	}

	function admin_acos() {

	}

	function admin_permissions() {

	}

        function admin_tree() {
            //Configure::write('debug', 2);
            //$nodes = $this->AclAro->find('all', array('conditions'=>'parent_id IS NULL'));
            $acos = $this->AclAco->find('all', array(
                'order' => array('AclAco.lft')
            ));
            
            $arostree = $this->AclAro->generatetreelist(null, '{n}.AclAro.id', '{n}.AclAro.alias', "__ ");
            $acostree = $this->AclAco->generatetreelist(null, '{n}.AclAco.id', '{n}.AclAco.alias', "__ ");

            $permisos = $this->AclAroAco->find('all', array(
                'conditions' => array('AclAco.id' => array_keys($acostree)),
                'order' => array('AclAco.lft', 'AclAco.alias')
            ));

            // prepara la estructura
            foreach ($acostree as $key=>$aco) {
                $acostree_aux[$key]['Aco'] = $aco;
            }

            $acostree = $acostree_aux;

            foreach ($acostree as $key=>&$aco) {
                // carga los AROS de cada ACO                
                foreach ($permisos as $permiso) {
                    if ($permiso['AclAco']['id'] == $key) {
                        $aco['Aros'][] = $permiso['AclAro'];
                    }
                }

            }
            
            //$nodes = $this->AclAroAco->find();
            //echo $aro = $this->AclAro->getStringPath('17');

            $this->set('acos', $acos);
            $this->set('permisos', $permisos);
            $this->set('arostree', $arostree);
            $this->set('acostree', $acostree);
	}

}

?>