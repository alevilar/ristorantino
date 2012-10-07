
<div class="mesas form">
<?php echo $this->Form->create('Mesa', array('data-direction' => "reverse") );?>

    <div class="ui-grid-d">    
            <div class="ui-block-a">
            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('estado_id', array( 'label' => 'Modificar Estado', 'data-native-menu'=> "false"  ));
                    
                    ?>
            </div>

            <div class="ui-block-b">
                            <?php
                                echo $this->Form->input('numero', array( 'label' => 'Cambiar Número de Mesa' ));
                            ?>
            </div>
        
        <div class="ui-block-c">
                        <?php
                        echo $this->Form->input('mozo_id', array( 'label' => 'Cambiar Mozo' ));                
                        ?>
                    </div>
        
        <div class="ui-block-d">
            <?php
                    echo $this->Form->input('cant_comensales', array('label' => 'Modificar cantidad de Cubiertos'));
            ?>
            </div>
        
        <div class="ui-block-e">
            <?php
                    echo $this->Form->input('total',array('label'=>'Total (Tocar con precaución)'));
            ?>
        </div>
    </div>
    <div class="ui-grid-a">   
        <div class="ui-block-a">
            <a href="#mesa-view" data-direction="reverse" data-role="button" data-theme="e">Volver a la Mesa</a>
        </div>
         <div class="ui-block-b">
            <button type="submit" value="Guardar" data-theme="b">Guardar</button>
         </div>
    </div>
</div>
</div>