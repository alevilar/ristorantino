<div data-role="page" id="mesas-edit">
    <div data-role="content">
        

        <div class="mesas form">
            <?php echo $this->Form->create('Mesa'); ?>
            <div class="col-md-6 ">
                <fieldset>
                    <legend><?php __('Datos Generales'); ?></legend>
                    <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('estado_id');
                    echo $this->Form->input('numero', array('label' => 'Número de Mesa'));
                    echo $this->Form->input('mozo_id');
                    ?>
                </fieldset>
            </div>

            <div class="col-md-6">
                <fieldset>
                    <legend><?php __('Totales de Mesa'); ?></legend>
                    <?php
                    echo $this->Form->input('cant_comensales');
                    echo $this->Form->input('total', array(
                        'required' => 'required'));
                    

                    echo "<br>";

                    echo $this->Html->link(__('Borrar Mesa', true)
                                    , array('action' => 'delete'
                                    , $this->Form->value('Mesa.id'))
                                    , array('class' => 'btn btn-danger pull-right  btn-lg')
                                    , sprintf('Seguro que querés borrar la mesa Número # %s?', $this->Form->value('Mesa.numero'))); 

                    

                    echo $this->Form->submit('Guardar Cambios', array('class'=>'btn btn-primary btn-lg'));

                    


                    echo $this->Form->end();

                    ?>
                    
                </fieldset>
            </div>
        </div>


        <div class="clearfix"></div>


        <div class="detallesmesa col-md-6">

            <h2>Cliente</h2>

            <dl>
            <?php                

                if ( !empty($mesa['Cliente']) ) {
                    echo "<dt>Nombre</dt>";
                    echo "<dd>" . $mesa['Cliente']['nombre'] . "&nbsp;</dd>";

                    echo "<dt>Descuento</dt>";
                    $dto = (!empty($mesa['Cliente']['Descuento']['porcentaje'])) ? $mesa['Cliente']['Descuento']['porcentaje'] : "0";
                    echo "<dd>" . $dto . "% &nbsp;</dd>";


                    echo "<dt>Iva Resp.</dt>";
                    $dto = (!empty($mesa['Cliente']['IvaResponsabilidad']['name'])) ? $mesa['Cliente']['IvaResponsabilidad']['name'] : "";
                    echo "<dd>" . $dto . "&nbsp;</dd>";
                }
                
                ?>
            </dl>

            
            
            <h2>Comandas</h2>
            <?php echo $this->Html->link('Crear Comanda'
                , array('plugin'=>'comanda', 'controller'=>'DetalleComandas', 'action'=>'add', $this->request->data['Mesa']['id'])
                , array('class'=>'btn btn-success'));?>

            <ul class="items_mesas">

                <?php
                $totalSumado = 0;
                foreach ($items as $comanda):
                    echo "<li>";
                    echo "Comanda #" . $comanda['id']. "  (".date('H:i, d M',strtotime($comanda['created'])).")";
                    echo " &nbsp;-&nbsp; ";
                    echo $this->Html->link("Editar"
                            , array('plugin'=>'comanda', 'controller' => 'comandas', 'action' => 'edit', $comanda['id'])
                            , array(
                              
                                )
                            );
                    echo " &nbsp;-&nbsp; ";
                    echo $this->Html->link(__('Delete')
                                        , array('plugin'=>'comanda', 'controller' => 'comandas', 'action'=>'delete', $comanda['id'])
                                        , null
                                        , sprintf(__('Are you sure you want to delete # %s?'), $comanda['id']));

                    echo " &nbsp;-&nbsp; ";
                    echo $this->Html->link("Reimprimir"
                            , array('plugin'=>'comanda', 'controller' => 'comandas', 'action' => 'imprimir', $comanda['id'])
                            , array(                            
                                )
                            );
                    if ($comanda['observacion']) {
                        echo "<cite>Observacion: ";
                        echo $comanda['observacion'] . "</cite>";
                        //echo "</li>";
                    }
                    ?>

                    <ul>
                    <?php //debug($comanda); ?>
                    <?php foreach ($comanda['DetalleComanda'] as $detalle) { ?>
                            <li>
                            <?php echo "Cant Pedida: " . $detalle['cant'] . ($detalle['cant_eliminada'] != '0' ? " Sacada: " . $detalle['cant_eliminada'] : '') ?>
                                <br>
                                <?php
                                 echo $this->Html->link("Editar"
                                        , array('plugin'=>'comanda','controller' => 'DetalleComandas', 'action' => 'edit', $detalle['id'])
                                        , array(
                                          
                                            )
                                        );
                                 echo " - ";
                                 echo $this->Html->link(__('Delete')
                                        , array('plugin'=>'comanda', 'controller' => 'DetalleComandas', 'action'=>'delete', $detalle['id'])
                                        , null
                                        , sprintf(__('Are you sure you want to delete # %s?'), $detalle['id']));
                                ?>
                            


                                <span style="color: #AD0101; font-weight: normal; font-size: 120%; <?php if (($detalle['cant'] - $detalle['cant_eliminada']) == 0) echo "text-decoration: line-through;" ?> ">
                                <?php echo $detalle['cant'] - $detalle['cant_eliminada'] . ")  " . (!empty($detalle['Producto']['name']) ? $detalle['Producto']['name'] : '') . " [p-u $ " . $detalle['Producto']['precio'] . "]" ?>
                                </span>
                            </li>
                                    <?php
                                    if (count($detalle['DetalleSabor']) > 0) {
                                        $primero = true;
                                        echo "<cite>";
                                        echo "(";
                                        foreach ($detalle['DetalleSabor'] as $sabor) {
                                            if (!$primero) {
                                                echo ", ";
                                            }
                                            $primero = false;
                                            echo $sabor['Sabor']['name'] . ($sabor['Sabor']['precio'] != '0' ? " [ $" . $sabor['Sabor']['precio'] . "]" : '');

                                            $totalSumado += ($detalle['cant'] - $detalle['cant_eliminada']) * $sabor['Sabor']['precio'];
                                        }
                                        echo ")";
                                        echo "</cite>";
                                    }

                                    $totalSumado += ($detalle['cant'] - $detalle['cant_eliminada']) * $detalle['Producto']['precio'];
                                }
                                ?>
                    </ul>


                    </li>
                    <?php
                endforeach;
                ?>

            </ul>
         

        </div>


        <div class="col-md-6">
            <br>
            <p>
                <?php
                echo "Abrió a las <b>" . date('H:i', strtotime($this->request->data['Mesa']['created'])) . "</b>";

                if (!empty($this->request->data['Mesa']['time_cerro'])) {
                    echo ", Cerró a las <b>" . date('H:i', strtotime($this->request->data['Mesa']['time_cerro'])) . "</b>";
                }

                if (!empty($this->request->data['Mesa']['time_cobro'])) {
                    echo ", Cobrada a las <b>" . date('H:i', strtotime($this->request->data['Mesa']['time_cobro'])) . "</b>";
                }
                ?>
            </p>


            <div class="mesastotaledit">

                <?php
                echo "<h3 class='pull-left'>SUBTOTAL = <span>$$subtotal</span></h3>";
                $dto = empty($mesa['Cliente']['Descuento']['porcentaje']) ? 0 : $mesa['Cliente']['Descuento']['porcentaje'];
                echo "<h3 class='pull-right'>TOTAL = <span>$$total</span> </h3>";
                if ($dto != '0') {
                    echo "(Dto: $dto%)";
                }

                ?>

                <div class="clearfix"></div>

                <h2>Pagos</h2>

               
                <ul>
                <?php
                if ( !count($mesa['Pago']) ) {                    
                    ?>
                    <p class="alert alert-danger">Esta mesa aún no tiene pagos</p>
                    <?php
                }


                foreach ($mesa['Pago'] as $pago) {
                        ?>
                        <li>
                        <?php

                        $money = $this->Number->currency( $pago['valor'] );
                        echo $this->Html->link( $money, array('plugin'=>'mesa', 'controller'=>'pagos', 'action'=>'edit', $pago['id']));

                        echo " | ";

                        echo $this->Html->link( 'eliminar', array('plugin'=>'mesa', 'controller'=>'pagos', 'action'=>'delete', $pago['id'])
                                    , array('class' => '')
                                    , 'Seguro desea eliminar el pago?') ;
                    ?>
                    </li>
                    <?php
                    }
                    ?>

                </ul>

                 <?php
                echo $this->Html->link('Crear Nuevo Pago'
                            , array('plugin' => 'mesa', 'controller' => 'pagos', 'action' => 'addForMesa', $mesa['Mesa']['id'])
                            , array('class' => 'btn btn-success')
                        );
                ?>
            </div>
        </div>


    </div>
</div>