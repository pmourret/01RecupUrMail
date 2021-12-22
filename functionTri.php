<?php
    include_once 'getOpenDays.php';
    function sortMails($connexion,$connexionSent,$mboxOverview, $mboxOverviewSent){

    $inboxTab=array();
    $bus=array();
    $nb=0;

    foreach($mboxOverview as $element){
        $headerInfoInbox = imap_headerinfo($connexion, $element->msgno);
        //echo gettype($header->from)[$element->msgno]."<br/>\n";
        /*echo "<pre>";
        echo "Mail number ".$element->msgno." : <br/>\nIS MAIL ANSWERED : ".htmlentities($element->answered);
        echo "<br/>\nMESSAGE FROM : " . ($headerInfoInbox->from)[0]->mailbox."@".($headerInfoInbox->from)[0]->host;
        echo "<br/>\nMAIL UID : " . htmlentities($element->message_id);
        */
        if(htmlentities($element->answered)==true){
            $bus[0]=htmlentities($element->message_id);
            $bus[1]=strtotime(htmlentities($element->date));
            $bus[2]=htmlentities($element->msgno);
            $inboxTab[$nb]=$bus;
            //echo "<br/>\nSTOCKED IN ARRAY AS : inbox_tab[".$nb."] =>".$inboxTab[$nb][0]." - ".$inboxTab[$nb][1]." - ".$inboxTab[$nb][2];
            $nb=$nb+1;
            $bus=array();
        }

        //echo "</pre><br/>\n";
   
    }

    $countAnswered=count($inboxTab);
    $nbTabMatches=0;
    $tabMatches=array();

    //++++++++++MAIL SENT++++++++++++++++++

    //echo "<h1>MAIL SENT</h1>";
    $sentCheck=imap_check($connexionSent);// renvoie : Date - Driver - Mailbox - Nmsgs - Recent
    $mboxOverviewSent = imap_fetch_overview($connexionSent,"1:".$sentCheck->Nmsgs);

    //echo "1 FOR ANSWERED, 0 FOR NOT ANSWERED <br/>\n";
    foreach($mboxOverviewSent as $element){
        $headerinfoSent = imap_headerinfo($connexionSent, $element->msgno);
        /*//echo gettype($header->from)[$element->msgno]."<br/>\n";
        echo "<pre>";
        echo "Mail number ".$element->msgno." : <br/>\nIS MAIL ANSWERED : ".htmlentities($element->answered);
        echo "<br/>\nMESSAGE FROM : " . ($headerinfoSent->from)[0]->mailbox."@".($headerinfoSent->from)[0]->host;
        echo "<br/>\nMAIL UID : " . htmlentities($element->message_id);*/
    
        if(isset($element->in_reply_to)){
            //echo "<br/>\nIN REPLY TO : " . htmlentities($element->in_reply_to);  
            for($i=0;$i<$countAnswered;$i++){
                if($inboxTab[$i][0]==htmlentities($element->in_reply_to)){
                    //echo "<br/>\nA MAIL MATCH HAS BEEN FOUND : Message N°" . $inboxTab[$i][2] . " in the INBOX.";
                    $delay= strtotime($element->date) - $inboxTab[$i][1];
                    //echo "<br/>\n(DATE SENT)".strtotime($element->date)." - (DATE RECEIVED)".$inboxTab[$i][1]." = ".$delay;
                    //echo "<br/>\nDELAY BETWEEN MAIL RECEVEID AND MAIL SENT : ".$delay;
                    $bus[0]=$inboxTab[$i][2];
                    $bus[1]=$delay;
                    $startDay=$inboxTab[$i][1];
                    $endDay=strtotime($element->date);
                    $nbOpenDays=getOpenDays($startDay,$endDay);
                    //echo '<br/><br/>Il y a '.$nbOpenDays.' jours ouvr&eacute;s entre le '.date('d/m/Y', $startDay).' et le '.date('d/m/Y', $endDay);
                    if($nbOpenDays<=5){
                        $bus[2]=true;
                    }
                    if($nbOpenDays>5){
                        $bus[2]=false;
                    }
                    $tabMatches[$nbTabMatches]=$bus;
                    /*echo '<br/><br/>DATA STORED IN ARRAY AS $tabMatches['.$nbTabMatches.'] : inbox message number='
                    .$tabMatches[$nbTabMatches][0]
                    .', delay='.$tabMatches[$nbTabMatches][1]
                    .', mail is valid='.$tabMatches[$nbTabMatches][2];*/
                    $bus=array();
                    $nbTabMatches=$nbTabMatches+1;
            }
        }
    }
   // echo "</pre><br/>\n"; 
    }
    return $tabMatches;
}


?>