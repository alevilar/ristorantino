<?php  
        echo $this->element('menuadmin');
     ?>
<?php 
    echo $javascript->link('jquery/jquery-ui-1.8.14.custom.min'); 
    echo $html->css('jquery-ui/jquery-ui-1.8.14.custom');
?>
<script type="text/javascript">
    jQuery(function() {
        jQuery( "#arqueoFecha" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });
</script>
<div class="grid_12">
    <div>Comprobante diario nro: </div>
    <div>
        <form method="post">
        Arqueo fecha: <input type="text" id="arqueoFecha" name="arqueoFecha" size="10" value="<?php echo $fechainput?>" />
        <input type="submit" value="Ver" />
        </form>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>
                    Saldo inicial
            </td>
            <td style="width:100px; text-align:right;">
                    0
            </td>
	</tr>
        <tr>
            <td>
                    Ventas en efectivo
            </td>
            <td style="width:100px; text-align:right;">
                    <?php echo number_format($ventas_efectivo, 2, ',', '.')?>
            </td>
	</tr>
        <tr>
            <td>
                    Otros ingresos
            </td>
            <td style="width:100px; text-align:right;">
                    0
            </td>
	</tr>
        <tr>
            <td>
                    Salidas en efectivo
            </td>
            <td style="width:100px; text-align:right;">
                    <?php echo number_format($gastos, 2, ',', '.')?>
            </td>
	</tr>
        <tr>
            <td>
                    Vales
            </td>
            <td style="width:100px; text-align:right;">
                    <?php echo number_format($vales, 2, ',', '.')?>
            </td>
	</tr>
        <tr>
            <td style="border-top:1px solid black;">
                    Total
            </td>
            <td style="border-top:1px solid black; width:100px; text-align:right;">
                    <?php echo number_format($total, 2, ',', '.')?>
            </td>
	</tr>
        <tr>
            <td>
                    Saldo final
            </td>
            <td style="width:100px; text-align:right;">
                    0
            </td>
	</tr>
        <tr>
            <td>
                    Faltante / Sobrante
            </td>
            <td style="width:100px; text-align:right;">
                    0
            </td>
	</tr>
    </table>
       
</div>