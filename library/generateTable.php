<?php
include_once "functions.php";
function selectAll(){

    $dsn = 'mysql:host=localhost;dbname=csnj;port=3306;charset=utf8' ;
    try {
        $mysql = new PDO($dsn,'root','1234');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage;
        die();
    }

    $sqlQuery = 'select * from email_received as a left join email_sent as b on a.mail_uid=b.in_reply_to order by a.date_reception;';
    $agentsStatement = $mysql->prepare($sqlQuery);
    $agentsStatement->execute();
    $agents = $agentsStatement->fetchAll();

    return $agents;
}

function selectMailSent(){

    $dsn = 'mysql:host=localhost;dbname=csnj;port=3306;charset=utf8' ;
    try {
        $mysql = new PDO($dsn,'root','');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage;
        die();
    }

    $sqlQuery = 'SELECT * FROM email_sent';
    $agentsStatement = $mysql->prepare($sqlQuery);
    $agentsStatement->execute();
    $agents = $agentsStatement->fetchAll();

    return $agents;
}

function selectMailReceived(){

    $dsn = 'mysql:host=localhost;dbname=csnj;port=3306;charset=utf8' ;
    try {
        $mysql = new PDO($dsn,'root','');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage;
        die();
    }

    $sqlQuery = 'SELECT * FROM email_received';
    $agentsStatement = $mysql->prepare($sqlQuery);
    $agentsStatement->execute();
    $agents = $agentsStatement->fetchAll();

    return $agents;
}

function generateTableName($requestMailReceived){
    $getDelay = getDelay();
    foreach($requestMailReceived as $key){
        if($key['date_sent']==NULL){
            $delay = getOpenDays(strtotime($key['date_reception']),time());
        }else{
            $delay = getOpenDays(strtotime($key['date_reception']),strtotime($key['date_sent']));
        }

        print("<tr style='height: 65px;'>");
        print("<td class='u-table-cell'>".$key['date_reception']."</td>");
        print("<td class='u-table-cell'>".$key['sent_by']."</td>");
        print("<td class='u-table-cell'>".$key['date_sent']."</td>");
        if ($delay <= $getDelay){
            if($key['date_sent']==NULL){
                print("<td class='u-table-cell'>Il y a ".$delay." jour(s) ouvré(s). <br/> L'échange est encore valide.</td>
                <td><img
                src='../html/images/iconEnCours.png'
                alt='en cours'>
                </td>");
            }else{
                print("<td class='u-table-cell'>Il y a ".$delay." jour(s) ouvré(s). <br/> L'échange est valide.</td>
                <td><img
                src='../html/images/iconCheckmark.png'
                alt='ok'>
                </td>");
            }
        }else{
            if($key['date_sent']==NULL){
                print("<td class='u-table-cell'>Il y a ".$delay." jour(s) ouvré(s). <br/>Délai dépassé. <br/> Echange invalide</td>
                <td><img
                src='../html/images/iconCroix.png'
                alt='croix'>
                </td>");
            }else{
                print("<td class='u-table-cell'>Il y a ".$delay." jour(s) ouvré(s). <br/>Echange invalide</td>
                <td><img
                src='../html/images/iconCroix.png'
                alt='croix'>
                </td>");
            }

        }
        print("</tr>");
    }
}
?>