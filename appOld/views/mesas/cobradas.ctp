    <div data-role="content">
        <ul data-role="listview"data-filter="true" id="">
            <?php
            $this->title_for_layout = 'Últimas Cobradas';

            foreach ($mesas as $m) {

                echo "<li>" .
                $html->link(
                        "Mesa N° " . $m['numero'] . " Mozo " . $m['Mozo']['numero'] . ". Cobrada el " . date('d M H:i', strtotime($m['time_cobro']))
                        , '#mesa-view'
                        , array(
                    '       data-mesa' => json_encode($m)
                        )
                )
                . "</li>";
            }
            ?>

        </ul>
    </div>