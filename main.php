<?php 
    include_once 'functions.php';
    //include_once 'functionTri.php';
    include_once 'functionsII.php';


    $path = checkPath();
    $pathSent = checkPathSent();
    $mbox = connectBox($path);
    $mboxSent = connectBoxSent($pathSent);

    if (!$mbox && !$mboxSent){
        die("Connexion impossible, vérifier vos identifiants");
    }
    else {

        $checkBox = checkBox($mbox);
        $checkBoxSent = checkBoxSend($mboxSent);

        $mboxOverview = overviewBox($mbox,$checkBox);
        $mboxOverviewSent = overviewBox($mboxSent,$checkBoxSent);

        //$checkHeaders = checkMailHeaders($mboxOverview);
        //$checkHeadersSent = checkMailHeaders($mboxOverview);

        $inboxTab  = checkMailHeaders($mboxOverview);
        $inboxTabSent = checkMailHeaders($mboxOverviewSent);

        $sortedMails = sortMails($mboxOverview, $inboxTab);
        $sortedMailsSent = sortMails($mboxOverviewSent,$inboxTabSent);

        echo count($sortedMails)."<br>";
        echo count($sortedMailsSent);
    }
    
    closeMbox($mbox,$mboxSent);
?>