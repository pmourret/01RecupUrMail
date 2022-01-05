<?php
    include_once 'getOpenDays.php';

    function checkPath(){
        $imapGoogle = '{imap.gmail.com:993/ssl}';
        $imapOutlook = '{outlook.office365.com:993/imap/ssl/novalidate-cert}';
        
        $imapGoogleIn = '{imap.gmail.com:993/ssl}INBOX';
        //$imapGoogleSent = '{imap.gmail.com:993/ssl}[Gmail]/Messages envoy&AOk-s';
        $imapOutlookIn = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Inbox';
        //$imapOutlookSent = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Sent';

        if ($_POST['serveur'] == $imapGoogle){
            $mboxPath = $imapGoogleIn;
            //$mboxPathSend = $imapGoogleSent ;
        }
        else if ($_POST['serveur'] == $imapOutlook){
            $mboxPath = $imapOutlookIn ;
            //$mboxPathSend = $imapOutlookSent;
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

    function requestPDO(){
        $login="csnj";
        $mdp="csnj";
    
    
    //REQUETE EMAIL RECEIVED
        $date_received="";
        $message_id_received="";
        $sender_email="";
        try{
    
            $dbh=new PDO("mysql:host=localhost;dbname=csnj",$login,$mdp);
            $query = "INSERT INTO email_received values(:date_received,:message_id_received,:sender_email)";
            $data=array(
            ':date_received'=>$date_received,
            ':message_id_received'=>$message_id_received,
            ':sender_email'=>$sender_email
            );
        
            $sth = $dbh->prepare($query);
            $sth->execute($data); 
            $dbh=null;   
        }
        catch (PDOException $e){
        echo "<p>Erreur : ".$e->getMessage();
        die();
        }
    
    //REQUETE EMAIL SENT
        $date_sent="";
        $message_id_sent="";
        $in_reply_to="";
        $references_mail_sent="";
        try{
    
            $dbh=new PDO("mysql:host=localhost;dbname=csnj",$login,$mdp);
            $query = "INSERT INTO email_sent values(:date_sent,:message_id_sent,:in_reply_to,:references_mail_sent)";
            $data=array(
                ':date_sent'=>$date_sent,
                ':message_id_sent'=>$message_id_sent,
                ':in_reply_to'=>$in_reply_to,
                ':references_mail_sent'=>$references_mail_sent
            );
        
            $sth = $dbh->prepare($query);
            $sth->execute($data); 
            $dbh=null;   
        }
        catch (PDOException $e){
            echo "<p>Erreur : ".$e->getMessage();
            die();
        }  
    }

    function closeMbox($connexion, $connexionSent){
        imap_close($connexion);
        imap_close($connexionSent);
    }

    
?>