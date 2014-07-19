<?php

 App::uses('FormHelper', 'View/Helper');


class PxFormHelper extends FormHelper {



/**
 * Generates an input element
 *
 * @param array $args The options for the input element
 * @return string The generated input element
 */
	protected function _getInput($args) {
		
		extract($args);
		switch ($type) {
			case 'hidden':
				return $this->hidden($fieldName, $options);
			case 'checkbox':
				return $this->checkbox($fieldName, $options);
			case 'radio':
				return $this->radio($fieldName, $radioOptions, $options);
			case 'file':
				if ( empty($options['class']) ){
                	$options['class'] = 'form-control';
                }
				return $this->file($fieldName, $options);
			case 'select':
				$options += array('options' => array(), 'value' => $selected);
				$list = $options['options'];				
				unset($options['options']);
				if ( empty($options['class']) ){
                	$options['class'] = 'form-control';
                }
				return $this->select($fieldName, $list, $options);
			case 'time':
				// $options['value'] = $selected;
				// return $this->dateTime($fieldName, null, $timeFormat, $options);

				if ( empty($options['class']) ){
                    $options['class'] = 'form-control';
                }
                $options['data-format'] = "hh:mm:ss";
            	$options['class'] .= ' datetimepicker';

                return $this->text($fieldName, $options);

			case 'date':
				// $options['value'] = $selected;
				// return $this->dateTime($fieldName, $dateFormat, null, $options);

				if ( empty($options['class']) ){
                    $options['class'] = 'form-control';
                }
                $options['data-format'] = "yyyy-MM-dd";
	            $options['class'] .= ' datetimepicker';
                return $this->text($fieldName, $options);

			case 'datetime':
				// $options['value'] = $selected;
				// return $this->dateTime($fieldName, $dateFormat, $timeFormat, $options);
                

                if ( empty($options['class']) ){
                    $options['class'] = 'form-control';
                }
                $options['data-format'] = "yyyy-MM-dd hh:mm:ss";
	            $options['class'] .= ' datetimepicker';

	            return $this->text($fieldName, $options);

			case 'textarea':

				if ( empty($options['class']) ){
                    $options['class'] = 'form-control';
                }				

				return $this->textarea($fieldName, $options + array('cols' => '30', 'rows' => '6'));
			case 'url':
				return $this->text($fieldName, array('type' => 'url') + $options);

			default:
				if ( empty($options['class']) ){
                	$options['class'] = 'form-control';
                }
				return $this->{$type}($fieldName, $options);
		}
	}
}