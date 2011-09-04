<?php


class Count extends InventoryAppModel
{
    var $belongsTo = array('Inventory.Product');
}