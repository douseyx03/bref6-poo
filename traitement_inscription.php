<?php
//traitement
class Utilisateur {
    public $prenom;
    public $nom;
    public $telephone;
    public $email;
    public $password;

    public function Inscription($prenom, $nom, $telephone, $email, $password, $password_retype) {
        if ($this->validerPrenom($prenom) && $this->validerNom($nom) && $this->validerTelephone($telephone) && $this->validerEmail($email) && $this->validerMotDePasse($password, $password_retype)) {
            // Connexion à la base de données (assurez-vous de configurer la connexion)
            $db = new PDO("mysql:host=localhost;dbname=bref6: poo", "root", " ");

            $query = "INSERT INTO utilisateurs (prenom, nom, telephone, email, password) VALUES (:prenom, :nom, :telephone, :email, :password)";
            $stmt = $db->prepare($query);

            // Liaison des valeurs
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            // Exécution de la requête
            if ($stmt->execute()) {
                echo "L'utilisateur s'est inscrit avec succès.<br>";
            } else {
                echo "Erreur lors de l'inscription.<br>";
            }
        } else {
            echo "Veuillez vérifier les données fournies.<br>";
        }
    }

    private function validerPrenom($prenom) {
        return (ctype_alpha($prenom) && strlen($prenom) <= 25);
    }

    private function validerNom($nom) {
        return (ctype_alpha($nom) && strlen($nom) <= 25);
    }

    private function validerTelephone($telephone) {
        return (preg_match('/^77[0-9]{7}$/', $telephone));
    }

    private function validerEmail($email) {
        return (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[a-z0-9]+@[a-z]+\.[a-z]{2,}$/', $email));
    }

    private function validerMotDePasse($password, $password_retype) {
        return (ctype_alnum($password) && preg_match('/^[a-zA-Z0-9$#@!?,]+$/', $password) && $password === $password_retype);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $utilisateur = new Utilisateur();
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $password_retype = $_POST['password_retype'];

    $utilisateur->Inscription($prenom, $nom, $telephone, $email, $password, $password_retype);
}
?>
