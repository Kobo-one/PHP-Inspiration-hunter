<?php

class Function{
    
    public static function getcolorname($mycolor) {
        // mycolor should be a 3 element array with the r,g,b values 
        // as ints between 0 and 255. 
        $colors = array(
            "red"       =>array(255,0,0),
            "yellow"    =>array(255,255,0),
            "green"     =>array(0,255,0),
            "cyan"      =>array(0,255,255),
            "blue"      =>array(0,0,255),
            "magenta"   =>array(255,0,255),
            "white"     =>array(255,255,255),
            "grey"      =>array(127,127,127),
            "black"     =>array(0,0,0)
        );
    
        $tmpdist = 255*3;
        $tmpname = "none";
        foreach($colors as $colorname => $colorset) {        
            $r_dist = (pow($mycolor[0],2) - pow($colorset[0],2));
            $g_dist = (pow($mycolor[1],2) - pow($colorset[1],2));       
            $b_dist = (pow($mycolor[2],2) - pow($colorset[2],2));
            $totaldist = sqrt($r_dist + $g_dist + $b_dist);
            if ($totaldist < $tmpdist) {        
                $tmpname = $colorname;
                $tmpdist = $totaldist;
            }
        }
        return $tmpname;
    }



}



?>