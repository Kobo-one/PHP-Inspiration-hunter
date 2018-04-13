<?php
function timeAgo($pTime){
    // tijdzone veranderen naar brusselse
    date_default_timezone_set("Europe/Brussels");
    
    $postTime = new DateTime($pTime);
    $currentTime = new DateTime();
    //verschil tussen timestamp post en current time
    $interval = $currentTime->diff($postTime);

    if ($interval->h==0  && $interval->d==0 && $interval->m==0 && $interval->y==0){
        return $interval->format('%i minute(s) ago')."\n";
    }
    if ($interval->d==0 && $interval->m==0 && $interval->y==0){
        return $interval->format('%h hour(s) ago')."\n";
    }
    if($interval->m==0 && $interval->y==0){
        return $interval->format('%a day(s) ago')."\n";
    }
    if($interval->y==0){
        return $interval->format('%m month(s) ago');
    }
    if($interval->y>=1){
        return $interval->format('%y year(s) ago');
    }
}

?>