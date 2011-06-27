
<script type="text/javascript">
    //adicion.reinitMenuController();
    //adicion.addButton(['back', 'abrirMesa', 'seleccionarMesa']);
</script>


<div class="window_controll"></div>
<div class="mesas view">
    <h1>Mesa N° <? echo $mesa['Mesa']['numero']?> - Mozo <? echo $mesa['Mozo']['numero']?></h1>
    <div class="">
    <h4 id="mesa-total"><?php echo "Total: $".$mesa_total; ?></h4>
    <ul>
	
 	<?php 
 	echo (sizeof($items)== 0)?"NO HAY ITEMS<br>":"";
 	//debug($items);
 	$comanda_ant = '';
 	
 	$prod_borrados = array();
	foreach ($items as $i):
		$cantidad = $i['DetalleComanda']['cant']-$i['DetalleComanda']['cant_eliminada'];
		$producto = $i['Producto']['name'];
		
		if($comanda_ant != $i['DetalleComanda']['comanda_id'] ){
			$comanda_ant = $i['DetalleComanda']['comanda_id'];
                        $comandaHorario = date("H:i:s",strtotime($i['DetalleComanda']['created']));
                        $txtComanda = "Comanda #$comanda_ant ($comandaHorario)";
			if($session->read('Auth.User.role') == 'mozo'){
				echo "<h2>$txtComanda</h2>";
			}
			else{
				echo "<h2>".$html->link($txtComanda,array('controller'=>'comandas','action'=>'imprimir',$comanda_ant),null, "¿Seguro que queres reimprimir la comanda?")."</h2>";
			}
		}
		
			echo "<li><b>$cantidad - </b>$producto</li>";
			if(count($i['DetalleSabor'])>0){
				$esPrimero = true;
				echo "(";
				foreach($i['DetalleSabor'] as $sabor):
					
					if(!$esPrimero){
						echo ", ";
					}
					else $esPrimero = false;
					echo $sabor['Sabor']['name'];
				endforeach;
				echo ")";
			}		
	endforeach;
	?>
	</ul>
    </div>
	
</div>