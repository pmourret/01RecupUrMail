<?php 
    include_once 'fonction.php';

    $connexion = connexion();
    if(!$connexion){
        echo 'Echec de la connexion';
    }
    else{
        echo 'Connexion établie : <br>';
        $infos = infoBMail($connexion);
        $entete = accesEntete($connexion, $infos);
    }
    //*********Déclaration variables**************/
    
    $valide = 0;
    $nonValide = 0;
    $dateIn= stockDate($entete);
    //$dateOut = stockUdate($entete);       OLD
    $dateOut = getSentMail();            // NEW
    
    /*************** Affichage *******************/
    
    //afficheTab($entete);
    afficheTab($dateIn);
    echo "---------------<br/>\n";
    afficheTab($dateOut);
    echo "Nombre d'entrées dans le tableau entete : ".count($entete)."<br>";
    echo "Nombre d'entrées dans le tableau dateIn : ".count($dateIn)."<br>";
    echo "Nombre d'entrées dans le tableau dateOut : ".count($dateOut)."<br>";

    /******* Comparateur des dates ****************/
    $substract = array();
    for($i=0;$i<count($entete);$i++){ 
        $substract[$i] = $dateOut[$i] - $dateIn[$i]; //remplissage du tableau substract
        if($dateOut[$i] > $dateIn[$i]){
            $valide+= 1;
        }
        else{
            $nonValide+= 1;
        }
    }
    
    echo "Il existe ".$valide." échanges valides pour ".$nonValide." échanges non valides";


    

?>