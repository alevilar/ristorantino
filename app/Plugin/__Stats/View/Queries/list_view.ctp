<?php
echo $this->Html->script('jquery-1.4.2.min', false);
echo $this->Html->script('jquery-ui-1.8.5.custom.min', false);
echo $this->Html->script('jquery.jeditable.mini', false);
?>

<script type="text/javascript">
    jQuery(document).ready(
    function(){
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

    function nl2br_js(myString) {
        var regX = /\n/gi ;

        s = new String(myString);
        s = s.replace(regX, "<br /> \n");
        return s;
    }
</script>

<div class="queries index">

    <br />

    <div class="info editable_textarea" style="min-height: 60px;">
        <?php echo($descripcion); ?>
    </div>

    <p style="text-align: center;" class="no-imprimir">
        <?php
        if (isset($paginator)) {
            $this->Paginator->options(array('url' => $url_conditions));
        }
//echo $this->Paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
//));

        if (isset($paginator)) {
            echo $this->Paginator->counter(array(
            'format' => __('Pagina %page% de %pages% Mostrando %current% registros de %count% encontrados')
            ));
        }
//debug($url_conditions);
        ?>
    </p>

    <p class="no-imprimir">
        <?php
        if ($viewAll) {
            echo $this->Html->link('Ver Todos','/pquery/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:true/',array('class'=>'clearTag'));
        } else {
            echo $this->Html->link('Ver por página','/pquery/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:false/',array('class'=>'clearTag'));
        }
        ?>

        <?php echo " | "?>
        <?php echo $this->Html->link('Imprimir','#Imprimir',array('class'=>'clearTag','onclick'=>'window.print()'));?>

        <?php echo " | "?>
        <?php echo $this->Html->link('descargar excel','/pquery/Queries/list_view/'.$url_conditions['query.id'].'.xls' ,array('class'=>'clearTag'));?>

        <?php echo " | "?>
        <?php echo $this->Html->link('Volver','/pquery/Queries/descargar_queries/',array('class'=>'clearTag'));?>

    </p>

    <table cellpadding="0" cellspacing="0">
        <caption class="editable"><?php echo $name?></caption>
        <thead>
        <tr>
            <?php foreach ($cols as $col): ?>
            <th class="editable"><?php echo $col;?></th>
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
                        <?php echo $line; ?>
            </td>
                <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="paging" style="background-color: #F0F7FC; height: 60px; padding-top: 20px; text-align: center;border-top: 3px solid #DBEBF6">
    <?php
    if (isset($paginator)) {
        echo $this->Paginator->prev('<<');
        echo "&nbsp;";
        echo $this->Paginator->numbers();
        echo "&nbsp;";
        echo $this->Paginator->next('>>');
    }
    ?>
</div>

<?
debug($queries);
?>