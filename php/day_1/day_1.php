<?php

//$input = file_get_contents('test_part_2.txt');
$input = file_get_contents('input_part_1.txt');

$digits = range(1,9);
$words = array(
	'one',
	'two', 
	'three',
	'four',
	'five',
	'six',
	'seven',
	'eight',
	'nine'
);


$processed = array();
$buffer = '';
$line = 0;
$out = array();

foreach(str_split($input) as $char){
	if(!isset($processed[$line])){
		$processed[$line] = array();
	}

	if($char == "\n"){
		$out[] = $processed[$line][0] . $processed[$line][count($processed[$line])-1];
		$line ++;
		$buffer = '';
		continue;
	}

	$buffer .= $char;
	
	foreach($digits as $digit){
		if(str_contains($buffer,$digit)){
			$processed[$line][] = $digit;
			$buffer = '';
			continue;
		}
	}

	
	foreach($words as $key=>$word){
		if(str_contains($buffer,$word)){
			$processed[$line][] = $key+1;
			$buffer = substr($buffer,-1,1);

		}
	}
}

//var_dump($processed);

echo array_sum($out);
