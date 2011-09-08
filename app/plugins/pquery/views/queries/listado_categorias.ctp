 <?php
 $cats = array();
 foreach ($categorias as $c) {
     $cats[] = $c['Query']['categoria'];
 }
echo json_encode($cats);