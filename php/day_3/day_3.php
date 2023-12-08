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

	foreach($sweep as $direction=>$look){
		if(look($look[0], $look[1], $map, $targets)){
			return true;
		}
	}

	return false;
}

$chars = range(0,9);
$chars[] = '.';
$chars[] = "\n";
$targets = array_unique(str_split(str_replace($chars,'',$input)));

$parts = array();

$buffer = '';
$adjacentSymbolFound = false;

foreach($map as $y=>$row){
	if($adjacentSymbolFound){
		$parts[] = $buffer;
	}
	$buffer = '';
	$adjacentSymbolFound = false;

	foreach($row as $x=>$value){
	
		if(is_numeric($value)){
	
			$buffer .= $value;

			if(!$adjacentSymbolFound){
	
				if(sweep($x,$y,$map,$targets)){
					$adjacentSymbolFound = true;
				}
			}
		}else{
			if($adjacentSymbolFound){
				$parts[] = $buffer;
			}
			
			$buffer = '';
			$adjacentSymbolFound = false;
		}
	}
}

//var_dump($parts);
echo array_sum($parts);
