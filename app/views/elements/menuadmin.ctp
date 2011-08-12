<ul class="menubread">
<?php
//    $i=0;   
//    array_unshift($menubread[$i]['name'], 'Admin');
//    array_unshift($menubread[$i]['link'], '/pages/administracion');
    
if (!empty($rutaUrl_for_layout)){    
    foreach($rutaUrl_for_layout as $m) {
            echo"<li style='display:inline;'>";
                echo $html->link($m['name'],$m['link']);
            echo"</li>"; 
            echo"»";
    }
}


?>
</ul>