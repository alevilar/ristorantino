

	<div id="mensajes"><?php $session->flash(); ?></div>
	<script type="text/javascript">
		var canMesas = "<?= sizeof($this->data['Mesa'])?>";
		mensajero.show(canMesas+" Mesas Abiertas");
	</script>	
