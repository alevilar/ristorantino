    <?php    
    $i=0;
    $menubread[$i]['name'] = 'Admin';
    $menubread[$i]['link'] = '/pages/administracion';
    $i++;
    $menubread[$i]['name'] = 'Clientes';
    $menubread[$i]['link'] = '/clientes';
    echo $this->element('menuadmin', array('menubread'=>$menubread));
    ?>



<script type="text/javascript">
    Event.observe(window, 'load', function(){
        if ($F('ClienteTipofactura') == 0){
            $('datosParaRemito').show();
        }
        else if ($F('ClienteTipofactura') == 'A'){
            $('datosParaFacturaA').show();
        }
    });
</script>

<div class="clientes form">
    <?php echo $form->create('Cliente');?>
    <fieldset>
        <legend><?php __('Editar Cliente');?></legend>
        <?php
        echo $form->hidden('id');

        echo $form->input('user_id',
                    array(  'empty'=> 'Seleccione',
                            'label'=>'Usuario',
                            'after'=>'<br>Esta opción sirve para relacionar clientes con algún usuario del sistema. Por ejemplo, clientes relacionados con el Dueño, el encargado, o algún mozo. De esa forma se pude calcular las invitaciones y vales que cada uno usara.'
                        ));




        echo $form->input('nombre',
                               array(
                                  'label'=>'Nombre/Denominación',
                                  'after'=>'Ej: La Serenissima S.A.'));

        echo $form->input('domicilio');
        echo $form->input('codigo');
        echo $form->input('mail');
        echo $form->input('telefono');


        echo $form->input(
            'tipofactura',
            array(
                'label'=>'Tipo Factura',
                'options'=>array('B'=>'"B"', '0'=>'Remito','A'=>'"A"'),
                'after'=> '<br>Tipo de comprobante a imprimir.'
            )
        );

        echo $form->input('descuento_id',array(
                'div'=>array('id' => 'div-descuento'),
                'empty'=>'Sin Descuento',
                'after'=>'<br>El descuento solo es válido cuando se quiere imprimir un remito'));

        ?>

        <div id="datosParaRemito" style="display:none;">
            <?
             echo $form->input('imprime_ticket',
                                array(
                                    'checked'=>true,
                                    'after'=>'Hay ocasiones en las que no es necesario imprimir un remito.<br>Si desea imprimir por otra comandera debe dirigirse a la seccion "Comanderas" de la pagina de administracion.'));

            ?>
        </div>



        <div id="datosParaFacturaA" style="display:none;">
            <?

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


    <?php echo $form->end('Submit');?>

    </fieldset>

</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('List Clientes', true), array('action'=>'index'));?></li>
    </ul>
</div>
