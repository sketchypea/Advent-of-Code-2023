<?php

//$input = file_get_contents('test_part_1.txt');
$input = file_get_contents('input_part_1.txt');

$hands = array_filter(explode("\n", $input));

$ranked = array();



function sortHands($a,$b){
	$cardStrength = array(2,3,4,5,6,7,8,9,'T','J','Q','K','A');

	$weight = 0;
	
	if($a['type'] > $b['type']){
		$weight = 1;
	}
	if($a['type'] < $b['type']){
		$weight = -1;
	}
	
	if($a['type'] === $b['type']){
		$aa = str_split($a['cards']);
		$bb = str_split($b['cards']);
		
		foreach($aa as $idx=>$ac){
			if(array_search($ac,$cardStrength) > array_search($bb[$idx],$cardStrength)){
				$weight = 1;
				break;
			}
			if(array_search($ac,$cardStrength) < array_search($bb[$idx],$cardStrength)){
				$weight = -1;
				break;
			}
		}
	}
	return $weight;
}

foreach($hands as $hand){
	$split = explode(' ', $hand);
	$cards = $split[0];
	$bid = $split[1];
	
	$cardCounts = array_count_values(str_split($cards));
	arsort($cardCounts);
	reset($cardCounts);
	
	$type = match(current($cardCounts)){
		5=>6,
		4=>5,
		3=>next($cardCounts)==2?4:3,
		2=>next($cardCounts)==2?2:1,
		1=>0
	};

	$ranked[] = array('type'=>$type,'cards'=>$cards,'bid'=>$bid);
}

usort($ranked,'sortHands');

$total = 0;
foreach($ranked as $rank=>$hand){ 
	$total += $hand['bid'] * ($rank + 1);
}

echo $total;
