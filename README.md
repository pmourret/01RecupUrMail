# 01RecupUrMail
 Projet Stage GRETA 2021 : Récupération de mail, extraction des données d'entêtes et traitement.

/********************************* DESCRIPTION DES FONCTIONS **********************************/

    function connexion() : Cette fonction permet l'ouverture du flux IMAP, utilise 4 variables
    locales : 
        $mailbox = à l@ du serveur imap de la boîte de mail ;
        $user = à l'email, soit l'ID de connexion ;
        $motDePasse = au mot de passe de la boîte mail ;
        $connectMail = flux IMAP ouvert grâce à la fonction imap_open + les variables décrites ci 
        dessus comme paramètre
    Cette fonction retourne $connectMail ;

    function infoBMail() : Cette fonction permet la lecture des informations de la boîte mail, 
    elle prend pour paramètre la connexion à la boîte mail : $connectMail. Elle utilise et 
    retourne 1 variable locale : 
        $infoBoite = à la lecture des informations de la boîte mail grâce à la fonction
        imap_check() ;
    Cette fonction retourne $infoBoite ;

    function accesEntete() : Cette fonction permet la récupération des entêtes des mails de la
    boite, elle prend pour paramètre le flux imap ainsi que les informations de la boîte mail.
    Elle utilise 2 variable locale : 
        $infoBoite = prend pour valeur les informations de la boîte mail ;
        $lectureMail = récupére les entétes mail grâce à la fonction imap_fetch_overview() ;
    Elle retourne la valeur $lectureMail ;

    function parcourHeaderMail() : cette fonction permet le parcours des entêtes mails et 
    les affiche, elle prend pour paramètre le retour de la fonction imap_fetch_overview()
        elle utilise une boucle foreach() pour procéder à l'affichage ;
    
    function stockDate() : cette fonction permet de stocker dans un tableau toutes les dates 
    reçues via les entêtes mails, date est un attribut. Elle prend pour paramètre un tableau 
    correspondant à l'ensemble des objets récupérés par imap_fetch_overview();
    Elle utilise 2 variables locales : 
        $i = variable d'incrémentation ;
        $tabSort = Un tableau permettant le stockage des dates ;
    Elle utilise une boucle parcourant le tableau d'entrée et stockant dans le nouveau tableau 
    les valeurs récupérées tout en les convertissant au format UNIX.
    Elle retourne $tabSort, le tableau de stockage.

    function stockUdate() : idem que la fonction précédente, n'est plus utilisée.

    function afficheTab() : fonction permettant l'affichage d'un table, prend un tableau en 
    paramètre.

    function getSentMail() : cette fonction permet de récupérer les entêtes des messages envoyés dans
    la boite mail, elle ne prend pas de paramètres et utilise 7 variables locales :
        $user = à l@ du mail de la boîte mail ;
        $motDePasse = au mot de passe de la boîte mail ;
        $imapPath = à l@ du serveur imap de la boîte de mail avec pour paramètre le dossier des 
        messages envoyés ;
        $connectMail = flux IMAP ouvert grâce à la fonction imap_open();
        $mailBoxInfos = récupération des informations de la boîte mail avec la fonction 
        imap_check() ;
        $mailList = récupération des entêtes des messages grâce à la fonction imap_fetch_overview();
        $tabMailSent = tableau permettant le stockage des dates des mails envoyés ;
    Cette fonction utilise une boucle for() permettant le parcours des entêtes, elle récupére les dates 
    et les convertis au format UNIX.
    Elle retourne un tableau contenant l'ensemble des dates ;


/********************************* DESCRIPTION DES VARIABLES **********************************/

    --------------------------------------- MAIN ---------------------------------------

    $connexion = appel de la fonction connexion(), permet l'ouverture du flux IMAP ;

    $infos = appel de la fonction infoBMail(), stoke les informations de la boîte mail ;

    $entete = appel de la fonction accesEntete(), stocke un tableau d'objet contenant les
    entêtes des mails ;

    $valide = variable d'incrémentation, correspondant aux mails valides ;

    $nonValide =  variable d'incrémentation, correspondant aux mails non valides ;

    $dateIn = appel de la fonction stockDate(), stocke un tableau contenant les dates des 
    mails reçus ;

    $dateOut = appel de la fonction getSentMail(), stocke un tableau contenant les dates
    des mails envoyés ;

    $substract = tableau stockant le résultat de l'opération $dateOut - $dateIn, ce tableau 
    permet la validation des mails.



/************************************** FONCTIONNEMENT **************************************/

    => Création de la connexion à la boite mail ;
        -> Si la connexion échoue, affichage d'une erreur
        -> Si la connexion réussie, affichage "Connexion réussie :
            > Début du traitement :
                - Récupération des informations de la boite mail ;
                - Récupération des entêtes ;
                - Création du tableau des dates entrantes ;
                - Création du tableau des dates sortantes ; 

                - Comparaison des dates : 
                    ~ Si (longueur du tableau $dateIn > longueur du tableau $dateOut){
                        Pour $i = 0, $i < longueur du tableau $dateOut, $i++{
                            $substract[$i] prend la valeur $dateOut[$i] - $dateIn[$i] //Remplissage du tableau substract 
                            Si ($dateOut[$i] > $dateIn[$i]){
                                $valide prend la valeur $valeur + 1;
                            }
                            Sinon{
                                $nonValide prend la valeur $nonValide + 1;
                            }
                        }
                    }
                    Sinon {
                        Pour $i = 0, $i < longueur du tableau $dateIn, $i++{
                            $substract[$i] prend la valeur $dateOut[$i] - $dateIn[$i] //Remplissage du tableau substract
                            Si ($dateOut[$i] > $dateIn[$i]){
                                $valide prend la valeur $valeur + 1;
                            }
                            Sinon{
                                $nonValide prend la valeur $nonValide + 1;
                            }
                        }
                    }

