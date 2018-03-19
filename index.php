<?php

include("./system/config.php");
include("./system/system_controller.php");
include("./system/system_model.php");
include("./system/bae_html_lib.php");
include("./system/elements.php");

//router
if(!isset($_GET['mode'])) { $_GET['mode'] = "main";}
if(!isset($_GET['method'])) {$_GET['method'] = "start_form";}
if(!isset($_GET['param'])) {$_GET['param'] = "0"; }

if(isset($_GET['mode'])){
	$manifest = file("./mvc_manifest.php");
	$mode_error = true;
	for($i = 4; $i < sizeof($manifest); $i++){
		$manifest[$i] = str_replace("//","",$manifest[$i]);
		$manifest[$i] = trim($manifest[$i]);
                if($_GET['mode'] == $manifest[$i]) { $mode_error = false;}
	}
	if($mode_error == true) {
			exit("error:: ".$_GET['mode']." - is not manifested mode! / index.php");
		} else {
			require_once("./controllers/".$_GET['mode'].".php");
			require_once("./models/".$_GET['mode'].".php");
			$_GET['mode'] = $_GET['mode']."_controller";
			$_GET['do'] = $_GET['method'];
			$controller = new $_GET['mode'];
			$foo = $_GET['method'];
			$controller->$foo($_GET['param']);		
		}
}
