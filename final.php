<?php 
    include_once 'fonctionsII.php';

    $connexion = connexion();
    if(!$connexion){
        echo 'Echec de la connexion';
    }
    else{
        echo 'Connexion établie : <br>';
        $infos = infoBMail($connexion);
        $entete = accesEntete($connexion, $infos);
    }

    afficheTab($entete);
    $dateIn= stockDate($entete);
    afficheTab($dateIn);
    $dateOut = stockUdate($entete);
    afficheTab($dateOut);

    //$dateConv = strtotime($dates[2]);
    //echo "$dateConv";

    /** Comparateur des dates **/
    $substract = array();
    for($i=0;$i<count($entete);$i++){ 
        $substract[$i] = $dateIn[$i] - $dateOut[$i]; //remplissage du tableau substract
    }

    foreach($substract as $val){
        if($val < 432000){
            echo "il existe des mails valides"."<br>";
        }
    }

?>