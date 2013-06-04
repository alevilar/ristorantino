// actualiza automaticamente los campos simplemente clickeando sobre el texto
/** 
 * Ale Fieldupdates Afups debe estar vinculado con el php del lado del servidor
 * es necesario capturar los campos tal como son enviados por este script
 * el servidor deberá leer:
 * product_id que es el id del "producto" o lo que se fuera a actualizar
 * field es el campo de la bbdd que será actualizado
 * text es el nuevo valor  a ingresar
 * 
 * CakePHP Example:
 * dentro de un controller tengo la sigiente action:
 * 
 * function update()
        {
            $this->{$this->model->name}->id = $this->params['form']['product_id'];
            if ($this->{$this->model->name}->saveField($this->params['form']['field'], $this->params['form']['value'], false)) {
                $txtShow = (!empty($this->params['form']['text'])) ? $this->params['form']['text'] : $this->params['form']['value'];
                echo $txtShow;
            } else {
                echo "error al guardar";
            }
            exit;
        }
 * 
 * depende de jquery/jquery.jeditable
 * http://www.appelsiini.net/projects/jeditable
 * 
 * Debe ser inicializado mediante:
 * Afups.init( url ),
 * 
 *  
 *  @param configParams: 
 *  
 *      Options are
 *          'urlParam' Se deberá pasar una URL donde se hara enviaran los cambios
 *          'fieldName' name of the TABLE field to be updated
 *          'itemId'    ID of the item
 *          'options'   json list of options to show when is type HTML select
 *          'text'      simple text update
 *          'select'    show the list of options passed and update the KEY passed
 */
function Afups(configParams){
    var urlVar  = configParams.urlParam || 'edit',
        $       = jQuery;
    
    /**
     * Fields to be read from de DOM attr
     */
    var fields = {
          fieldName  : configParams.fieldName || 'data-field',      // field Name
          itemId     : configParams.itemId || 'data-item-id', // field ID where i´m going to do UPDATE WHERE item.id = ?
          options    : configParams.options || 'data-options'     // field options to be shown into a FORM SELECT OPTIONS
        };
        
        
    var domObjs = {
        text  : configParams.text || '.edit',
        select: configParams.select || '.edit_field_types'
    }

            
    
    $(document).ready(function() {
        $(domObjs.text).editable( urlVar , {
            submit: 'OK',
            submitdata: function(){
                return {
                    field: $(this).attr(fields.fieldName),
                    id: $(this).attr(fields.itemId)
                }
            }
        });


        $(domObjs.select).editable( urlVar , {
            data: function() {
                return $(this).attr(fields.options)
            },
            type: 'select',
            submit: 'OK',
            submitdata: function(){
                return {
                    field: $(this).attr(fields.fieldName),
                    id: $(this).attr(fields.itemId),
                    text: $(this).find('select :selected').text()
                }
            }
        });
    });

            
}

    