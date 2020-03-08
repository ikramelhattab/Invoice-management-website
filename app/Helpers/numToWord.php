<?php
if (! function_exists('tradd')) {
function tradd($num, $t1, $t2){
		$ch = '';
		if($num == 0){
			$ch = '';
		}
		else if($num < 20){
			$ch = $t1[$num];
		}
		else if($num >= 20){
			if (($num >= 70 && $num <= 79) || ($num >= 90)){
				$z = intval($num / 10) - 1;
			}
			else{
				$z = intval($num / 10);
			}
			$ch = $t2[$z];
			$num = $num - $z * 10;
			if(($num == 1 || $num == 11) && $z < 8){
				$ch = $ch . ' et';
			}
			if($num > 0){
				$ch = $ch . ' ' . tradd($num, $t1, $t2);
			}
			else{
				$ch = $ch . tradd($num, $t1, $t2);
			}
		}
		return $ch;
	}
}
if (! function_exists('tradn')) {
function tradn($num, $t1, $t2){
		$ch = '';
		$flagcent = False;
		if($num >= 1000000000){
			$z = intval($num / 1000000000);
			$ch = $ch . tradn($z, $t1, $t2) . ' milliard';
			if($z > 1){
				$ch = $ch + 's';
			}
			$num = $num - $z * 1000000000;
		}
		if($num >= 1000000){
			$z = intval($num / 1000000);
			$ch = $ch . tradn($z, $t1, $t2) . ' million';
			if($z > 1){
				$ch = $ch . 's';
			}
			$num = $num - $z * 1000000;
		}
		if($num >= 1000){
			if($num >= 100000){
				$z = intval($num / 100000);
				if($z > 1){
					$ch = $ch . ' ' . tradd($z, $t1, $t2);
				}
				$ch = $ch . ' cent';
				$flagcent = True;
				$num = $num - $z * 100000;
				if(intval($num / 1000) == 0 && $z > 1){
					$ch = $ch . 's';
				}
			}
			if($num >= 1000){
				$z = intval($num / 1000);
				if(($z == 1 && $flagcent) || $z > 1){
					$ch = $ch . ' ' . tradd($z, $t1, $t2);
				}
				$num = $num - $z * 1000;
			}
			$ch = $ch . ' mille';
		}
		if($num >= 100){
			$z = intval($num / 100);
			if($z > 1){
				$ch = $ch . ' ' . tradd($z, $t1, $t2);
			}
			$ch = $ch . " cent";
			$num = $num - $z * 100;
			if($num == 0 && $z > 1){
				$ch = $ch . 's';
			}
		}
		if($num > 0){
			$ch = $ch . " " . tradd($num, $t1, $t2);
		}
		return $ch;
	}
}
if (! function_exists('trad')) {	
function trad($nb, $unite="dinars", $decim="millimes"){
		$tmp = $nb;
		$nb = round($nb, 3);
		$t1 = ["", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix", "onze", "douze", "treize",
          "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf"];
		$t2 = ["", "dix", "vingt", "trente", "quarante", "cinquante", "soixante", "soixante-dix", "quatre-vingt",
          "quatre-vingt dix"];
		$z1 = intval($nb);
		$z3 = ($nb - $z1) * 1000;
		$z2 = intval(round($z3, 0));
		if($z1 == 0){
			$ch = "zéro";
		}
		else{
			$ch = tradn(abs($z1), $t1, $t2);
		}
		if($z1 > 1 || $z1 < -1){
			if($unite != ''){
				$ch = $ch . " " . $unite;
			}
		}
		else{
			$ch = $ch . " " . $unite;
		}
		if($z2 > 0){
			$c = explode('.', $nb);
			if(!empty($c[1])){
				$ch = $ch . " " . str_pad ( $c[1] , 3, "0", STR_PAD_RIGHT) . " " . $decim;
			}
			else{
				$ch = $ch . "0" . " " . $decim;
			}			
		}
		if($nb < 0){
			$ch = "moins " . $ch;
		}
		return $ch;
	}
}