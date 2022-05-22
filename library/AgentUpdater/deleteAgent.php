<?php 
        $agent_name = $_POST['deleteAgent'];
        $dsn = 'mysql:host=localhost;dbname=csnj' ;
        try {

            $mysql = new PDO($dsn,'root','');

            $sql = 'DELETE FROM agents '.'WHERE agent_name = :agent_name';
            $stmt = $mysql->prepare($sql);
            $stmt->bindValue(':agent_name',$agent_name);
            $stmt->execute();

        } 
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage;
            die();
        }

?>