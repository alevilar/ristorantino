

<table>
  <tr>
    <td>
    <h2>Usuarios y Clientes</h2>
<?php 
echo $html->link('Nuevo usuario','/users/add').'<br>';
echo $html->link('Nuevo mozo','/mozos/add').'<br>';
echo $html->link('Clientes','/clientes').'<br>';
echo $html->link('Tipo de Pagos','/TipoDePagos').'<br>';
?>

<h2>Mesas</h2>
<?php 

echo $html->link('Comandas Activas','/Comandas').'<br>';
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
echo $html->link('Impresora Fiscal','/Imfiscales').'<br>';
echo $html->link('Comandera','/Comanderas').'<br>';

?>
	</td>
  </tr>
</table>

