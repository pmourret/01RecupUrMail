<?php 
session_start();
include_once 'fonctions.php';
$imap_path_inbox='{outlook.office365.com:993/imap/ssl/novalidate-cert}Inbox';
$imap_path_sent='{outlook.office365.com:993/imap/ssl/novalidate-cert}Sent';
//$imap_path_inbox='{imap.gmail.com:993/ssl}INBOX';
//$imap_path_sent='{imap.gmail.com:993/ssl}[Gmail]/Messages envoy&AOk-s';
$password='test1234test1234';
$username='testproj1234@outlook.fr';
//$username='test1234zebi@gmail.com';
//++++++++++MAIL RECEIVED++++++++++++++
echo "<h1>MAIL RECEIVED</h1>";
$connexion_inbox=imap_open($imap_path_inbox,$username,$password); //ouverture imap INBOX mails recus
$inbox_check=imap_check($connexion_inbox);// renvoie : Date - Driver - Mailbox - Nmsgs - Recent
$inbox_mail_overview = imap_fetch_overview($connexion_inbox,"1:".$inbox_check->Nmsgs); //imap_fetch_overview — Lit le sommaire des en-têtes de messages https://www.php.net/manual/fr/function.imap-fetch-overview.php
echo "1 FOR ANSWERED, 0 FOR NOT ANSWERED <br/>\n";
$inbox_tab=array(); //initialisation d'un tableau
$bus=array(); //preparation du bus de données a rentrer dans le tableau inbox_tab
$nb=0; //compteur pour incrémenter la clé du premier tableau => inbox_tab[$nb]
foreach($inbox_mail_overview as $element){ //boucle sur l'overview de l'inbox
    $headerinfo_inbox = imap_headerinfo($connexion_inbox, $element->msgno); //imap_headerinfo — Lit l'en-tête du message https://www.php.net/manual/fr/function.imap-headerinfo.php
    //echo gettype($header->from)[$element->msgno]."<br/>\n";
    echo "<pre>"; //pre pour preformater le texte
    echo "Mail number ".$element->msgno." : <br/>\nIS MAIL ANSWERED : ".htmlentities($element->answered); // n° message msgno et si le mail est répondu a l'aide de htmlentities
    echo "<br/>\nMESSAGE FROM : " . ($headerinfo_inbox->from)[0]->mailbox."@".($headerinfo_inbox->from)[0]->host; // adresse mail de l'envoyeur, concaténation de 2 string de l'objet $headerinfo_inbox contenant un tableau
    echo "<br/>\nDATE & UDATE : DATE ->" . htmlentities($element->date)." & UDATE->".strtotime(htmlentities($element->date)); //date format "normal" et date unix
    echo "<br/>\nMAIL UID : " . htmlentities($element->message_id); //id du message
    if(htmlentities($element->answered)==true){ //remplissage du bus de données
        $bus[0]=htmlentities($element->message_id);
        $bus[1]=strtotime(htmlentities($element->date));
        $bus[2]=htmlentities($element->msgno);
        $inbox_tab[$nb]=$bus; //insertion du bus de données dans a la clé $nb
        echo "<br/>\nSTOCKED IN ARRAY AS : inbox_tab[".$nb."] =>".$inbox_tab[$nb][0]." - ".$inbox_tab[$nb][1]." - ".$inbox_tab[$nb][2];
        $nb=$nb+1; //incrémentation de la clé pour la prochaine boucle
        $bus=array();//nettoyage du bus de données pour la prochaine boucle
    } 
    echo "</pre><br/>\n"; //fin du texte preformaté
   
}
$count_answered=count($inbox_tab); //comptage du nombre de mails 
$nb_tab_matches=0; //compteur tableau mails recus
$tab_matches=array();//preparation du tableau mails recus
//++++++++++MAIL SENT++++++++++++++++++
echo "<h1>MAIL SENT</h1>";
$cpt_true=0; //compteur mail valide (répondu dans les temps)
$cpt_false=0;//compteur mail invalide (répondu hors temps)
$connexion_sent=imap_open($imap_path_sent,$username,$password); // ouverture connexion imap sur les mails envoyés
$sent_check=imap_check($connexion_sent);// renvoie : Date - Driver - Mailbox - Nmsgs - Recent 
$sent_mail_overview = imap_fetch_overview($connexion_sent,"1:".$sent_check->Nmsgs); // comme pour les mails recus
echo "1 FOR ANSWERED, 0 FOR NOT ANSWERED <br/>\n";
foreach($sent_mail_overview as $element){ 
    $headerinfo_sent = imap_headerinfo($connexion_sent, $element->msgno);
    //echo gettype($header->from)[$element->msgno]."<br/>\n";
    echo "<pre>";
    echo "Mail number ".$element->msgno." : <br/>\nIS MAIL ANSWERED : ".htmlentities($element->answered); //pareil que mail recus - numéro du mail et si il y a eu une réponse à ce mail envoyé
    echo "<br/>\nMESSAGE FROM : " . ($headerinfo_sent->from)[0]->mailbox."@".($headerinfo_sent->from)[0]->host; //mail de l'envoyeur (nous) - concaténation avec 2 string comme dans les mails recus
    echo "<br/>\nMAIL UID : " . htmlentities($element->message_id); // uid du mail
    if(isset($element->in_reply_to)){ //si il est en réponse à un mail reçu
        echo "<br/>\nIN REPLY TO : " . htmlentities($element->in_reply_to);  // en réponse A
        for($i=0;$i<$count_answered;$i++){
            if($inbox_tab[$i][0]==htmlentities($element->in_reply_to)){ // si l'id du mail recu correspond a l'id du in reply to
                echo "<br/>\nA MAIL MATCH HAS BEEN FOUND : Message N°" . $inbox_tab[$i][2] . " in the INBOX."; //les 2 mails match
                $delay= strtotime($element->date) - $inbox_tab[$i][1]; //calcul du délai en temps unix
                echo "<br/>\n(DATE SENT)".strtotime($element->date)." - (DATE RECEIVED)".$inbox_tab[$i][1]." = ".$delay; // on affiche le calcul du délai en temps unix
                echo "<br/>\nDELAY BETWEEN MAIL RECEVEID AND MAIL SENT : ".$delay; //affichage du délai en temps unix
                $bus[0]=$inbox_tab[$i][2]; // on rentre alors $inbox_tab[$i][0] dans $bus[0]
                $bus[1]=$delay; // on rentre le délai entre les deux mails dans $bus[1]
                $date_depart=$inbox_tab[$i][1]; //on récupere la date a laquelle le mail correspondant a été recu depuis le tableau des mails recus
                $date_fin=strtotime($element->date); //on récupere la date a la quelle on a répondu au mail
                $nb_jours_ouvres=get_nb_open_days($date_depart,$date_fin); //calcul du nombre de jours ouvrés entre les 2 dates
                echo '<br/><br/>Il y a '.$nb_jours_ouvres.' jours ouvr&eacute;s entre le '.date('d/m/Y', $date_depart).' et le '.date('d/m/Y', $date_fin); // on affiche le nombre de jours ouvrés entre les 2 dates
                if($nb_jours_ouvres<=5){ //si le nombre de jours ouvrés est inférieur ou égal a 5 on est dans les temps
                    $bus[2]=true; //ajout booléen vrai dans les tableau 3eme cellule
                    $cpt_true=$cpt_true+1; //incrémentation du compteur de mails valides
                }
                if($nb_jours_ouvres>5){ // si on est pas dans les temps
                    $bus[2]=false;//ajout booléen faux dans le tableau 3eme cellule
                    $cpt_false=$cpt_false+1; //incrémentation du nombre de mails invalides (hors temps)
                }
                $tab_matches[$nb_tab_matches]=$bus; // on rentre le bus de données dans le tableau des mails envoyés
                echo '<br/><br/>DATA STORED IN ARRAY AS $tab_matches['.$nb_tab_matches.'] : inbox message number='.$tab_matches[$nb_tab_matches][0].', delay='.$tab_matches[$nb_tab_matches][1].', mail is valid='.$tab_matches[$nb_tab_matches][2];
                $bus=array();//nettoyage du bus de données
                $nb_tab_matches=$nb_tab_matches+1;//incrémentation du compteur pour le tableau des mails envoyés
            }
        }
    }
    echo "</pre><br/>\n"; 
}

$_SESSION['nb_mails']=count($inbox_tab);
$_SESSION['valid']=$cpt_true;
$_SESSION['invalid']=$cpt_false;
imap_close($connexion_inbox); //fermeture de la connexion a la boite des mails recus
imap_close($connexion_sent);//fermeture de la connexion a la boite des mails envoyés
?>