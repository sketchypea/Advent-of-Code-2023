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


$target = 'ZZZ';
$current = 'AAA';
$steps = 0;
$directionStep = 0;

$directionMap = array();
$directionMap['L'] = 0;
$directionMap['R'] = 1;

while($current != $target){
	$current = $nodes[$current][$directionMap[$directions[$directionStep]]];
	$steps++;
	++$directionStep < count($directions)?:$directionStep = 0;
}

echo "$steps\n";
