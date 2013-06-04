<?php
$data = array();
$i = 0;
foreach ($mozos as $m){
	$data[$i] = $m['Mozo'];
	$data[$i]['mesas'] = aplanar_mesas($m['Mesa']);
	
	$i++;
}

echo json_encode($data);
