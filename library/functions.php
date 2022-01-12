<?php
    /********************** Fonction de comptage des jours ouvrés ************************/
    function getOpenDays($date_start, $date_stop) {
        $arr_bank_holidays = array(); // Tableau des jours feriés
  
        // On boucle dans le cas où l'année de départ serait différente de l'année d'arrivée
        $diff_year = date('Y', $date_stop) - date('Y', $date_start);
        for ($i = 0; $i <= $diff_year; $i++) {
            $year = date('Y', $date_start) + $i;
            // Liste des jours feriés
            $arr_bank_holidays[] = '1_1_'.$year; // Jour de l'an
            $arr_bank_holidays[] = '1_5_'.$year; // Fete du travail
            $arr_bank_holidays[] = '8_5_'.$year; // Victoire 1945
            $arr_bank_holidays[] = '14_7_'.$year; // Fete nationale
            $arr_bank_holidays[] = '15_8_'.$year; // Assomption
            $arr_bank_holidays[] = '1_11_'.$year; // Toussaint
            $arr_bank_holidays[] = '11_11_'.$year; // Armistice 1918
            $arr_bank_holidays[] = '25_12_'.$year; // Noel
  
            // Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote
            $easter = easter_date($year);
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
            $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote
        }

        $nb_days_open = 0;
        while ($date_start < $date_stop) {
        // Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés
            if (!in_array(date('w', $date_start), array(0, 6))&& !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)) {
                $nb_days_open++;
            }
            $date_start += 86400;
        }
        return $nb_days_open;
    }

    function checkPath(){
        $imapGoogle = '{imap.gmail.com:993/ssl}';
        $imapOutlook = '{outlook.office365.com:993/imap/ssl/novalidate-cert}';
        
        $imapGoogleIn = '{imap.gmail.com:993/ssl}INBOX';
        $imapOutlookIn = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Inbox';

        if ($_POST['serveur'] == $imapGoogle){
            $mboxPath = $imapGoogleIn;
        }
        else if ($_POST['serveur'] == $imapOutlook){
            $mboxPath = $imapOutlookIn ;
        }
        else{
            echo "Type de boîte mail non supporté";
        }
        return $mboxPath ;
    }

    function checkPathSent(){

        $imapGoogle = '{imap.gmail.com:993/ssl}';
        $imapOutlook = '{outlook.office365.com:993/imap/ssl/novalidate-cert}';

        $imapGoogleSent = '{imap.gmail.com:993/ssl}[Gmail]/Messages envoy&AOk-s';
        $imapOutlookSent = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Sent';

        if ($_POST['serveur'] == $imapGoogle){
            $mboxPathSend = $imapGoogleSent;
        }
        if ($_POST['serveur'] == $imapOutlook){
            $mboxPathSend = $imapOutlookSent ; 
        }
        else{
            echo "Type de boîte mail non supporté";
        }
        return $mboxPathSend ;
    }

    function connectBoxAdmin(){
        if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
            $mboxPath = '{outlook.office365.com:993/imap/ssl/novalidate-cert}';
            $mbox = 'testproj1234@outlook.fr';
            $password = "test1234test1234";
        }
        return imap_open($mboxPath, $mbox, $password);
    }

    function connectBoxSentAdmin(){
        if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
            $mboxPathSent = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Sent';
            $mbox = 'testproj1234@outlook.fr';
            $password = "test1234test1234";
        }
        return imap_open($mboxPathSent, $mbox, $password);
    }

    function connectBox($mboxServer){

        $mboxPath = $mboxServer;//{outlook.office365.com:993/imap/ssl/novalidate-cert}Inbox';
        $username= $_POST['username'];//'testproj1234@outlook.fr';
        $password= $_POST['password'];//'test1234test1234';
        return imap_open($mboxPath, $username, $password);
    }

    function connectBoxSent($mboxServerSend){
        $mboxPathSend = $mboxServerSend;//'{outlook.office365.com:993/imap/ssl/novalidate-cert}Sent';
        $username=$_POST['username'];//'testproj1234@outlook.fr';
        $password=$_POST['password'];//'test1234test1234';

        return imap_open($mboxPathSend, $username, $password);
    }

    function checkBox($connexion){
        return imap_check($connexion);
    }

    function overviewBox($connexion, $mboxChecked){
        return imap_fetch_overview($connexion, "1:".$mboxChecked->Nmsgs);
    }

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
                            $bus[2]=1;
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

    function getOpenDaysMailReceived($mboxOverview){
        $cptUnderFive=0;
        foreach($mboxOverview as $element){
            $endDay=time();
            $startDay=strtotime($element->date);
            $nbOpenDays=getOpenDays($startDay,$endDay);
            if(($nbOpenDays<=5) && ($element->answered != "A")){
                $cptUnderFive+=1;
            }
        }
        return $cptUnderFive;
    }

    function countMailTrue($tabMatches){
        $cptTrue = 0;
    
        foreach($tabMatches as $element){
            for($i = 0 ; $i < count($tabMatches);$i++){
                if($element[2] == 1){
                    $cptTrue+=1;
                }
            }
        }
        return $cptTrue ;
    }

    function countMailFalse($tabMatches){
        $cptFalse= 0;
    
        foreach($tabMatches as $element){
            for($i = 0 ; $i < count($tabMatches);$i++){
                if($element[2] == 0){
                    $cptFalse+=1;
                }
            }
        }
        return $cptFalse ;
    }

    /******************* Fonction liées à la BDD **********************/

    function removeChar($string){
        $string=ltrim($string,"<");
        $string=rtrim($string,">");
        return $string;
    }

    function stockageBdd($conImapInbox,$conImapSent,$loginBdd,$mdpBdd){
        //recup liste des uid mails recus bdd
        $ini = parse_ini_file('conf.ini');
        $tableName="email_received";
        $tableNameSent="email_sent";
        try{
            $dbh=new PDO("mysql:host=".$ini['dataBaseHost'].";dbname=".$ini['dataBaseName']."",$loginBdd,$mdpBdd);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT mail_uid FROM ".$tableName."";        
            $sth = $dbh->prepare($query);
            $sth->execute();
            $liste=$sth->fetchAll();  //$liste est un array rempli d'uid de mails recus   
    
            $sth=null; 
            $dbh=null;
        }catch(PDOException $e){
            echo "<p>Erreur : ".$e->getMessage();
            die();
        }
        try{
            $dbh=new PDO("mysql:host=localhost;dbname=csnj",$loginBdd,$mdpBdd);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT mail_uid FROM ".$tableNameSent."";        
            $sth = $dbh->prepare($query);
            $sth->execute();
            $listeSent=$sth->fetchAll();  //$liste est un array rempli d'uid de mails recus   
    
            $sth=null; 
            $dbh=null;
        }catch(PDOException $e){
            echo "<p>Erreur : ".$e->getMessage();
            die();
        }
        //recup uid mails recus
    
        $inboxCheck=imap_check($conImapInbox);
        $inboxMailOverview = imap_fetch_overview($conImapInbox,"1:".$inboxCheck->Nmsgs);
        $inboxCheckSent=imap_check($conImapSent);
        $inboxMailOverviewSent = imap_fetch_overview($conImapSent,"1:".$inboxCheckSent->Nmsgs);
    
        foreach($inboxMailOverview as $element){
            $headerinfoInbox = imap_headerinfo($conImapInbox, $element->msgno);
            if(($headerinfoInbox->from)[0]->host=="intradef.gouv.fr"){ //si c'est une adresse mail @intradef.gouv.fr qui a envoyé le mail on ne le traite pas
                break;
            }else{
                $flag=false;
                $mailUid=$element->message_id;
                $mailUid=removeChar($mailUid);
                $sentBy=($headerinfoInbox->from)[0]->mailbox."@".($headerinfoInbox->from)[0]->host;
                $dateReception=htmlentities($element->date);
                $answered=htmlentities($element->answered);
                foreach($liste as $element){
                    if(in_array($mailUid,$element)){
                        $flag=true;
                    }
                }
                
                if($flag==false){
                    try{
                        $dbh=new PDO("mysql:host=localhost;dbname=csnj",$loginBdd,$mdpBdd);
                        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "INSERT INTO ".$tableName." VALUES (:mail_uid,:sent_by,:date_reception,:body_received,:answered,:id_agent)"; 
                        $array=array(
                            ":mail_uid"=>$mailUid,
                            ":sent_by"=>$sentBy,
                            ":date_reception"=>$dateReception,
                            ":body_received"=>null,
                            ":answered"=>$answered,
                            ":id_agent"=>0
                        );
                        $sth = $dbh->prepare($query);
                        $sth->execute($array);
    
                        $sth=null; 
                        $dbh=null;
                    }catch(PDOException $e){
                        echo "<p>Erreur : ".$e->getMessage();
                        die();
                    }
                }
            }
        }
            
        $cpt=1;
        foreach($inboxMailOverviewSent as $element){      
            if(!empty($element->in_reply_to)){//si le in reply to n'est pas vide
                
                $mailUidSent=$element->message_id;
                $mailUidSent=removeChar($mailUidSent);  
                $dateSent=htmlentities($element->date);
                $in_reply_to=$element->in_reply_to;
                $in_reply_to=removeChar($in_reply_to);
                //verifier que in reply to match avec un mail dans la liste des mails recus si présent on continue => flag1 false
                
                $flag1=true;
                foreach($liste as $elemzer){
                    if(in_array($in_reply_to,$elemzer)){
                        $flag1=false;
                        break;
                    }
                }
                
                //verifier que le mail uid sent n'est pas dans la table email_sent, si il est présent, $flag2=>true
    
                $flag2=false;
                foreach($listeSent as $elemzgeg){   
                    if(in_array($mailUidSent,$elemzgeg)){
                        $flag2=true;
                        break; 
                    }
                }
                
                //si c'est une réponse a un mail recu et qu'il n'est pas présent dans $listeSent on le rentre en bdd => flag1 false et flag 2 false
                if($flag1==false && $flag2==false){
                    try{
                        $dbh=new PDO("mysql:host=localhost;dbname=csnj",$loginBdd,$mdpBdd);
                        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "INSERT INTO ".$tableNameSent." VALUES (:mail_uid,:in_reply_to,:date_sent,:body_sent,:id_agent)"; 
                        $array=array(
                            ":mail_uid"=>$mailUidSent,
                            ":in_reply_to"=>$in_reply_to,
                            ":date_sent"=>$dateSent,
                            ":body_sent"=>null,
                            ":id_agent"=>0
                        );
                        $sth = $dbh->prepare($query);
                        $sth->execute($array);
        
                        $sth=null; 
                        $dbh=null;
                    }catch(PDOException $e){
                        echo "<p>Erreur : ".$e->getMessage();
                        die();
                    }
                }else{
                    echo $mailUidSent." est déjà présent dans la DB et n'a pas été rajouté à la DB.<br/>\n";
                }
            }
        }
    } 

    /******************* Fermetures des connexions **********************/
    function closeMbox($connexion, $connexionSent){
        imap_close($connexion);
        imap_close($connexionSent);
    }

?>