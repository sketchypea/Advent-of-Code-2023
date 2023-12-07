<?php

//$input = file_get_contents('test_part_1.txt');
$input = file_get_contents('input_part_1.txt');

$games = array_filter(explode("\n",$input));

$limits = array();
$limits['red'] = 12;
$limits['blue'] = 14;
$limits['green'] = 13;

$possibleGameIds = array();

foreach($games as $idx=>$game){
	$impossible = false;
		
	$game = substr($game,strpos($game,': ')+2);
	$rounds = explode('; ',$game);

	foreach($rounds as $round){
		foreach(explode(', ',$round) as $blocks){
			$parts = explode(' ',$blocks);
			if($parts[0] > $limits[$parts[1]]){
				$impossible = true;
				break 2;
			}

		}
	}

	if(!$impossible){
		$possibleGameIds[] = $idx + 1;
	}
}


//var_dump($possibleGameIds);
echo array_sum($possibleGameIds);
