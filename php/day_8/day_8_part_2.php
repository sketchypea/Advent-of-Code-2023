<?php

//$input = array_filter(explode("\n", file_get_contents('test.txt')));
$input = array_filter(explode("\n", file_get_contents('input.txt')));

$directions = str_split(array_shift($input));

$nodes = array();

foreach($input as $line){
	$line = explode(' = ', $line);
	$nodes[$line[0]] = explode(',',str_replace(array(' ', '(', ')'),'',$line[1]));
	$nodes[$line[0]]['key'] = $line[0];
}

$tests = array();

foreach($nodes as $key=>$node){
	if(substr($key,-1,1) === 'A'){
		$tests[] = $key;
	}
}

$directionMap = array();
$directionMap['L'] = 0;
$directionMap['R'] = 1;

$stepCounts = array();

foreach($tests as $test){

	$current = $test;
	$steps = 0;
	$directionStep = 0;

	while(substr($current,-1,1) !== 'Z'){
		$current = $nodes[$current][$directionMap[$directions[$directionStep]]];
		$steps++;
		++$directionStep < count($directions)?:$directionStep = 0;
	}

	$stepCounts[] = $steps;
}

//https://www.alphacodingskills.com/php/pages/php-program-find-lcm-of-two-numbers.php
function getLCM($x, $y){
	if ($x > $y) {
		$temp = $x;
		$x = $y;
		$y = $temp;
	}

	for($i = 1; $i < ($x+1); $i++) {
		if ($x%$i == 0 && $y%$i == 0)
		$gcd = $i;
	}
	
	$lcm = ($x*$y)/$gcd;

	return $lcm;
}


function getLCMMultiple($numbers){
	if(count($numbers) == 2){
		return getLCM($numbers[0], $numbers[1]);
	}else{
		return getLCM(array_shift($numbers),getLCMMultiple($numbers));
	}
}


echo getLCMMultiple($stepCounts);
