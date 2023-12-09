<?php

//$input = file_get_contents('test_part_1.txt');
$input = file_get_contents('input_part_1.txt');

$cards = array_filter(explode("\n", $input));
$counts = array();

foreach($cards as $idx=>$card){
	$counts[$idx] = ($counts[$idx] ?? 0) + 1;
	$card = explode('|', substr($card,strpos($card,': ')+2));
	$winners = array_filter(explode(' ', $card[0]));
	$ours = array_filter(explode(' ', $card[1]));
	$matches = array_intersect($winners, $ours);
	$cardWinMap[$idx] = count($matches);
	
	for($i = $idx +1;$i <= $idx + count($matches); $i++){
		$counts[$i] = ($counts[$i] ?? 0) + $counts[$idx];
	}
}

echo array_sum($counts);
