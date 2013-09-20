<?php 

class Stat{
	
	function median($data){
		$median = $this->percentile($data,50);
		return $median;
	}
	
	function percentile($data,$percentile){
		if( 0 < $percentile && $percentile < 1 ) {
			$p = $percentile;
		}else if( 1 < $percentile && $percentile <= 100 ) {
			$p = $percentile * .01;
		}else {
			return "";
		}
		$count = count($data);
		$allindex = ($count-1)*$p;
		$intvalindex = intval($allindex);
		$floatval = $allindex - $intvalindex;
		sort($data);
		if(!is_float($floatval)){
			$result = $data[$intvalindex];
		}else {
			if($count > $intvalindex+1)
				$result = $floatval*($data[$intvalindex+1] - $data[$intvalindex]) + $data[$intvalindex];
			else
				$result = $data[$intvalindex];
		}
		return $result;
	}
	
	function quartiles($data) {
		$q1 = $this->percentile($data,25);
		$q2 = $this->percentile($data, 50);
		$q3 = $this->percentile($data, 75);
		$quartile = array ( '25' => $q1, '50' => $q2, '75' => $q3);
		return $quartile;
	}
	
}
?>
