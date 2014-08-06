<?php 
# app/views/helpers/html5_form.php
App::import('Helper', 'Form');
class Html5FormHelper extends FormHelper {
    /**
     * Generates a form input element complete with label and wrapper div
     *
     * Options - See each field type method for more information. Any options that are part of 
     * $attributes or $options for the different type methods can be included in $options for input().
     *
     * - 'type' - Force the type of widget you want. e.g. ```type => 'select'```
     * - 'label' - control the label
     * - 'div' - control the wrapping div element
     * - 'options' - for widgets that take options e.g. radio, select
     * - 'error' - control the error message that is produced
     *
     * @param string $fieldName This should be "Modelname.fieldname"
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget
     *
     * different from regular form helper only in the textarea/default case -- adds support for HTML5 form types and attributes like placeholder
     *
     */
    function input($fieldName, $options = array()) {
        $view =& ClassRegistry::getObject('view');
        $this->setEntity($fieldName);
        $entity = join('.', $view->entity());
 
        $defaults = array('before' => null, 'between' => null, 'after' => null);
        $options = array_merge($defaults, $options);
 
        if (!isset($options['type'])) {
            $options['type'] = 'text';
 
            if (isset($options['options'])) {
                $options['type'] = 'select';
            } elseif (in_array($this->field(), array('psword', 'passwd', 'password'))) {
                $options['type'] = 'password';
            } elseif (isset($this->fieldset['fields'][$entity])) {
                $fieldDef = $this->fieldset['fields'][$entity];
                $type = $fieldDef['type'];
                $primaryKey = $this->fieldset['key'];
            } elseif (ClassRegistry::isKeySet($this->model())) {
                $model =& ClassRegistry::getObject($this->model());
                $type = $model->getColumnType($this->field());
                $fieldDef = $model->schema();
 
                if (isset($fieldDef[$this->field()])) {
                    $fieldDef = $fieldDef[$this->field()];
                } else {
                    $fieldDef = array();
                }
                $primaryKey = $model->primaryKey;
            }
 
            if (isset($type)) {
                $map = array(
                    'string'  => 'text',     'datetime'  => 'datetime',
                    'boolean' => 'checkbox', 'timestamp' => 'datetime',
                    'text'    => 'textarea', 'time'      => 'time',
                    'date'    => 'date',     'float'     => 'text'
                );
 
                if (isset($this->map[$type])) {
                    $options['type'] = $this->map[$type];
                } elseif (isset($map[$type])) {
                    $options['type'] = $map[$type];
                }
                if ($this->field() == $primaryKey) {
                    $options['type'] = 'hidden';
                }
            }
 
            if ($this->model() === $this->field()) {
                $options['type'] = 'select';
                if (!isset($options['multiple'])) {
                    $options['multiple'] = 'multiple';
                }
            }
        }
        $types = array('text', 'checkbox', 'radio', 'select');
 
        if (!isset($options['options']) && in_array($options['type'], $types)) {
            $view =& ClassRegistry::getObject('view');
            $varName = Inflector::variable(
                Inflector::pluralize(preg_replace('/_id$/', '', $this->field()))
            );
            $varOptions = $view->getVar($varName);
            if (is_array($varOptions)) {
                if ($options['type'] !== 'radio') {
                    $options['type'] = 'select';
                }
                $options['options'] = $varOptions;
            }
        }
 
        $autoLength = (!array_key_exists('maxlength', $options) && isset($fieldDef['length']));
        if ($autoLength && $options['type'] == 'text') {
            $options['maxlength'] = $fieldDef['length'];
        }
        if ($autoLength && $fieldDef['type'] == 'float') {
            $options['maxlength'] = array_sum(explode(',', $fieldDef['length']))+1;
        }
 
        $out = '';
        $div = true;
        $divOptions = array();
 
        if (array_key_exists('div', $options)) {
            $div = $options['div'];
            unset($options['div']);
        }
 
        if (!empty($div)) {
            $divOptions['class'] = 'input';
            $divOptions = $this->addClass($divOptions, $options['type']);
            if (is_string($div)) {
                $divOptions['class'] = $div;
            } elseif (is_array($div)) {
                $divOptions = array_merge($divOptions, $div);
            }
            if (in_array($this->field(), $this->fieldset['validates'])) {
                $divOptions = $this->addClass($divOptions, 'required');
            }
            if (!isset($divOptions['tag'])) {
                $divOptions['tag'] = 'div';
            }
        }
 
        $label = null;
        if (isset($options['label']) && $options['type'] !== 'radio') {
            $label = $options['label'];
            unset($options['label']);
        }
 
        if ($options['type'] === 'radio') {
            $label = false;
            if (isset($options['options'])) {
                if (is_array($options['options'])) {
                    $radioOptions = $options['options'];
                } else {
                    $radioOptions = array($options['options']);
                }
                unset($options['options']);
            }
        }
 
        if ($label !== false) {
            $labelAttributes = $this->domId(array(), 'for');
            if (in_array($options['type'], array('date', 'datetime'))) {
                $labelAttributes['for'] .= 'Month';
            } else if ($options['type'] === 'time') {
                $labelAttributes['for'] .= 'Hour';
            }
 
            if (is_array($label)) {
                $labelText = null;
                if (isset($label['text'])) {
                    $labelText = $label['text'];
                    unset($label['text']);
                }
                $labelAttributes = array_merge($labelAttributes, $label);
            } else {
                $labelText = $label;
            }
 
            if (isset($options['id'])) {
                $labelAttributes = array_merge($labelAttributes, array('for' => $options['id']));
            }
            $out = $this->label($fieldName, $labelText, $labelAttributes);
        }
 
        $error = null;
        if (isset($options['error'])) {
            $error = $options['error'];
            unset($options['error']);
        }
 
        $selected = null;
        if (array_key_exists('selected', $options)) {
            $selected = $options['selected'];
            unset($options['selected']);
        }
        if (isset($options['rows']) || isset($options['cols'])) {
            $options['type'] = 'textarea';
        }
 
        $empty = false;
        if (isset($options['empty'])) {
            $empty = $options['empty'];
            unset($options['empty']);
        }
 
        $timeFormat = 12;
        if (isset($options['timeFormat'])) {
            $timeFormat = $options['timeFormat'];
            unset($options['timeFormat']);
        }
 
        $dateFormat = 'MDY';
        if (isset($options['dateFormat'])) {
            $dateFormat = $options['dateFormat'];
            unset($options['dateFormat']);
        }
 
        $type     = $options['type'];
        $before     = $options['before'];
        $between = $options['between'];
        $after     = $options['after'];
        unset($options['type'], $options['before'], $options['between'], $options['after']);
 
        switch ($type) {
            case 'hidden':
                $out = $this->hidden($fieldName, $options);
                unset($divOptions);
            break;
            case 'checkbox':
                $out = $before . $this->checkbox($fieldName, $options) . $between . $out;
            break;
            case 'radio':
                $out = $before . $out . $this->radio($fieldName, $radioOptions, $options) . $between;
            break;
            case 'text':
            case 'password':
                $out = $before . $out . $between . $this->{$type}($fieldName, $options);
            break;
            case 'file':
                $out = $before . $out . $between . $this->file($fieldName, $options);
            break;
            case 'select':
                $options = array_merge(array('options' => array()), $options);
                $list = $options['options'];
                unset($options['options']);
                $out = $before . $out . $between . $this->select(
                    $fieldName, $list, $selected, $options, $empty
                );
            break;
            case 'time':
                $out = $before . $out . $between . $this->dateTime(
                    $fieldName, null, $timeFormat, $selected, $options, $empty
                );
            break;
            case 'date':
                $out = $before . $out . $between . $this->dateTime(
                    $fieldName, $dateFormat, null, $selected, $options, $empty
                );
            break;
            case 'datetime':
                $out = $before . $out . $between . $this->dateTime(
                    $fieldName, $dateFormat, $timeFormat, $selected, $options, $empty
                );
            break;
            case 'textarea':
                $out = $before . $out . $between . $this->textarea($fieldName, $options + array('cols' => 30, 'rows' => 6));
            break;
            default:
                $out = $before . $out . $between . $this->defaultInput($type, $fieldName, $options);
            break;
        }
 
        if ($type != 'hidden') {
            $out .= $after;
            if ($error !== false) {
                $errMsg = $this->error($fieldName, $error);
                if ($errMsg) {
                    $out .= $errMsg;
                    $divOptions = $this->addClass($divOptions, 'error');
                }
            }
        }
        if (isset($divOptions) && isset($divOptions['tag'])) {
            $tag = $divOptions['tag'];
            unset($divOptions['tag']);
            $out = $this->Html->tag($tag, $out, $divOptions);
        }
        return $out;
    }
 
    /**
    * Creates a default input widget, whose type is determined by $options['type'].
    *
    * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
    * @param array $options Array of HTML attributes.
    * @return string A generated HTML input element
    * @access public
    */
    function defaultInput($type, $fieldName, $options = array()) {
            $options = $this->_initInputField($fieldName, array_merge(
                    array('type' => $type), $options
            ));
            return sprintf(
                    $this->Html->tags['input'],
                    $options['name'],
                    $this->_parseAttributes($options, array('name'), null, ' ')
            );
    }
}    
?>