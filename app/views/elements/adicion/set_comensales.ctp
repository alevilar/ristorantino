<div id="div-comensales" style="display: none; width: 500px; height: 500px;"></div>



<script type="text/javascript">

var setComensalesWindow;
setComensalesWindow = new Window({
					maximizable: false, 
					resizable: false, 
					hideEffect:Element.hide, 
					showEffect:Element.show,
					destroyOnClose: false
				});
	
setComensalesWindow.setContent('div-comensales', true, true);


	Event.observe(window,'load', function(){
	$('btn-comensales').observe('click',function(){
		new Ajax.Updater("div-comensales","<?= $html->url('/comensales/add')?>", {
			  parameters: {'data[Mesa][id]': adicion.currentMesa.id},
			});		
		setComensalesWindow.show();
	})});


</script>