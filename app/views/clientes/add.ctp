<div class="clientes form">
    <?php echo $form->create('Cliente');?>
    <fieldset>
        <legend><?php __('Agregar Nuevo Cliente');?></legend>
        <?php
        echo $form->input('user_id', 
                    array(  'empty'=> 'Seleccione',
                            'label'=>'Usuario',
                            'after'=>'<br> Seleccione un usuario si es que desea tener un registro del mismo.
                                O sea, si quiere mantener una estadistica de consumiciones, dias que vino, etc.
                                Lo que necesita es crear primero un usuario y luego relacionar al cliente con
                                dicho usuario. Si usted no entiende consulte con el administrador del sistema.'
                        ));


        echo $form->input(
            'tipofactura',
            array(
                'label'=>'Tipo Factura',
                'options'=>array('B'=>'"B"', '0'=>'Remito','A'=>'"A"'),
                'after'=> '<br>Tipo de comprobante a imprimir.
                            Se puede imprimir una factura "A", "B", o un remito.'
            )
        );

        
        ?>
        
        <div id="datosParaRemito" style="display:none;">
            <?
             echo $form->input('imprime_ticket',
                                array(
                                    'checked'=>true,
                                    'after'=>'Hay ocasiones en las que no es necesario imprimir un remito,
                                        El remito, cuando es impreso sale por una comandera, ya que no es un comprobante fiscal.<br> Si desea imprimir por otra comandera debe dirigirse a la seccion "Comanderas" de la pagina de administracion.'));


             echo $form->input('descuento_id',array(
                'div'=>array('id' => 'div-descuento'),
                'empty'=>'Sin Descuento',
                'after'=>'El descuento solo es válido cuando se quiere imprimir un remito'));
            ?>
        </div>



        <div id="datosParaFacturaA" style="display:none;">
            <?
            echo $form->input('nombre',
                               array(
                                  'label'=>'Nombre/Denominación',
                                  'after'=>'Ej: La Serenissima S.A.'));
            echo $form->input('tipo_documento_id',
                               array(
                                   'default'=>1, // CUIT, numero hardcodeado de la base de datos
                                   'label'=>'Tipo de Identificación',
                                   'empty'=>'Seleccione'));
            echo $form->input('nrodocumento',
                               array(
                                   'label'=>'Número',
                                   'after'=>'Ej: 3045623431   >>>>No hay que poner los "-". '
                                   ));
            echo $form->input('domicilio');
            echo $form->input('iva_responsabilidad_id', 
                               array(
                                   'label'=>'Responsabilidad ante el IVA',
                                   'default'=>1, // Resp. Inscripto, Numero hardcodeado de la base de datos
                                   'empty'=>'Seleccione'));
            ?>
            
        </div>

        <script type="text/javascript">
            $('ClienteTipofactura').observe('change',function(){
                if($F('ClienteTipofactura') != 0){
                    $('ClienteDescuentoId').setValue(""); //lo vuelvo a reinicializar al valor, por si fue modificado por error
                    $('datosParaRemito').hide();
                }
                else{
                    $('datosParaRemito').show();
                }

                if($F('ClienteTipofactura') == 'A'){
                    $('datosParaFacturaA').show();
                }
                else{
                    $('datosParaFacturaA').hide();
                }
            });
        </script>



       
    </fieldset>
    <?php echo $form->end('Submit');?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('List Clientes', true), array('action'=>'index'));?></li>
    </ul>
</div>
