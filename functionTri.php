<?php
    include_once 'getOpenDays.php';

    function sortMails($connexion,$connexionSent,$mboxOverview, $mboxOverviewSent){
    $inboxTab=array();
    $bus=array();
    $nb=0;
    $cptFalse=0;
    $cptTrue=0;
    $nbMails = 0;

    foreach($mboxOverview as $element){
        $headerInfoInbox = imap_headerinfo($connexion, $element->msgno);
    
        if(htmlentities($element->answered)==true){
            $bus[0]=htmlentities($element->message_id);
            $bus[1]=strtotime(htmlentities($element->date));
            $bus[2]=htmlentities($element->msgno);
            $inboxTab[$nb]=$bus;
            $nb=$nb+1;
            $bus=array();
            $nbMails = $nbMails+1;
        }

    }

    $countAnswered=count($inboxTab);
    $nbTabMatches=0;
    $tabMatches=array();

    //++++++++++MAIL SENT++++++++++++++++++

    $sentCheck=imap_check($connexionSent);// renvoie : Date - Driver - Mailbox - Nmsgs - Recent
    $mboxOverviewSent = imap_fetch_overview($connexionSent,"1:".$sentCheck->Nmsgs);


    foreach($mboxOverviewSent as $element){
        $headerinfoSent = imap_headerinfo($connexionSent, $element->msgno);
    
        if(isset($element->in_reply_to)){
            for($i=0;$i<$countAnswered;$i++){
                if($inboxTab[$i][0]==htmlentities($element->in_reply_to)){
                    $delay= strtotime($element->date) - $inboxTab[$i][1];
                    $bus[0]=$inboxTab[$i][2];
                    $bus[1]=$delay;
                    $startDay=$inboxTab[$i][1];
                    $endDay=strtotime($element->date);
                    $nbOpenDays=getOpenDays($startDay,$endDay);
                    if($nbOpenDays<=5){
                        $bus[2]=true;
                        $cptTrue = $cptTrue + 1;
                    }
                    if($nbOpenDays>5){
                        $bus[2]=false;
                        $cptFalse = $cptFalse + 1;
                    }
                    $tabMatches[$nbTabMatches]=$bus;
                    if($inboxTab[$i][2]== false) {
                        //echo '<br/><br/>DATA STORED IN ARRAY AS $tabMatches['.$i.'] : inbox message number= '
                        //.$inboxTab[$i][0].', delay = '
                        //.$inboxTab[$i][1]
                        //.', is mail valid = NONE ';
                        //.$inboxTab[$i][2];
                    }
                    else {
                        //echo '<br/><br/>DATA STORED IN ARRAY AS $tabMatches['.$i.'] : inbox message number= '
                        //.$inboxTab[$i][0].', delay = '
                        //.$inboxTab[$i][1]
                        //.', is mail valid= YES ';
                        //.$inboxTab[$i][2];
                    }
                    $bus=array();
                    $nbTabMatches=$nbTabMatches+1;
            }
        }

    }
}
    return $tabMatches;
}


?>