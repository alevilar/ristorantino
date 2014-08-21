<?php
header('Content-Type: application/json');

$json = array(array(
	'printer' => 'fiscalprinter',
	'fiscal' => true,
	'text' => "un texto re largo\n asn coina sonsd 
sdihsd sdiisd sidbosus dbsoduhsg duhsd
sidguh siudhoisud sidg 
sjd isdhis dhIHsd
ós dusid shidh "
));

echo json_encode($json);
