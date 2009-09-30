

<table>
  <tr>
    <td>
<?php 
echo $html->link('Nuevo usuario','/users/add').'<br>';
echo $html->link('Nuevo mozo','/mozos/add').'<br>';
echo $html->link('Categorias','/categorias').'<br>';
echo $html->link('Productos','/productos').'<br>';
echo $html->link('Gustos y Sabores','/sabores').'<br>';
?>
	</td>
    <td>

<?php 
echo $html->link('Clientes','/clientes').'<br>';
echo $html->link('Tipo de Pagos','/TipoDePagos').'<br>';
echo $html->link('Comandas','/Comandas').'<br>';

?>
	</td>
  </tr>
</table>

