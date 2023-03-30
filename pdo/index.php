<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

//Recup des données du tab SQL et affichage de celles-ci sous forme d'array associatif

$query1 = "SELECT * FROM friend";
$statement = $pdo->query($query1);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($friends);

//Creation d'une liste HTML listant les élèments du tab SQL

foreach($friends as $friend ) {
        echo "<ul>" ;
        echo "<li>".$friend['firstname']. " " . $friend['lastname'] . "</li>";
        echo "</ul>";
}

//Creation du formulaire

?>

<form action="" method="post">
    <label for="userFirstName"> your first name: </label>
    <input type="text" id="userFirstName" name="userFirstName" required>
    <label for="userLastName"> your last name: </label>
    <input type="text" id="userLastName" name="userLastName" required>
    <input type="submit" value="send"/>
</form>

<?php

//Requête préparée pour insertion des données apres entrée de données dans le formulaire

$query = "INSERT INTO friend (firstname, lastname) VALUES (:userFirstName, :userLastName)";
$statement = $pdo->prepare($query);
$statement->bindValue(":userFirstName", $_POST['userFirstName'], \PDO::PARAM_STR);
$statement->bindValue(":userLastName", $_POST['userLastName'], \PDO::PARAM_STR);

$statement->execute();

?>
    
</body>
</html>

