<?php
$nList = array();
$i = 0;
foreach($mesas as $k=>$m){
    foreach($m['Mesa'] as $ak=>$att) {
        $mesas[$k][$ak] = $att;
    }
    unset($mesas[$k]['Mesa']);  
    if ( empty($mesas[$k]['Cliente']['id']) ){
        unset($mesas[$k]['Cliente']);
    }
    $mesas[$k]['time'] = date('H:i',strtotime($mesas[$k]['created']));
}

echo json_encode($mesas);