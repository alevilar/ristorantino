<?php

/*

 * Pagination Recall CakePHP Component

 * Copyright (c) 2008 Matt Curry

 * www.PseudoCoder.com

 *

 * @author      mattc <matt@pseudocoder.com>

 * @version     2.0

 * @license     MIT

 * Changed to cakephp 2.x by 

 *

 */



class PaginationRecallComponent extends Component {

    var $components = array('Session');

    var $Controller = null;



    function initialize(&$controller) {

        $this->Controller = & $controller;



        $options = array_merge($this->Controller->request->params,

                                    $this->Controller->params['url'],

                                    $this->Controller->passedArgs

                                  );

        $vars = array('page', 'sort', 'direction', 'filter');

        $keys = array_keys($options);

        $count = count($keys);



        for ($i = 0; $i < $count; $i++) {

            if (!in_array($keys[$i], $vars) || !is_string($keys[$i])) {

              unset($options[$keys[$i]]);

            }

        }

    

        //save the options into the session

        if ($options) {

            if ($this->Session->check("Pagination.{$this->Controller->modelClass}.options")) {

                $options = array_merge($this->Session->read("Pagination.{$this->Controller->modelClass}.options"), $options);

            }

      

            $this->Session->write("Pagination.{$this->Controller->modelClass}.options", $options);

        }



        //recall previous options

        if ($this->Session->check("Pagination.{$this->Controller->modelClass}.options")) {

            $options = $this->Session->read("Pagination.{$this->Controller->modelClass}.options");

            $this->Controller->passedArgs = array_merge($this->Controller->passedArgs, $options);

            $this->Controller->request->params['named'] = $options;

        }

    }

}
