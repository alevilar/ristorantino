<?php


class Product extends InventoryAppModel
{
    var $hasMany = array(
        'Inventory.Count'
        );
    
    var $belongsTo = array('Inventory.Category');
    
}