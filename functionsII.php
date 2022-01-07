<?php
include_once 'getOpenDays.php'; 
/**Fonction checkHeaders : 
 * renvoie un tableau 2D, contenant dans chaque cellule
 * array('message_id', 'date', 'msgno')
 */
function sortMailsReceived($mboxOverview){
    $bus = array();
    $inboxTab = array();
    $index = 0;

    foreach($mboxOverview as $element){
        if(($element->answered)==true){
            $bus[0] = htmlentities($element->message_id);
            $bus[1] = strtotime(htmlentities($element->date));
            $bus[2] = htmlentities($element->msgno);
            $inboxTab[$index] = $bus;
            $index+=1;
            $bus = array();
        }
    }

    return $inboxTab;
}

function sortMailsSent($mboxOverview, $inboxTab){

    $index = 0;
    $tabMatches = array();

    foreach($mboxOverview as $element){
        if(isset($element->in_reply_to)){ 
            for($i = 0 ; $i < count($inboxTab); $i++){
                if($inboxTab[$i][0]==htmlentities($element->in_reply_to)){ 
                    $bus = array();
                    $delay= strtotime($element->date) - $inboxTab[$i][1];
                    $bus[0]=$inboxTab[$i][2];
                    $bus[1]=$delay;
                    $startDay=$inboxTab[$i][1];
                    $endDay=strtotime($element->date);
                    $nbOpenDays=getOpenDays($startDay,$endDay);
                    if($nbOpenDays<=5){
                        $bus[2]=true;
                    }
                    if($nbOpenDays>5){
                        $bus[2]=0;
                    }
                    $tabMatches[$index] = $bus;
                    $index+=1;
                }
            }
        }
    }
    return $tabMatches;
}

function countMailTrue($tabMatches){
    $cptTrue = 0;

    foreach($tabMatches as $element){
        for($i = 0 ; $i < count($tabMatches);$i++){
            if($element[2] == true){
                $cptTrue+=1;
            }
        }
    }
    return $cptTrue ;
}

?>