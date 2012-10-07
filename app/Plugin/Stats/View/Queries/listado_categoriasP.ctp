<ul>
 <?php foreach($categorias as $c): ?>
     <li><?php  	
    
     	$cat = str_replace($string_categoria,"<b>$string_categoria</b>",$c['Query']['categoria']);
     	
     	echo trim($cat); 
     ?></li>
 <?php endforeach; ?>
</ul> 