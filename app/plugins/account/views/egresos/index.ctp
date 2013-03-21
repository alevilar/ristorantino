<ul>
<?php


foreach ($egresos as $p){
    ?>
    <li>
        <span>
            [<?php echo $p['Egreso']['fecha'] ?>]
        </span>
        <span>
            <?php echo $number->currency($p['Egreso']['total']); ?>
        </span>
        <span>
            <?php echo $p['Egreso']['observacion']; ?>
        </span>
        <ul>
            <?php foreach ($p['Gasto'] as $g){ ?>
            <li>
                <span>
                    <?php echo $number->currency($g['importe_total'])?>
                </span>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php
}
?>
</ul>