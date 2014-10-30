<?php
require "phpQuery.php";
function getPrice($url){
	$c=curl_init();
	curl_setopt($c,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($c,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
	curl_setopt($c,CURLOPT_URL,$url);
	$p=curl_exec($c);
	preg_match_all("/<link[^>]+\"([^>]+\.css).*?\"[^>]*>/",$p,$m);
	$p=phpQuery::newDocumentHTML($p);
	$css="";
	foreach($m[1] as $url){
		curl_setopt($c,CURLOPT_URL,$url);
		$css.=curl_exec($c);
	}
	curl_close($c);
	$css=explode("}",$css);
	$d=[];
	foreach($css as $cssp){
		if(strpos($cssp,"font-size:")===false && strpos($cssp,"color:")===false){
			continue;
		}
		if(stripos($cssp,"price")===false){
			continue;
		}
		$cssp=explode("{",$cssp);
		$cssp[1]=explode(";",$cssp[1]);
		$ok=false;
		$rel=0;
		$f=0;
		foreach($cssp[1] as $r){
			$r=trim($r);
			if(empty($r)){
				continue;
			}
			$r=explode(":",$r);
			if($r[0]=="font-size"){
				$ok=true;
				$rel+=2;
				if(strpos($r[1],"em")){
					$f=floatval($r[1])*100;
				}
				else{
					$f=floatval($r[1]);
				}
			}
			if($r[0]=="color"){
				$ok=true;
				$rel++;
			}
		}
		if(!$ok){
			continue;
		}
		array_push($d,["q"=>trim($cssp[0]),"rel"=>$rel,"f"=>$f]);
	}
	usort($d,function($a,$b){
		return ($a["rel"]<$b["rel"])?1:-1;
		return ($a["f"]<$b["f"])?1:-1;
		return 0;
	});
	$min=0;
	foreach($d as $q){
		preg_match("/.*?([0-9][0-9,.]+[0-9])/",pq($p[$q["q"]])->text(),$m);
		if(isset($m[1])){
			$m[1]=preg_replace("/[^0-9.]/","",$m[1]);
			$m[1]=floatval($m[1]);
			if($q["rel"]>=3){
				$min=$m[1];
			}
			if($min==0 || ($min>=$m[1] && abs((($m[1]-$min)*100/$min))<=20)){
				$min=$m[1];
			}
			else{
				break;
			}
		}
	}
	return $min;
}
?>
