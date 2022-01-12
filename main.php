<?php 
    session_start();
    include_once 'library/functions.php';

    $conf = parse_ini_file('conf.ini');

    $dbUser = $conf['dataBaseUser'];
    $dbPass = $conf['dataBasePass'];
    $appUser = $conf['login'] ;
    $appPass = $conf['password'] ;

    if($_POST['username'] == $appUser && $_POST['password'] == $appPass){
        $mbox = connectBoxAdmin();
        $mboxSent = connectBoxSentAdmin();

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
            $cptMailChecked = $cptMailReceived + $cptmailSent;
            /*
            $cptTrue = countMailTrue($sortedMailsSent) ;
            $cptFalse = $cptMailChecked - $cptTrue ;
            $perf = ($cptTrue / $cptMailChecked) * 100;
            $perfRound = number_format($perf,2);
            */

            $cptTrue = countMailTrue($sortedMailsSent);
            $cptFalse = countMailFalse($sortedMailsSent);
            $cptUnderFive = getOpenDaysMailReceived($mboxOverview);

            $countTotal = $cptTrue + $cptUnderFive + $cptFalse ; 

            $perf = ($cptTrue / $countTotal) * 100;
            $perfRound = number_format($perf,2);

    
            $_SESSION['nbMails'] = $cptMailChecked;
            $_SESSION['mailTrue'] = $cptTrue + $cptUnderFive;
            $_SESSION['mailFalse'] = $cptFalse;
            $_SESSION['perf'] = $perfRound ;
            stockageBdd($mbox,$mboxSent,$dbUser,$dbPass);

            header("Location:html/Admin.php");

            
        }
    }
    else{
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

            stockageBdd($mbox,$mboxSent,$dbUser,$dbPass);
            header("Location:html/Accueil.php");
        }
    }

    
    closeMbox($mbox,$mboxSent);
?>