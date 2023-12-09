<?php

$input = explode("\n", file_get_contents('test_part_1.txt'));

$time = str_replace(array('Time:',' '),'',$input[0]);
$distance = str_replace(array('Distance:',' '),'',$input[1]);

$wins = 0;

echo "$time\n";
echo "$distance\n";

for($i=1;$i<=$time;$i++){
	$travelled = ($time-$i)*$i;
	if($travelled > $distance){
		$wins++;
	}
}


echo $wins;
