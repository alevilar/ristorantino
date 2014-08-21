<?php

$printerJob = array();
foreach ($printerJobs as $pjs) {
	/*
	$pj = array(
		'printerJob' => $pjs['PrinterJob'],
		'printer' => $pjs['Printer'],
		);
	*/
	$pj = $pjs['PrinterJob'];
	$pj['Printer'] = $pjs['Printer'];
	$printerJob[] = $pj;
}

$coso = json_encode($printerJob);

echo $coso;