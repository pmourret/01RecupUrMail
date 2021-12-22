<?php 
    include_once 'functions.php';
    include_once 'functionTri.php';

    $mbox = connectBox();
    $mboxSent = connectBoxSent();

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

        print_r($sortedMails);

    }
    
    closeMbox($mbox,$mboxSent);
?>