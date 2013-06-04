<?php
  $data['mesas'] = array();
  
  $i = 0;
  foreach ( $mesas  as $m ) {
      $data['mesas'][$i]['mesa'] = $m;
      $data['mesas'][$i]['mozo'] = $m['Mozo'];
      $data['mesas'][$i]['cliente'] = $m['Cliente'];
      $i++;
  }
  
  echo json_encode($data);