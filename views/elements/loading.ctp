<?php $imagen = $html->image('loading_spiral.gif');?>

<script type="text/javascript">
<!--
function mostrar_onloading(){
	Dialog.info('<?php echo $imagen;?>', {
		howEffect: Element.show, 
		hideEffect: Element.hide, 
		//className: 'alphacube', 
		zIndex: 2000, 
		width:250, 
		height:250, 
		showProgress: false, 
		destroyOnClose: true
		}
	);
}


function ocultar_onloading(){
	Dialog.closeInfo();
}




//-->
</script>
<?php


