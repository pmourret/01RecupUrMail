<?php
function selectAll(){
$dsn = 'mysql:host=localhost;dbname=csnj;port=3306;charset=utf8' ;
    try {
        $mysql = new PDO($dsn,'root','');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage;
        die();
    }

    $sqlQuery = 'SELECT * FROM agents';
    $agentsStatement = $mysql->prepare($sqlQuery);
    $agentsStatement->execute();
    $agents = $agentsStatement->fetchAll();

    return $agents;
}

function optionList($agents){
    echo "<select id='select-2a9c' name='select' class='u-border-1 u-border-grey-30 u-input u-input-rectangle'>";
    foreach($agents as $element){
        echo "<option value=".$element['id_agent'].">".$element['agent_name']."</option>";
    }
    echo "</select>";
    return $element['id_agent'];
}

?>