<?php
    include_once 'getOpenDays.php';
    function connectBox(){

        $mboxPath = '{imap.gmail.com:993/imap/ssl}';
        $username = 'test1234zebi@gmail.com';
        $password = 'test1234test1234'; 

        return $connexion = imap_open($mboxPath, $username, $password);
    }

    function connectBoxSent(){
        $mboxPathSend = '{imap.gmail.com:993/ssl}[Gmail]/Messages envoy&AOk-s';
        $username = 'test1234zebi@gmail.com';
        $password = 'test1234test1234';

        return $connexionSent = imap_open($mboxPathSend, $username, $password);
    }

    function checkBox($connexion){
        return $mboxChecked = imap_check($connexion);
    }

    function checkBoxSend($connexionSent){
        return $mboxSentChecked = imap_check($connexionSent);
    }

    function overviewBox($connexion, $mboxChecked){
        return $mboxOverview = imap_fetch_overview($connexion, "1:".$mboxChecked->Nmsgs);
    }

    function sortReceived($connexion, $mboxOverview){
        $inboxTab = array();
        $bus = array();
        $nb = 0;

        foreach($mboxOverview as $element){
            //$headerInfoMbox = imap_headerinfo($connexion, $element->msgno);
            if(htmlentities($element->answered) == true){
                $bus[0] = htmlentities($element->message_id);
                $bus[1] = strtotime(htmlentities($element->date));
                $bus[2] = htmlentities($element->msgno);
                $inboxTab[$nb] = $bus;
                //echo "<br/>\nSTOCKED IN ARRAY AS : inboxTab[".$nb."] => ".$inboxTab[$nb][0]." - ".$inboxTab[$nb][1]." - ".$inboxTab[$nb][2];
                $nb=$nb+1;
                $bus = array();
            }
        }

        return $inboxTab;
    }


    function sortSent($connexion, $mboxOverview, $inboxTab){

        $bus = array();
        $tabMatches = array();
        $countAnswered = count($inboxTab);
        foreach($mboxOverview as $element){

            if(isset($element->in_reply_to)){
                for($i=0;$i<$countAnswered;$i++){
                    if($inboxTab[$i][0]==htmlentities($element->in_reply_to)){

                        echo "<p><u>MATCH FOUND : </u></p>" ;
                        $delay = strtotime($element->date) - $inboxTab[$i][1];
                        $bus[0] = $inboxTab[$i][2];
                        $bus[1]=$delay;
                        $startDate = $inboxTab[$i][1];
                        $endDate = strtotime($element->date);
                        $openDays = getOpenDays($startDate, $endDate);

                        if ($openDays <= 5) {
                            $bus[2] = true;
                        }else{
                            $bus[2] = false;
                        }
                        $inboxTab[$i] =$bus ;
                        if($inboxTab[$i][2]== false) {
                            echo '<br/><br/>DATA STORED IN ARRAY AS $tabMatches['.$i.'] : inbox message number= '
                            .$inboxTab[$i][0].', delay = '
                            .$inboxTab[$i][1]
                            .', is mail valid = NONE ';
                            //.$inboxTab[$i][2];
                        }
                        else {
                            echo '<br/><br/>DATA STORED IN ARRAY AS $tabMatches['.$i.'] : inbox message number= '
                            .$inboxTab[$i][0].', delay = '
                            .$inboxTab[$i][1]
                            .', is mail valid= YES ';
                            //.$inboxTab[$i][2];
                        }
                        
                        //$tabMatches[$i] = $bus ;
                        $bus= array();
                    }
                }
            }
        }

        return $tabMatches;
    }

    function closeMbox($connexion, $connexionSent){
        imap_close($connexion);
        imap_close($connexionSent);
    }

    
?>