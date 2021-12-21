<?php 
    include_once 'functions.php';

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

        $sortReceived = sortReceived($mbox,$mboxOverview);
        $sortSent = sortSent($mboxSent,$mboxOverviewSent,$sortReceived);
    }
    
    closeMbox($mbox,$mboxSent);
?>