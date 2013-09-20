<?php

include('math.php');
require_once("Stat.class.php");
	
function analyse($text){
	$sent=explode(".",$text);
	$words=tokenize($text);
	echo "<table border='1' style='width:30%;margin-left:10%;float:left'>\n"
	    .ch("Absolutes")
	    .row(kv("Text-L&auml;nge (in Zeichen):",strlen($text)))
	    .row(kv("Zahl der W&ouml;rter",count($words)))
	    .row(kv("Zahl der Abs&auml;tze",count(explode("\n",$text))-count(explode("\n\n",$text))))
	    .row(kv("Zahl der S&auml;tze",count($sent)))
	    .ch("Medians,Max,Min")
	    .row(kv("Satz-L&auml;ngen (in W&ouml;rtern):",slen($sent)))
	    .row(kv("Wort-L&auml;nge (in Zeichen)",wlen($words)))
	    .row(kv("Zahl der Nebens&auml;tze (je Satz)",ncount($sent)))
	    ."</table>"; 
	echo "<table border='1' style='width:30%;float:left'>\n"
	    .ch("Wort-H&auml;ufigkeiten (Stopwords gefiltert)")
	    .cwords($words)
	    ."</table>"; 
}

function kv($k,$v){
	return "<td>".$k."</td><td>".$v."</td>";
}

function row($s){
	return "<tr>".$s."</tr>\n";
}

function ch($text){
	return row("<td colspan=\"2\" style=\"text-align:center;font-weight:bold\">".$text."</td>");
}

function slen($sentences){
	$slen=array();
	foreach($sentences as $s){
		array_push($slen,count(explode(" ",$s)));
	}
	$stat = new Stat();
	return "{".implode(", ", $stat->quartiles($slen))."}\n"
	      ."<br/><img src=\"img.php?"
	      ."q1=".$stat->percentile($slen,25)
	      ."&q2=".$stat->percentile($slen,75)
	      ."&e=".$stat->percentile($slen,50)
	      ."&i=".$stat->percentile($slen,2)
	      ."&a=".$stat->percentile($slen,99)."\"/>";
}

function wlen($words){
	$wlen=array();
	for($i=0; $i<count($words); $i++){
		array_push($wlen,strlen($words[$i]));
	}
	$stat = new Stat();
	return "{".implode(", ", $stat->quartiles($wlen))."}\n"
	      ."<br/><img src=\"img.php?"
	      ."q1=".$stat->percentile($wlen,25)
	      ."&q2=".$stat->percentile($wlen,75)
	      ."&e=".$stat->percentile($wlen,50)
	      ."&i=".$stat->percentile($wlen,2)
	      ."&a=".$stat->percentile($wlen,99)."\"/>";
}

function ncount($sentences){
	$ncount=array();
	foreach($sentences as $s){
		array_push($ncount,count(explode(",",$s)));
	}

	$stat = new Stat();
	return "{".implode(", ", $stat->quartiles($ncount))."}\n"
	      ."<br/><img src=\"img.php?"
	      ."q1=".$stat->percentile($ncount,25)
	      ."&q2=".$stat->percentile($ncount,75)
	      ."&e=".$stat->percentile($ncount,50)
	      ."&i=".$stat->percentile($ncount,2)
	      ."&a=".$stat->percentile($ncount,99)."\"/>";
}

function tokenize($text){
	$w=strtok($text,",. ");
	$words=array($w);
	while($w !== false){
		$w=strtok(",. ");
		array_push($words,$w);
	}
	return $words;
}

function cwords($words){
	$cwords="";
	$words=array_filter(array_filter($words),"filter_stops");
	$w=array_count_values($words);
	asort($w);
	foreach (array_slice(array_reverse($w),0,20) as $key => $value) {
		$cwords=$cwords.row(kv($key,$value));
	}
	return $cwords;
}

function filter_stops($w){
	$stops=array("aber", "als", "am", "an", "auch", "auf", "aus", "bei", "bin", "bis", "bist", "da", "dadurch", "daher", "darum", "das", "daß", "dass", "dein", 			"deine", "dem", "den", "der", "des", "dessen", "deshalb", "die", "dies", "dieser", "dieses", "doch", "dort", "du", "durch", "ein", "eine", "einem", 			"einen", "einer", "eines", "er", "es", "euer", "eure", "für", "hatte", "hatten", "hattest", "hattet", "hier", "hinter", "ich", "ihr", "ihre", 			"ihm", "ihn", "im", "in", "ist", "ja", "jede", "jedem", "jeden", "jeder", "jedes", "jener", "jenes", "jetzt", "kann", "kannst", "können", "könnt", 			"machen", "mein","meine", "mit", "muß", "mußt", "musst", "müssen", "müßt", "nach", "nachdem", "nein", "nicht", "nun", "oder", "seid", "sein", "seine", 			"sich", "sie","sind", "soll", "sollen", "sollst", "sollt", "sonst", "soweit", "sowie", "und", "unser 	", "unsere", "unter", "vom", "von", "vor", 			"wann", "war","warum", "was", "weiter", "weitere", "wenn", "wer", "werde", "werden", "werdet", "weshalb", "wie", "wieder", "wieso", "wir", "wird", 			"wirst", "wo","woher", "wohin", "zu", "zum", "zur", "über");
	return !in_array(strtolower($w),$stops);
}


?>
