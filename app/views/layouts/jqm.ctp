
<!DOCTYPE html> 
<html> 
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title><?php echo $title_for_layout; ?></title> 
	
</head> 
<body> 

    <div data-role="page" id="<?php echo Inflector::slug(strtolower($title_for_layout))?>">
        <?php if ( $conHeader ) { ?>
		<div data-role="header">
			<h1><?php echo $title_for_layout; ?></h1>
		</div>
        <?php }?>

		<div data-role="content">
			    <?php echo $content_for_layout; ?>
		</div>
	</div>


</body>
</html>


