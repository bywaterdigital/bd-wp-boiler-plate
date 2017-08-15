<?php 
$path = '_tpl/_tpl_standard-page.php';

//force template if necessary - base on page id
switch($pageID){
	//case 0: $path = '_tpl/_tpl_standard-page.php'; break;
}

//include template file
include($path);
?>