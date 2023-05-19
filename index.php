<?php

// Informations de connexion à la base de données

$host = "mysql-minepluie.alwaysdata.net";

$user = "minepluie";

$password = "Flammouche";

$database = "minepluie_connexionjeu";

// Connexion à la base de données

$conn = new mysqli($host, $user, $password, $database);

// Vérifier la connexion

if ($conn->connect_error) {

    die("Échec de la connexion à la base de données: " . $conn->connect_error);

}

// Inscription d'un nouvel utilisateur

if (isset($_POST['inscription'])) {

    $nom_utilisateur = $_POST['nom_utilisateur'];

    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête d'insertion

    $sql = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES ('$nom_utilisateur', '$mot_de_passe')";

    if ($conn->query($sql) === TRUE) {

        echo "Inscription réussie";

    } else {

        echo "Erreur lors de l'inscription: " . $conn->error;

    }

}

// Connexion de l'utilisateur

if (isset($_POST['connexion'])) {

    $nom_utilisateur = $_POST['nom_utilisateur'];

    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête de sélection

    $sql = "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$nom_utilisateur' AND mot_de_passe = '$mot_de_passe'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "Connexion réussie";

    } else {

        echo "Échec de la connexion";

    }

}

// Fermer la connexion

$conn->close();

?>

<!DOCTYPE html>

<html>

<head>

    <title>Page de connexion/inscription</title>

</head>

<body>

    <h1>Inscription</h1>

    <form method="post" action="">

        <label for="nom_utilisateur">Nom d'utilisateur:</label>

        <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br><br>

        <label for="mot_de_passe">Mot de passe:</label>

        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <input type="submit" name="inscription" value="S'inscrire">

    </form>

    <h1>Connexion</h1>

    <form method="post" action="">

        <label for="nom_utilisateur">Nom d'utilisateur:</label>

        <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br><br>

        <label for="mot_de_passe">Mot de passe:</label>

        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <input type="submit" name="connexion" value="Se connecter">

    </form>

</body>

</html>


