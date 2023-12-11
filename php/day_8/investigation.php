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


$loops = 3;

foreach($tests as $test){

	$current = $test;
	$steps = 0;
	$directionStep = 0;
	$finds = 0;

	$directionMap = array();
	$directionMap['L'] = 0;
	$directionMap['R'] = 1;

	$prevSteps = 0;

	while($finds < $loops){
		
		if(substr($current,-1,1) === 'Z'){
			$finds++;
			$gap = $steps - $prevSteps;
			$prevSteps = $steps;
			echo "$test ended at $current after $steps ($gap)\n"; 
		}

		$current = $nodes[$current][$directionMap[$directions[$directionStep]]];
		$steps++;
		++$directionStep < count($directions)?:$directionStep = 0;
	}
	echo"\n\n";
}	





