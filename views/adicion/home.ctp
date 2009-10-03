<script type="text/javascript">

function validarMonto(nombreForm, nombreInput){
	if($(nombreInput).val() >= 5){
		alert("esta bien");
		return true
		}
		else{
		alert("Ingresar un valor mayor o igual a 5");
		return false;
	}
}

</script>

<div id="adicion-cabecera">
	<?php echo $this->renderElement('adicion/cambiar_mozo');?>	
</div>


