<?php
if (!$preview) {
    echo $javascript->link('jquery/jquery.jeditable.mini', false);
?>

<script type="text/javascript">
    jQuery(document).ready( function(){
        
        function nl2br_js(myString) {
            var regX = /\n/gi ;

            s = new String(myString);
            s = s.replace(regX, "<br /> \n");
            return s;
        }
        
        jQuery('.editable_textarea').editable(
            function(){
                return nl2br_js(jQuery(this).find('textarea').val());
            },
            {
                type:'textarea',
                submit:'OK'
            }
        );

        jQuery('.editable').editable(function(){
                return nl2br_js(jQuery(this).find('input').val());
            });
    });

</script>

<?php } ?>

<div class="queries index">
    <?php
    if(!$preview){
    ?>
    <br />

    <div class="info editable_textarea" style="min-height: 60px;">
        <?php echo($descripcion); ?>
    </div>

    <p style="text-align: center;" class="no-imprimir">
        <?php
        if (isset($paginator)) {
            $paginator->options(array('url' => $url_conditions));
        }
//echo $paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
//));

        if (isset($paginator)) {
            echo $paginator->counter(array(
            'format' => __('Pagina %page% de %pages% Mostrando %current% registros de %count% encontrados', true)
            ));
        }
//debug($url_conditions);
        ?>
    </p>

    <p class="no-imprimir">
        <?php
        if ($viewAll) {
            echo $html->link('Ver Todos','/pquery/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:true/',array('class'=>'clearTag'));
        } else {
            echo $html->link('Ver por página','/pquery/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:false/',array('class'=>'clearTag'));
        }
        ?>

        <?php echo " | "?>
        <?php echo $html->link('Imprimir','#Imprimir',array('class'=>'clearTag','onclick'=>'window.print()'));?>

        <?php echo " | "?>
        <?php echo $html->link('descargar excel','/pquery/Queries/list_view/'.$url_conditions['query.id'].'.xls' ,array('class'=>'clearTag'));?>

        <?php echo " | "?>
        <?php echo $html->link('Volver','/pquery/Queries/descargar_queries/',array('class'=>'clearTag'));?>

    </p>
    <?php
    }
    ?>
    <table cellpadding="0" cellspacing="0" style="font-size: 9pt">
        <caption class="editable"><?php echo $name?></caption>
        <thead>
        <tr>
            <?php foreach ($cols as $col): ?>
            <th  class="editable"><?php echo $col;?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        foreach ($queries as $query):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
        <tr<?php echo $class;?>>
                <?php foreach($query as $line):?>
            <td>

                        <?php echo (strlen($line) > 30)?substr($line, 0, 30) . "...":$line; ?>
            </td>
                <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
    if (isset($paginator)) {
?>
<div class="paging" style="background-color: #F0F7FC; height: 60px; padding-top: 20px; text-align: center;border-top: 3px solid #DBEBF6">
    <?php
        echo $paginator->prev('<<');
        echo "&nbsp;";
        echo $paginator->numbers();
        echo "&nbsp;";
        echo $paginator->next('>>');
   ?>
</div>
<?php
     }
?>
