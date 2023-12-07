<?php

//$input = file_get_contents('test_part_1.txt');
$input = file_get_contents('input_part_1.txt');

$games = array_filter(explode("\n",$input));

$powers = array();

foreach($games as $game){
	$max = array();
	$max['red'] = 0;
	$max['blue'] = 0;
	$max['green'] = 0;

	foreach(explode(', ',str_replace(';',',',substr($game,strpos($game,': ')+2))) as $blocks){
		$parts = explode(' ', $blocks);

		if($parts[0] > $max[$parts[1]]){
			$max[$parts[1]] = $parts[0];
		}
	}

	$powers[] = array_product($max);
}

echo array_sum($powers);
