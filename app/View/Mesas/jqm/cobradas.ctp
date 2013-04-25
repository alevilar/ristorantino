<ul data-role="listview"data-filter="true" id="">
<?php
$this->title_for_layout = 'Últimas Cobradas';

foreach ($mesa as $m) {
    
  echo   "<li>".
          $this->Html->link(
                  "Mesa N° ". $m['numero'] . " Mozo " . $m['Mozo']['numero'] . ". Cobrada el " . date('d M H:i', strtotime($m['time_cobro']) )
                  , '#mesa-view'
                  , array(
                '       data-mesa' => json_encode($m)
                    ) 
          )
          ."</li>";
}
?>

</ul>