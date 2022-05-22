<?php
session_start();
include_once 'library/functions.php';
include_once 'library/generateTable.php';

$conf = parse_ini_file('library/config.ini');

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
        $MailsReceived=selectAll();
        $countTotal = count(selectAll());
        $cptTrue = 0;
        $cptFalse = 0;
        foreach($MailsReceived as $key){
            if($key['answered']==1){
                $cptTrue+=1;
            }
            if($key['answered']==0){
                $cptFalse+=1;
            }
        }


        $cptUnderFive = getOpenDaysMailReceived($mboxOverview);



        $perf = ($cptTrue / $countTotal) * 100;
        //number_format prends un float et choisi le nombre de chiffres après la virgule à afficher, ici c'est 2
        $perfRound = number_format($perf,2);


        $_SESSION['nbMails'] = $countTotal;
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