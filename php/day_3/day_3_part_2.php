<?php
//$input = file_get_contents('test_part_1.txt');
$input = file_get_contents('input_part_1.txt');

$map = array_filter(explode("\n",$input));

foreach($map as $key => $value){
	$map[$key] = str_split($value);
}

function look($x,$y,$map, $targets){
	$hit = 	false;
	if(in_array($map[$y][$x],$targets)){
		$hit = true;
	}

	return $hit;

}

function sweep ($x,$y, $map, $targets){
	$sweep = array();
	$sweep['left'] = array(max(0,$x-1),$y);
	$sweep['leftUp'] = array(max(0,$x-1),max(0,$y-1));
	$sweep['up'] = array($x,max(0,$y-1));
	$sweep['rightUp'] = array(min(count($map[$y])-1,$x+1),max(0,$y-1));
	$sweep['right'] = array(min(count($map[$y])-1,$x+1),$y);
	$sweep['rightDown'] = array(min(count($map[$y])-1,$x+1),min(count($map)-1,$y+1));
	$sweep['down'] = array($x,min(count($map)-1,$y+1));
	$sweep['leftDown'] = array(max(0,$x-1),min(count($map)-1,$y+1));

	$hits = array();
	
	foreach($sweep as $direction=>$look){
		if(look($look[0], $look[1], $map, $targets)){
			$hits[$direction] = getNumber($look[0], $look[1], $map);
		}
	}

	if(isset($hits['leftUp']) && isset($hits['up'])){
		unset($hits['leftUp']);
	}
	if(isset($hits['rightUp']) && isset($hits['up'])){
		unset($hits['rightUp']);
	}
	if(isset($hits['leftDown']) && isset($hits['down'])){
		unset($hits['leftDown']);
	}
	if(isset($hits['rightDown']) && isset($hits['down'])){
		unset($hits['rightDown']);
	}


	return $hits;
}

function getNumber($x,$y,$map){
	$buffer = array();
	$searchedLeft = $x>0?false:true;
	$searchedRight = $x<count($map[$x])-1?false:true;

	$buffer[] = $map[$y][$x];
	
	$i = 1;
	while(!$searchedLeft){
		$next = $x-$i;
		if(is_numeric($map[$y][$next])){
			array_unshift($buffer,$map[$y][$next]);
			$i++;
			if($next == 0){
				$searchedLeft = true;
			}
		}else{
			$searchedLeft = true;
		}

	}

	$i = 1;
	while(!$searchedRight){
		$next = $x+$i;
		if(is_numeric($map[$y][$next])){
			array_push($buffer,$map[$y][$next]);
			$i++;

			if($next == count($map[$x])-1){
				$searchedRight = true;
			}
		}else{
			$searchedRight = true;
		}

	}
	return implode('',$buffer);
}

$targets = range(0,9);
$parts = array();

foreach($map as $y=>$row){
	foreach($row as $x=>$value){
		if($value == '*'){
			$hits = sweep($x,$y,$map,$targets);

			if(count($hits) == 2){
				$parts[] = array_product($hits);
			}
		}
	}
}

//var_dump($parts);
echo array_sum($parts);
