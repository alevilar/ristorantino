<ul class="menubread">
<?php
    $i=0;
    $menubread[$i]['name'] = 'Admin';
    $menubread[$i]['link'] = '/pages/administracion';
    
foreach($menubread as $k=>$m) {
        echo"<li style='display:inline;'>";
            echo $html->link($m['name'],$m['link']);
        echo"</li>"; 
        echo"»";
}
?>
</ul>