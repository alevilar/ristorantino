

<table>
  <tr>
    <td>
    <h2>Usuarios y Clientes</h2>
<?php 
echo $html->link('Usuarios','/users/index').'<br>';
echo $html->link('Mozos','/mozos/index').'<br>';
echo $html->link('Clientes','/clientes').'<br>';
echo $html->link('-   Tipo de Documentos','/tipo_documentos').'<br>';
echo $html->link('-   IVA Responsabilidades','/iva_responsabilidades').'<br>';
echo $html->link('Descuentos','/descuentos').'<br>';
echo $html->link('Tipo de Pagos','/TipoDePagos').'<br>';
?>

<h2>Mesas</h2>
<?php 

echo $html->link('Comandas Activas','/Comandas').'<br>';
echo $html->link('Listado de Mesas','/Mesas').'<br>';
?>

	</td>
    <td>

  <h2>Productos</h2>
<?php 
echo $html->link('Categorias','/categorias').'<br>';
echo $html->link('Productos','/productos').'<br>';
echo $html->link('Gustos y Sabores','/sabores').'<br>';
?>
	

<h2>Configuración de impresoras</h2>
<?php 
echo $html->link('CUPS Printer Manager',FULL_BASE_URL.':631').'<br>';
echo $html->link('Comandera','/Comanderas').'<br>';

?>

<h2>Informes y Servidor</h2>
<?php 
echo $html->link('Crear consultas para las estadísticas (avanzado)','/pquery/queries').'<br>';

echo $html->link('Reiniciar servidor (ojo que esta accion hace que no se pueda operar el sistema hasta que no se reinicie)','/cajero/reiniciar');

?>

	</td>
  </tr>
</table>

