<?php 
$login="csnj";
$mdp="csnj";
    try{
        $dbh=new PDO("mysql:host=localhost;dbname=csnj",$login,$mdp);
        $query = "INSERT INTO super_agents values(:agent_id,:agent_name,:agent_surname,:agent_login,:agent_pwd)";
        $data=array(
            ':agent_id'=>6,
            ':agent_name'=>'Zabi',
            ':agent_surname'=>'LaMiff',
            ':agent_login'=>'zabi',
            ':agent_pwd'=>'lamiff'
        );
        
        $sth = $dbh->prepare($query);
        $sth->execute($data); 
        $dbh=null;   
    }
    catch (PDOException $e){
        echo "<p>Erreur : ".$e->getMessage();
        die();
    }

?>