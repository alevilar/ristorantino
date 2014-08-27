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
 
 */
function Afups(urlParam){
    return this.init(urlParam);
}

Afups.prototype = {
            
            /**
             * @param url: es obligatorio pasar una url donde será enviado el ajax para guardar la data
             */
            init: function( urlVar ){
                
                (function($) {
                     $(document).ready(function() {
                         $('.edit').editable( urlVar , {
                                 submit: 'OK',
                                 submitdata: function(){
                                     return {
                                         field: $(this).attr('field'),
                                         product_id: $(this).attr('product_id')
                                     }
                                 }
                         });


                         $('.edit_field_types').editable( urlVar , {
                             data: function() {return $(this).attr('options_types')},
                             type: 'select',
                             submit: 'OK',
                             submitdata: function(){
                                 return {
                                     field: $(this).attr('field'),
                                     product_id: $(this).attr('product_id'),
                                     text: $(this).find('select :selected').text()
                                 }
                             }
                         });
                 });

            })(jQuery);
                              
            
        }
}

    