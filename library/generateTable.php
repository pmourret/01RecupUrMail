<?php
include_once "functions.php";
function selectAll(){

    $dsn = 'mysql:host=localhost;dbname=csnj;port=3306;charset=utf8' ;
        try {
            $mysql = new PDO($dsn,'root','');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage;
            die();
        }
    
        $sqlQuery = 'SELECT * FROM email_received, email_sent';
        $agentsStatement = $mysql->prepare($sqlQuery);
        $agentsStatement->execute();
        $agents = $agentsStatement->fetchAll();
    
        return $agents;
}


function generateTableName($requestBDD){
    foreach($requestBDD as $key){
        $delay = getOpenDays(strtotime($key['date_reception']),strtotime($key['date_sent']));
        print("<tr style='height: 65px;'>");
        print("<td class='u-table-cell'>".$key['date_reception']."</td>");
        print("<td class='u-table-cell'>".$key['sent_by']."</td>");
        print("<td class='u-table-cell'>".$key['date_sent']."</td>");
        if ($delay <= 5){
            print("<td class='u-table-cell'>Il y a ".$delay." jour(s) ouvré(s). <br/> L'échange est valide.</td>");
        }else{
            print("<td class='u-table-cell'>Echange invalide</td>");
        }
        print("</tr>");
    }
}


?>