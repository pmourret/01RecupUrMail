<?php 
    include_once 'fonction.php';
    //*********Déclaration variables**************/
    
    $valide = 0;
    $nonValide = 0;
    $connexion = connexion();

    if(!$connexion){
        echo 'Echec de la connexion';
    }
    else{
        echo 'Connexion établie : <br>';

        $infos = infoBMail($connexion);
        $entete = accesEntete($connexion, $infos);
        $dateIn= stockDate($entete);
        $dateOut = stockUdate($entete);

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
        echo "Il existe ".$valide." échanges valides pour "."$nonValide"." échanges non valide(s)";
    }

    /*************** Affichage *******************/
    
    //afficheTab($entete);
    //afficheTab($dateIn);
    //afficheTab($dateOut);
    echo "<br>Nombre d'entrées dans le tableau entete : ".count($entete)."<br>";
    echo "Nombre d'entrées dans le tableau dateIn : ".count($dateIn)."<br>";
    echo "Nombre d'entrées dans le tableau dateOut : ".count($dateOut)."<br>";


    
    
<<<<<<< Updated upstream
=======
    echo "Il existe ".$valide." échanges valides pour ".$nonValide." échanges non valides";
>>>>>>> Stashed changes


    

?>