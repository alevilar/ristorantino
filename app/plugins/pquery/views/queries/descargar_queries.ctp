<h1>Descargas</h1>

<?php echo $html->css('/pquery/css/pquery'); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        jQuery(".acordiones").accordion({"autoHeight": false});

        jQuery('.tabs').tabs();

        jQuery('.descarga_mas_info').click(function(e){
            e.preventDefault();
            var $dialog = jQuery('<div id="create_dialog"></div>');
            jQuery(document).append($dialog);
            
            $dialog.html('...Cargando vista previa de la descarga')
		.dialog({
                        width: 750,
                        height:400,
                        position: 'center',
                        zIndex: 3999,
			title: 'Vista Previa de la  Descarga',
                        beforeclose: function(event, ui) {
                            jQuery(".ui-dialog").remove();
                            jQuery("#create_dialog").remove();
                        }
            });
            

            jQuery.ajax({
              url: jQuery(this).attr('href'),
              cache: false,
              success: function(data) {   
                console.debug($dialog);
                $dialog.html(data);
              }
            });
            
            return false;
        });        
    })
</script>

<div>
    <div class="js-tabs-ofertas tabs">
        <ul id="ofertas-tabs" class="horizontal-shadetabs">
            <?php 
            foreach ($categorias as $c) {
                echo '<li>
                <a id="htab-'.$c.'"
                   href="#ver-oferta-'.$c.'">
                   '.$c.'
                </a>
            </li>';
            }
            ?>
        </ul>

        <?php foreach ($queries as $k=>$querin) {?>
        <div id="ver-oferta-<?php echo $k ?>" class="descargas-container" style="">
            <div class="acordiones">
            <?php
            foreach ($querin as $q):
            $i = 0;
            ?>
                    <h3>
                        <a href="#"><?php echo 'N° ' .$q['Query']['id'] . ' - '. $q['Query']['name']?></a>
                    </h3>
                    <div>
                                <? echo $html->link( 'Previsualizar',
                                                    array('action'=>'list_view', $q['Query']['id'],'preview:true'),
                                                    array('class' => 'preview descarga_mas_info')
                                                   );?>
                                <? echo $html->link('Descargar',
                                                    array('action'=>'list_view', $q['Query']['id'], 'ext' =>'xls'),
                                                    array('class' => 'descargar')                                   
                                                   );?>
                            <?php if($q['Query']['ver_online']){?>
                                <? echo $html->link( 'Ver',
                                                    array('action'=>'list_view', $q['Query']['id']),
                                                    array('class' => 'ver')
                                                   );?>
                            <?php } ?>
                        
                            <? echo $html->link('Editar',
                                                        array('action'=>'edit', $q['Query']['id']),
                                                        array('class' => 'editar')                                   
                                                       );?>
                        <div style="margin-top: 20px">
                            <label>Descripción</label>
                            <span><?php echo strip_tags($q['Query']['description'],'<br />'); ?></span>
                            <label>Variables</label>
                            <span><?php echo $q['Query']['columns']; ?></span>
                        </div>
                    </div>
                    <?php
                    $i++;
            endforeach;
            ?>
            </div>
	</div>
        <?php } ?>
        
    </div>
</div>