<?php 
    include_once 'functions.php';

    $mbox = connectBox();
    $mbox_sent = connectBoxSent();

    if (!$mbox && !$mbox_sent){
        die("Connexion impossible, vérifier vos identifiants");
    }
    else {
        echo "Connexion réussie";

        $checkBox = checkBox($mbox);
        $checkBoxSent = checkBoxSend($mbox_sent);

        $mboxOverview = overviewBox($mbox,$checkBox);
        $mboxOverviewSent = overviewBox($mbox_sent,$checkBoxSent);

        $sortReceived = sortReceived($mbox,$mboxOverview);
        $sortSent = sortSent($mbox_sent,$mboxOverviewSent,$sortReceived);
        echo "<pre>";
            print_r($sortReceived);
            print_r($sortSent);
        echo "</pre>";
    }
    
    closeMbox($mbox,$mbox_sent);
?>