<script type="text/javascript">
<!--
/*****************************************************************************
 * 
 *				MENSAJERO ---- Enviar mensajes al usuario mediante javascript
 *
 *****************************************************************************/

 //inicializacion
var mensajero = new Mensaje('mensajes');
mensajero.setImageLoading('<? echo $html->url('/img/loader.gif',true)?>');

//-->
</script>



	<!--  Este es el DIV que contine los mensajes delo que va ocurriendo y que el usuario verá-->
        <div id="mensajes" class="col-md-4"></div>
	
	<script type="text/javascript">
		var canMesas = "<?= sizeof($this->data['Mesa'])?>";

		$(window).load(function(){
			mensajero.show(canMesas+" Mesas");

			mensajero.show('<?php $session->flash(); ?>');

		});
	</script>	
