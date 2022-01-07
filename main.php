<?php 
    session_start();
    include_once 'functions.php';
    //include_once 'functionTri.php';
    include_once 'functionsII.php';


    $path = checkPath();
    $pathSent = checkPathSent();
    $mbox = connectBox($path);
    $mboxSent = connectBoxSent($pathSent);

    if (!$mbox && !$mboxSent){
        die("Connexion impossible, vérifiez vos identifiants");
    }
    else {

        $checkBox = checkBox($mbox);
        $checkBoxSent = checkBox($mboxSent);

        $mboxOverview = overviewBox($mbox,$checkBox);
        $mboxOverviewSent = overviewBox($mboxSent,$checkBoxSent);

        $sortedMailsReceived  = sortMailsReceived($mboxOverview);
        
        $sortedMailsSent = sortMailsSent($mboxOverviewSent,$sortedMailsReceived);

        $cptMailReceived = count($mboxOverview); 
        $cptmailSent = count($mboxOverviewSent);
        $cptMailChecked = $cptMailReceived + $cptmailSent ;
        
        $cptTrue = countMailTrue($sortedMailsSent) ;
        $cptFalse = $cptMailChecked - $cptTrue ;

        $_SESSION['nbMails'] = $cptMailChecked;
        $_SESSION['mailTrue'] = $cptTrue;
        $_SESSION['mailFalse'] = $cptFalse;

        header("Location:html/Accueil.php");
    }
    
    closeMbox($mbox,$mboxSent);
?>