<?php

$cliente['Cliente']['Descuento'] = $cliente['Descuento'];
unset($cliente['Descuento']);
echo $javascript->object($cliente);
