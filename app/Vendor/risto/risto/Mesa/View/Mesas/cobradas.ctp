<div data-role="page" id="mesas-cobradas">
    <div data-role="content">
        <ul data-role="listview" data-filter="true" id="">
            <?php
            $this->title_for_layout = 'Últimas Cobradas';

            foreach ($mesas as $m) {

                echo "<li>" .
                $this->Html->link(
                        "Mesa N° " . $m['numero'] . " Mozo " . $m['Mozo']['numero'] . ". Cobrada el " . date('d M H:i', strtotime($m['time_cobro']))
                        , array(
                                'plugin' => 'mesa',
                                'controller' => 'mesas',
                                'action' => 'edit',
                                $m['id']
                            )
                        , array(
                            'data-rel' => "dialog",
                            'data-mesa' => json_encode($m)
                        )
                )
                . "</li>";
            }
            ?>

        </ul>
    </div>

</div>