<?php
              
                
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('cake.css');         
                echo $html->css('/pquery/css/jquery.jqplot.css');

?>

<div class="grid_2 push_5" style="margin-bottom: 40px">
<p>Fecha:</p>
<select>
<option value="">Dia</option>
<option value="Contabilidad">Esta semana</option>
<option value="mesas">Este mes</option>
<option value="mozos">Este año</option>
</select>
</div>
<div class="col-md-12">
<table cellspacing="0" cellpadding="0">
        <caption class="editable">Clientes:</caption>
        <thead>
        <tr>
                        <th class="editable">cliente</th>
                        <th class="editable">fecha</th>
                        <th class="editable">Consumido</th>
                        <th class="editable">descuento</th>
                    </tr>
        </thead>
        <tbody>
                        <tr class="altrow">
                            <td>
                        Sadar Amortiguadores           </td>
                            <td>
                        2011-04-19 22:42:12            </td>
                        <td>
                        $300.00            </td>
                            <td>
                        Cliente 15%            </td>
                        </tr>
                        <tr class="altrow">
                            <td>
                        Laboratorio Tablada SRL           </td>
                            <td>
                        2011-04-30 22:42:12            </td>
                        <td>
                        $251.00            </td>
                            <td>
                        Cliente 15%            </td>
                        </tr>
                        <tr class="altrow">
                            <td>
                        Cardinal Cooperativa de Credito Cons.           </td>
                            <td>
                        2011-04-19 22:42:12            </td>
                        <td>
                        $200.00            </td>
                            <td>
                        Cliente 30%            </td>
                        </tr>
                        <tr class="altrow">
                            <td>
                        Chaja SRL           </td>
                            <td>
                        2011-03-11 22:42:12            </td>
                        <td>
                        $30.00            </td>
                        <td>
                        Cliente 15%            </td>
                        </tr>
                        <tr class="altrow">
                            <td>
                        SSchiaffino Juan               </td>
                            <td>
                        2011-01-19 22:42:12            </td>
                        <td>
                        $900.00            </td>    
                        <td>
                        Sin descuento            </td>
                        </tr>
                </tbody>
    </table></br>
</br>
</br>
<label>Ingrese cliente a buscar</label>
    <select>
    <option value="">Nombre</option>
    <option value="Contabilidad">DNI</option>
    <option value="mesas">Domicilio</option>
    <option value="mozos">Fecha</option>
    </select>
<input>
</div>
