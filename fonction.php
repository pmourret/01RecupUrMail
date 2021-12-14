<?php
    /***** Connexion à la boite mail ******************/
    /**************************************************/
    function connexion(){
        /*Identifiants, code à modifier 
        pour prendre un ensemble plus général 
        => Autres boîtes mails*/

        $mailbox = "{imap.gmail.com:993/imap/ssl}";
        $user = 'test1234zebi@gmail.com';//$_GET['email'];
        $motDePasse = 'test1234test1234';//$_GET['pass'];

        $connectMail = imap_open($mailbox, $user, $motDePasse);
        return $connectMail;
    }


    /*********Récupération infos boite mail************/
    /**************************************************/
    function infoBMail($connectMail){                 
        $infoBoite = imap_check($connectMail);        
        return $infoBoite ;                           
    }

    /******** Récupération des entêtes ****************/
    /**************************************************/
    function accesEntete($connectMail,$infoBoite){
        $infoBoite = imap_check($connectMail);
        $lectureMail = imap_fetch_overview($connectMail,"1:".$infoBoite->Nmsgs);
        return $lectureMail;
    }
    
    /************* Parcours des entêtes ***************/
    /**************************************************/
    function parcourHeaderMail($lectureHead){
        foreach($lectureHead as $element){
            echo "<pre>";
                print_r ($element)."\n"; //Pb ici => Ne veut pas sauter à la ligne ? 
            echo "</pre>";
        }
    }
    /**Stockage des dates(expeditions) et conversion***/
    /**************************************************/
    function stockDate($tabEntree){ //Prend pour param le tableau des headers contenant n entetes mails
        $i = 0;
        $tabSort = array();
        while($i < count($tabEntree)){
            $tabSort[$i] = strtotime($tabEntree[$i]->date); //Stocke dans un tableau les dates converties 
            $i = $i + 1;
        }
        return $tabSort;
    }
    /***** Stockage des des dates(réception)  *********/
    /**************************************************/
    function stockUdate($tabEntree){ //Prend pour param le tableau des headers contenant n entetes mails
        $i = 0;
        $tabSort = array();
        while($i < count($tabEntree)){
            $tabSort[$i] = ($tabEntree[$i]->udate);
            $i = $i + 1;
        }
        return $tabSort;
    }
    
    /************* Fonction affichage tableau *********/
    /**************************************************/
    function afficheTab($tab){
        foreach($tab as $element){
            echo "<pre>";
                print_r($element);
            echo "</pre>";
        }
    }
    /************************************************************* Zone de test **************************************************************/

?>