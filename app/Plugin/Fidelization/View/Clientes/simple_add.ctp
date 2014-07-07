<div data-role="page" id="clientes-addfacturaa">

<div data-role="header">
    <h1>Clientes</h1>
</div>
    
<div data-role="content" data-theme="f">
    <div id="form-cliente-a" class="clientes form">
        <?php echo $this->Form->create('Cliente', array( 
                                    'action'=>'simple_add', 
                                    'onsubmit' => 'return false;',
                                    'id' =>'form-cliente-add', 
                                    'data-ajax'=>'false'));?>


        <div class="ui-grid-a">
            <div class="ui-block-a">
                <?php
                    echo $this->Form->input('iva_responsabilidad_id', array('default'=> IVA_RESPONSABILIDAD_RESPONSABLE_INSCRIPTO ));
                    echo $this->Form->input('nombre',array('label'=>'Nombre/Razón Social'));
                ?>
            </div>
            

            <div class="ui-block-b">
                <?php

                    echo $this->Form->input('tipo_documento_id', array('default'=> TIPO_DOCUMENTO_CUIT ));
                    echo $this->Form->input('nrodocumento', array('label'=>'Número (sin los guiones)'));                                
                ?>
            </div>
        </div>
       
        <?php 
        echo $this->Form->input('descuento_id', array('empty'=>'Sin Descuento'));
        echo $this->Form->end('guardar');

        ?>
    </div>
</div>

</div>