
<h1>Printer Jobs</h1>


<?php
if ( !count($printerJobs)) {
	?>
	<div class="alert alert-warning">No existen "jobs" por imprimir</div>
	<?php
}

?>

<table class="table">
<?php

foreach ($printerJobs as $pj ) {
	?>
	<tr>
		<td><?php echo $pj['Printer']['name']; ?></td>
		<td><?php echo $pj['PrinterJob']['text']; ?></td>
		<td><?php echo $pj['PrinterJob']['created']; ?></td>
	</tr>

	<?php
}

?>
</table>