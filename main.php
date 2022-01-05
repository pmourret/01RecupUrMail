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
        $checkBoxSent = checkBox($mboxSent);

        $mboxOverview = overviewBox($mbox,$checkBox);
        $mboxOverviewSent = overviewBox($mboxSent,$checkBoxSent);

        $inboxTab  = checkMailHeaders($mboxOverview);
        
        /*echo "<pre>";
            print_r($inboxTab);
        echo "</pre>";*/
        
        $sortedMailsSent = sortMails($mboxOverviewSent,$inboxTab);

        /*echo "<pre>";
            print_r($sortedMailsSent);
        echo "</pre>";*/
    }
    
    closeMbox($mbox,$mboxSent);
?>