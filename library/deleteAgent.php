<?php 
        $agentMatricule = $_POST['agentMatricule'];
        $dsn = 'mysql:host=localhost;dbname=csnj' ;
        try {

            $mysql = new PDO($dsn,'root','');
            $sqlDelete = 'DELETE FROM agents WHERE agent_matricule = :agent_matricule ';
            $deleteAgent = $mysql->prepare($sqlDelete);
            $array = array(
                ":agent_matricule" => $agentMatricule
            );
            $deleteAgent->execute($array);

        } 
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage;
            die();
        }

?>