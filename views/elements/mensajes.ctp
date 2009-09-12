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




	<div id="mensajes"><?php $session->flash(); ?></div>
	<script type="text/javascript">
		var canMesas = "<?= sizeof($this->data['Mesa'])?>";
		mensajero.show(canMesas+" Mesas Abiertas");
	</script>	
