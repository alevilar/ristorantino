<?php


class Count extends InventoryAppModel
{
    var $belongsTo = array('Inventory.Product');
    
    var $order = array('Count.modified DESC');
}