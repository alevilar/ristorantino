<h1>Cierres</h1>

<ul id="cierre-list">
<?php
foreach ($cierres as $c) {
    $link = $html->link($c['Cierre']['name'], array('controller' => 'cierres', 'action'=>'view', $c['Cierre']['id']));
          
    
    $cierreName = "<span class='name'>$link</span>";
    $cierreName .= " <span class='fecha'>".date('d-m-Y H:i' , strtotime($c['Cierre']['created']))."</span>";
    echo "<li>$cierreName</li>";
    
}

?>
</ul>

<style>
    #cierre-list li span.action{
        
    }
    
    #cierre-list li:HOVER span.action{
        display: inline;
    }
    
    ul#cierre-list li ul{        
        display: none;
    }
    
    ul#cierre-list li ul li{         
    }
    
    ul#cierre-list li:HOVER ul{
        display: block;
    }
</style>
    