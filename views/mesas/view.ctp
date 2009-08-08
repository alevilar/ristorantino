<?php 
//esta variable no la uso
 //$mozo_json
 ?>
 
<script type="text/javascript">
<!--

fabricaMesa = new FabricaMesa(<?php echo $mesa_json?>);
mesaCambiar = fabricaMesa.getMesa();

cambiarMesa(mesaCambiar);
//-->
</script>


<div class="mesas view">
	<?php 
	pr($items);
	?>
</div>
