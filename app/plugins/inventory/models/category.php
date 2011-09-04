<?php


class Category extends InventoryAppModel
{
    var $hasMany = array('Inventory.Product');
}