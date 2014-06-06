<h1>Listado de Cierres</h1>

<table class="table">
    <tbody>
        <?php
        foreach ($cierres as $c) {
            $link = $this->Html->link($c['Cierre']['name'], array('controller' => 'cierres', 'action' => 'view', $c['Cierre']['id']));


            $cierreName = "<span class='name'>$link</span>";
            $cierreName .= " <span class='fecha'>" . date('d-m-Y H:i', strtotime($c['Cierre']['created'])) . "</span>";
            echo "<tr><td>$cierreName</td></li>";
        }
        ?>
    </tbody>
</table>
