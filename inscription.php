<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body align="center">
    <h1>Bienvenue</h1>
    <p>Inscrivez-vous en renseignant les informations suivantes.</p>
    <form action="traitement_inscription.php" method="POST">
        <div>
            <div>
                <label for="prenom">Prénom</label><br>
                <input type="text" name="prenom" id="prenom" placeholder="Nadia" required>
            </div>
            <div>
                <label for="nom">Nom</label><br>
                <input type="text" name="nom" id="nom" placeholder="Abderahim" required>
            </div>
        </div>
        <label for="telephone">Téléphone</label><br>
        <input type="tel" name="telephone" id="telephone" placeholder="770012255"><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" id="password"><br>
        <label for="password_retype">Confirmation mot de passe</label><br>
        <input type="password" name="password_retype" id="password_retype"><br><br>
        
        <input type="submit" value="S'inscrire">
    </form>

    <p><a href="connexion.html">Se connecter>></a></p>
</body>
</html>


<?php

class Utilisateur {
    private $db;

    public function __construct() {
        // Initialisez la connexion à la base de données (à adapter en fonction de vos paramètres)
        $dsn = "mysql:host=localhost;dbname=bref6: poo";
        $user = "root";
        $pass = "";

        try {
            $this->db = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function Inscription($prenom, $nom, $telephone, $password) {
        // Insérez les données de l'utilisateur dans la base de données
        $query = "INSERT INTO utilisateurs (prenom, nom, telephone, password) VALUES (:prenom, :nom, :telephone, :password)";
        $stmt = $this->db->prepare($query);

        // Liaison des valeurs
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':password', $password);

        // Exécution de la requête
        if ($stmt->execute()) {
            return "L'utilisateur s'est inscrit avec succès.";
        } else {
            return "Erreur lors de l'inscription.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $utilisateur = new Utilisateur();
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $message = $utilisateur->Inscription($prenom, $nom, $telephone, $password);
    echo $message;
}
?>

?>