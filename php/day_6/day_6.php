<?php

$input = explode("\n", file_get_contents('test_part_1.txt'));

$times = array_values(array_filter(explode(' ',str_replace('Time: ','',$input[0]))));
$distance = array_values(array_filter(explode(' ',str_replace('Distance: ','',$input[1]))));
var_dump($times);
var_dump($distance);

$wins = array();

foreach($times as $idx=>$time){
	$wins[$idx] = 0;

	foreach(range(1,$time)as $duration){
		$travelled = ($time-$duration)*$duration;

		if($travelled > $distance[$idx]){
			$wins[$idx]++;
		}
	}
}

echo array_product($wins);
