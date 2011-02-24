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
class AclScriptsController extends AclAppController {

    var $name = 'AclScripts';
    var $uses =array('User');
    var $components =array('Acl');

    // comentar una vez corridos los scripts por primera vez
    function beforeFilter() {
        parent::beforeFilter();
    }

    
}
?>