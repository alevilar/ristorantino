
<script type="text/javascript">
    //adicion.reinitMenuController();
    //adicion.addButton(['back', 'abrirMesa', 'seleccionarMesa']);
</script>

<div class="grid_3">
    <ul data-role="listview">
        <li><a href="#hacer-comanda" ><?= $html->image('/adition/css/img/chef_64.png')?>Comanda</a></li>
        <li><a href="#sacar-item" >Sacar Item</a></li>
        <li><a href="#Agregar Cliente" >Agragar Cliente</a></li>
        <li><a href="#Agragar Descuento" >Agregar Descuento</a></li>
        <li><a href="#Cerrar-mesa" >Cerrar Mesa</a></li>
        <li><a href="#cambiar-mozo" >Cambiar Mozo</a></li>
        <li><a href="#Cambiar N° Mesa" >Cambiar N°</a></li>
        <li><a href="#re-print" >Re imprimir Ticket</a></li>
        <li><a href="#Borrar-mesa" >Borrar Mesa</a></li>
        <li><a href="#testiesto" >De la pagina de atras</a></li>

    </ul>
</div>

<div class="mesas view grid_8 prefix_1" >
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