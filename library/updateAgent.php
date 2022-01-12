<?php 
$id_agent = $_SESSION['agent'];
$agent_name = $_POST['agentName'];
$agent_surname = $_POST['agentSurname'];
$agent_matricule = $_POST['agentMatricule'];

$dsn = 'mysql:host=localhost;dbname=csnj;port=3306;charset=utf8' ;
    try {
        $mysql = new PDO($dsn,'root','');
        $sqlUpdate = 'UPDATE agents SET agent_name = "'.$_POST['agentName'].'"agent_surname = "'.$_POST['agentSurname'].'"agent_matricule = "'.$_POST['agentMatricule'].'" WHERE id_agent = "'.$_SESSION['agent'].'"';
        $agentsStatement = $mysql->prepare($sqlUpdate);
        $agentsStatement->execute([
            ":agent_name" => $agent_name,
            ":agent_surname" => $agent_surname,
            ":agent_matricule" => $agent_matricule
        ]);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage;
        die();
    }
?>