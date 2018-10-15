<?php

print "StartScript";
include("./system/config.php");
include("./system/system_model.php");

$system = new system_model();
$system->test();
$link = $system->connect();
$fm = fopen("./cards.txt","r");
while($line = fgets($fm)) {
        print $line;
		$line = trim($line);
		if(mysqli_query($link,"INSERT INTO cards SET card='".$line."'")){
			print " :: Added \n \r";
		} else {
			print mysqli_error();
		}
}

$system->disconnect($link);

print "StopScript";

