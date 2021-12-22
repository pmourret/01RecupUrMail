<?php 
    include_once 'functions.php';
    include_once 'functionTri.php';


    /*
    $mboxPath = null;
    $mboxPathSend = null;

    $imapGoogle = '{imap.gmail.com:993/ssl}';
    $imapOutlook = '{outlook.office365.com:993/imap/ssl/novalidate-cert}';
    
    $imapGoogleIn = '{imap.gmail.com:993/ssl}INBOX';
    $imapGoogleSent = '{imap.gmail.com:993/ssl}[Gmail]/Messages envoy&AOk-s';
    $imapOutlookIn = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Inbox';
    $imapOutlookSent = '{outlook.office365.com:993/imap/ssl/novalidate-cert}Sent';

    if (preg_match($imapGoogle, $_POST['serveur']) == true){
        $mboxPath = $imapGoogleIn;
        $mboxPathSend = $imapGoogleSent ;
    }
    else if (preg_match($imapOutlook, $_POST['serveur']) == true){
        $mboxPath = $imapOutlookIn ;
        $mboxPathSend = $imapOutlookSent;
    }
    else{
        echo "Type de boîte mail non supporté";
    }
    */
    $path = checkPath();
    $pathSent = checkPathSent();
    $mbox = connectBox($path);
    $mboxSent = connectBoxSent($pathSent);

    if (!$mbox && !$mboxSent){
        die("Connexion impossible, vérifier vos identifiants");
    }
    else {
        //echo "Connexion réussie<br/>";

        $checkBox = checkBox($mbox);
        $checkBoxSent = checkBoxSend($mboxSent);

        $mboxOverview = overviewBox($mbox,$checkBox);
        $mboxOverviewSent = overviewBox($mboxSent,$checkBoxSent);

        $sortedMails = sortMails($mbox,$mboxSent,$mboxOverview,$mboxOverviewSent);

        //print_r($sortedMails);

    }
    
    closeMbox($mbox,$mboxSent);
?>