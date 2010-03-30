<ul>
    <? debug($users);?>
 <?php foreach($users as $id=>$name): ?>
     <li><?php echo $name; ?></li>
 <?php endforeach; ?>
</ul> 