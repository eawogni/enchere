<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 10/02/2019
 * Time: 12:18
 */
require C_ROOT .'/model/CategorieManager.php';
require  C_ROOT . '/model/Bdd.php';
$categories =CategorieManager::getCategories();
require C_ROOT .'/vues/vueCategories.php';