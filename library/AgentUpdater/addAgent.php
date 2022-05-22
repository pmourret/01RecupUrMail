<?php 
        $agentName = $_POST['agentName'];
        $agentSurname = $_POST['agentSurname'];
        $agentMatricule = $_POST['agentMatricule'];
        $dsn = 'mysql:host=localhost;dbname=csnj' ;
        try {

            $mysql = new PDO($dsn,'root','');
            $sqlQuery = 'INSERT INTO agents VALUES (:id_agent, :agent_name, :agent_surname, :agent_matricule)';
            //$agentsStatement = $mysql->prepare($sqlQuery);
            $addAgent = $mysql->prepare($sqlQuery);
            $array = array(
                ":id_agent" => NULL,
                ":agent_name" => $agentName,
                ":agent_surname" => $agentSurname,
                ":agent_matricule" => $agentMatricule
            );
            $addAgent->execute($array);

        } 
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage;
            die();
        }

?>