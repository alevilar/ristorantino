<?php
/**
 * Jqm Helper class file.
 *
 * Simplifies the construction of Jqeury Mobile elements.
 *
 * 
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author        Alejandro Vilar
 * @link          http://www.alevilar.com.ar/jqm_helper
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Jqm Helper class for easy use of Jquery Mobile widgets.
 * http://jquerymobile.com/
 *
 * JqmHelper encloses all methods needed while working with http://jquerymobile.com/
 *
 * @package       App.View.Helper
 */
class JqmHelper extends AppHelper {
    
/**
 * Other helpers used by JqmHelper
 *
 * @var array
 */
	public $helpers = array('Html', 'Form');
    
    /**
     * implements http://jquerymobile.com/test/docs/lists/docs-lists.html
     * With the array of links given, it buils a listview data-role
     * The list must be compatible with an array argument
     * for example:
     *   array(
     *      'title' => 'a pretty title', 
     *      'url' = array('controller' => 'post', 'action' => 'index' )
     *   )
     * 
     * @param type $list array
     */
    public function listview( $list , $ops = array()) {
        $output = '';
        foreach ($list as $l ) {
            $link = call_user_func_array(array($this->Html, 'link'), $l);            
            $output .= $this->Html->tag('li', $link);
        }
        
        $ops = array_merge($ops, array('data-role'=> 'listview'));
        return $this->Html->tag('ul', $output, $ops);
    }
    
    
    public function makeCollapsible($output) {
        return $this->Html->tag('div', $output, array( 'data-role'=>"collapsible"));
    }   
    
 
    
/**
 * You must pass same params  as for $Form->radio method
 * http://jquerymobile.com/test/docs/forms/radiobuttons/
 * @return type 
 * 
 */    
    public function horizontalRadio() {
        $output = call_user_func_array(array($this->Form, 'radio'), func_get_args() );          

        $output = $this->Html->tag('fieldset', $output, array('data-role'=> 'controlgroup', 'data-type' => 'horizontal'));
        return $this->Html->tag('div', $output, array( 'data-role'=>"fieldcontain"));
    }
    
    
    public function datepicker($field, $ops = array() ){
        $ops['data-role'] = 'calbox';
        
        if (empty($ops['class'])) {
            $ops['class'] = '';
        }
        $ops['class'] .= 'datepicker';
        
        return $this->input($field, $ops);
    }        
    
    public function month($field, $ops = array() ){
        $ops['options'] = array(
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        );
        
        return $this->Form->input($field, $ops);
    }
    
    
    public function image($field, $ops = array() ){
        
        
    }
        
}