<?php

//$input = file_get_contents('test_part_1.txt');
$input = file_get_contents('input_part_1.txt');

$cards = array_filter(explode("\n", $input));

$points = 0;

foreach($cards as $card){
	$card = explode('|', substr($card,strpos($card,': ')+2));
	$winners = array_filter(explode(' ', $card[0]));
	$ours = array_filter(explode(' ', $card[1]));

	$matches = array_intersect($winners, $ours);
	
	if(count($matches) > 0){
		$points += 1 << count($matches)-1;
	}
}

echo $points;
