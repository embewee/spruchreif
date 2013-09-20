<?php

function median()
{
    $args = func_get_args();

    switch(func_num_args())
    {
        case 0:
            trigger_error('median() requires at least one parameter',E_USER_WARNING);
            return false;
            break;

        case 1:
            $args = array_pop($args);
            // fallthrough

        default:
            if(!is_array($args)) {
                trigger_error('median() requires a list of numbers to operate on or an array of numbers',E_USER_NOTICE);
                return false;
            }

            sort($args);
           
            $n = count($args);
            $h = intval($n / 2);

            if($n % 2 == 0) {
                $median = ($args[$h] + $args[$h-1]) / 2;
            } else {
                $median = $args[$h];
            }

            break;
    }
   
    return $median;
}

function mypercentile($data,$percentile){
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

?>
