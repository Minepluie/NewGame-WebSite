<?php

// Configuration de la connexion à la base de données

$host = "mysql-minepluie.alwaysdata.net";

$user = "minepluie";

$password = "Flammouche";

$database = "minepluie_connexionjeu";

// Fonction pour établir la connexion à la base de données

function connectDB() {

    global $host, $user, $password, $database;

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {

        die("Échec de la connexion à la base de données: " . $conn->connect_error);

    }

    return $conn;

}

// Fonction pour afficher les champs de l'utilisateur

function afficherChampsUtilisateur($utilisateur) {

    echo "Nom d'utilisateur : " . $utilisateur['nom_utilisateur'] . "<br>";

    echo "Mot de passe : " . $utilisateur['mot_de_passe'] . "<br>";

    echo "Âge : " . $utilisateur['age'] . "<br>";

    echo "Date d'inscription : " . $utilisateur['date_inscription'] . "<br>";

}

// Vérifier si le formulaire de connexion a été soumis

if (isset($_POST['connexion'])) {

    $nom_utilisateur = $_POST['nom_utilisateur'];

    $mot_de_passe = $_POST['mot_de_passe'];

    $conn = connectDB();

    $query = "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$nom_utilisateur' AND mot_de_passe = '$mot_de_passe'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        echo "Connexion réussie<br>";

        $utilisateur = $result->fetch_assoc();

        afficherChampsUtilisateur($utilisateur);

    } else {

        echo "Échec de la connexion<br>";

    }

    $conn->close();

}

// Vérifier si le formulaire d'inscription a été soumis

if (isset($_POST['inscription'])) {

    $nom_utilisateur = $_POST['nom_utilisateur'];

    $mot_de_passe = $_POST['mot_de_passe'];

    $age = $_POST['age'];

    $date_inscription = date("Y-m-d H:i:s");

    $conn = connectDB();

    $query = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, age, date_inscription) VALUES ('$nom_utilisateur', '$mot_de_passe', '$age', '$date_inscription')";

    if ($conn->query($query) === TRUE) {

        echo "Inscription réussie<br>";

        $utilisateur = [

            'nom_utilisateur' => $nom_utilisateur,

            'mot_de_passe' => $mot_de_passe,

            'age' => $age,

            'date_inscription' => $date_inscription

        ];

        afficherChampsUtilisateur($utilisateur);

    } else {

        echo "Erreur lors de l'inscription : " . $conn->error . "<br>";

    }

    $conn->close();

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Page de connexion/inscription</title>

</head>

<body>

    <h1>Page de connexion/inscription</h1>

    <h2>Connexion</h2>

    <form method="POST" action="">

        <label for="nom_utilisateur">Nom d'utilisateur :</label>

        <input type="text" name="nom_utilisateur" required><br>

        <label for="mot_de_passe">Mot de passe :</label>

        <input type="password" name="mot_de_passe" required><br>

        <input type="submit" name="connexion" value="Se connecter">

    </form>

    <h2>Inscription</h2>

    <form method="POST" action="">

        <label for="nom_utilisateur">Nom d'utilisateur :</label>

        <input type="text" name="nom_utilisateur" required><br>

        <label for="mot_de_passe">Mot de passe :</label>

        <input type="password" name="mot_de_passe" required><br>

        <label for="age">Âge :</label>

        <input type="number" name="age" required><br>

        <input type="submit" name="inscription" value="S'inscrire">

    </form>

</body>

</html>


