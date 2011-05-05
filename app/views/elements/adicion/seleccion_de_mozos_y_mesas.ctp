<?php echo $javascript->link('adicionar/cambiar_mesa', false) ?>

<div id="listado-de-mesas-abiertas" class="page grid_8">

    <ul class="li-mozos horizontal">
        <li><button type="button" mozoid="0" class="cuadrado">Todos</button></li>

        <?php foreach ($mozos as $mozo):?>
        <li>
            <button type="button" mozoid="<?php echo $mozo['Mozo']['id']?>">
                <?php echo $mozo['Mozo']['numero']?>

                <?php
                echo $html->image('ico_mozo.png', array(
                    'width' => '40px',
                   // 'style' => 'margin-top: -6px'
                ));
                ?>
            </button>
        </li>
        <?php endforeach;?>
    </ul>

    <div class="clear"></div>
    
    <ul class="li-mesas horizontal">
        <?php
            foreach ($mesasabiertas as $mesa):
        ?>
            <li>
                <?php $caseMesaCerrada = ($mesa['Mesa']['time_cerro'] != '0000-00-00 00:00:00') ? 'mesa-cerrada':'';?>
                <button type="button"
                        class ="<?php echo $caseMesaCerrada?>"
                        mesaid="<?php echo $mesa['Mesa']['id']?>"
                        mozoid="<?php echo $mesa['Mesa']['mozo_id']?>"
                        >
                        <?php echo $mesa['Mesa']['numero'] ?>
                </button>
        </li>
<?php endforeach; ?>
    </ul>
</div>
