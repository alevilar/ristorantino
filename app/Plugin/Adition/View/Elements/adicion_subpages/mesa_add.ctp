<?php echo $this->Html->script('/adition/js/adicion/elements/mesa_add'); ?>
<div  data-role="page"  id="mesa-add" data-theme="e" class="dialog-ancho dialog-arriba">
        <div  data-role="header"  data-position="inline">
            <h1>Abrir <?php echo Configure::read('Mesa.tituloMesa') ?></h1>
            <a href="#"  data-rel="back">Cancelar</a>
        </div>
    
        <div data-role="content">
            <form name="form-mesa-add" action="#" id="form-mesa-add" class="pasos">
                
                <div  id="add-mesa-paso1">
                    <h3 class="numero-mozo"><?php echo Inflector::pluralize( Configure::read('Mesa.tituloMozo') )?></h3>
                    <fieldset data-role="controlgroup" data-type="horizontal" style="margin: auto;">

                            <legend>Seleccionar <?php echo Configure::read('Mesa.tituloMozo') ?></legend>
                            <?php
                            $first = true;
                                foreach ($mozos as $m) {
                                    $k = $m['Mozo']['id'];
                                    $n = $m['Mozo']['numero'];
                                    echo "<input type='radio' name='mozo_id' id='radio-mozo-id-$k' value='$k'/>";
                                    echo "<label for='radio-mozo-id-$k'>$n</label>";
                                }
                            ?>                     
                    </fieldset>
                </div>
                    
                <div id="add-mesa-paso2" style="display: none">
                    <fieldset data-role="fieldcontain">
                            <h3 class="numero-mesa">Número de <?php echo Configure::read('Mesa.tituloMesa') ?></h3>
                            <label for="mesa-add-numero">Ingresar el número</label>
                            <input type="number" min="1" name="numero" data-risto="mesa" id="mesa-add-numero" required="required"/>
                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button"  data-theme="c" id="add-mesa-paso2-volver">Volver</button></div>
                                <div class="ui-block-b"><button type="button"  data-theme="b" id="add-mesa-paso2-submit">Siguiente</button></div>
                            </div>

                    </fieldset>
                </div>

                <div id="add-mesa-paso3" style="display: none">
                    
                    <fieldset data-role="fieldcontain">
                        <h3 class="cubiertos">Cubiertos</h3>
                            <label for="mesa-add-cant_comensales">Ingresar la cantidad de Cubiertos</label>
                            <input type="number" name="cant_comensales" id="mesa-add-cant_comensales"/>

                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button"  data-theme="c" id="add-mesa-paso3-volver">Volver</button></div>

                                <div class="ui-block-b"><button type="submit"  data-theme="b" id="add-mesa-paso3-submit">Abrir <?php echo Configure::read('Mesa.tituloMesa')?></button></div>
                            </div>

                    </fieldset>
                </div>
                        
            </form>
        </div>
</div> 

