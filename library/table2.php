<?php 
function tabRecapMails(){
    $ini = parse_ini_file('../conf.ini');
    $tableName="email_received";
    $tableNameSent="email_sent";

    //MAIL UID DANS $LISTEMAILUID
    try{
        $dbh=new PDO("mysql:host=".$ini['dataBaseHost'].";dbname=".$ini['dataBaseName']."",$ini['dataBaseUser'],$ini['dataBasePass']);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT mail_uid, date_reception, answered, id_agent FROM ".$tableName."";        
        $sth = $dbh->prepare($query);
        $sth->execute();
        $listeMailRecusPlusDate=$sth->fetchAll();  //   

        $sth=null; 
        $dbh=null;
    }catch(PDOException $e){
        echo "<p>Erreur : ".$e->getMessage();
        die();
    }

    

    //IN REPLY TO DANS $LISTEINREPLYTO
    try{
        $dbh=new PDO("mysql:host=".$ini['dataBaseHost'].";dbname=".$ini['dataBaseName']."",$ini['dataBaseUser'],$ini['dataBasePass']);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT in_reply_to, date_sent FROM ".$tableNameSent."";        
        $sth = $dbh->prepare($query);
        $sth->execute();
        $listeInReplyTo=$sth->fetchAll();  //  

        $sth=null; 
        $dbh=null;
    }catch(PDOException $e){
        echo "<p>Erreur : ".$e->getMessage();
        die();
    }

    
    $i=0;
    $tabRecap=array();
    $bus=array();
    foreach($listeMailRecusPlusDate as $emailRecu){
        foreach($listeInReplyTo as $InReplyTo){
            if($emailRecu[0]==$InReplyTo[0]){
                $bus[0]=$emailRecu[0];
                $bus[1]=$emailRecu[1];
                $bus[2]=$InReplyTo[1];
                $bus[3]=$emailRecu[3];
                $tabRecap[$i]=$bus;
                $i+=1;
            }
        }
    }
    
    // $tabRecap renvoie le mail_uid recu + la date de reception associée à ce mail, la date de réponse ainsi que l'ID de l'agent
    // sous le format $tabRecap[$i][0]=MAIL UID || $tabRecap[$i][1]=DATE RECEPTION || $tabRecap[$i][2]=DATE ENVOI || $tabRecap[$i][3]=ID AGENT
    return $tabRecap;
}
      
?>