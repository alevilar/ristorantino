<?php
class Category extends PqueryAppModel {

	var $name = 'Category';


	var $hasMany = array( 'Pquery.Query' );

}
?>