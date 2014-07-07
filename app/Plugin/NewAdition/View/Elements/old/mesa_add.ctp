<?php echo $this->Html->script('/adition/js/jqm_events/mesa_add', array('inline' => false)); ?>

<div  id="mesa-add" data-theme="e" class="dialog-ancho dialog-arriba" data-role="dialog" >
        <div  data-role="header"  data-position="inline">
            <h1>Abrir <?php echo Configure::read('Mesa.tituloMesa') ?></h1>
        </div>
    
        <div data-role="content">
            <form name="form-mesa-add" action="#" id="form-mesa-add" class="pasos">
                <input type="hidden" name="mozo_id"/>
                <div  id="add-mesa-paso1">
                    <fieldset data-role="fieldcontain">
                            <h3 class="numero-mesa">Número de <?php echo Configure::read('Mesa.tituloMesa') ?></h3>
                            <label for="mesa-add-numero">Ingresar el número</label>
                            <input type="number" min="1" name="numero" data-risto="mesa" id="mesa-add-numero" required="required"/>
                    </fieldset>
                </div>

                <div id="add-mesa-paso2">
                    
                    <fieldset data-role="fieldcontain">
                        <h3 class="cubiertos">Cubiertos</h3>
                            <label for="mesa-add-cant_comensales">Ingresar la cantidad de Cubiertos</label>
                            <input type="number" name="cant_comensales" id="mesa-add-cant_comensales"/>

                            <div class="ui-grid-a">
                                <div class="ui-block-a">
                                    <a href="#"  data-rel="back" data-role="button">
                                        Volver
                                    </a>
                                </div>
                                <div class="ui-block-b">
                                    <button type="submit"  data-theme="b">
                                        Abrir <?php echo Configure::read('Mesa.tituloMesa')?>
                                    </button>
                                </div>
                            </div>
                    </fieldset>
                </div>
                        
            </form>
        </div>
</div> 

