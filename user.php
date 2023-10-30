
<?php
class Utilisateur {
    public $prenom;
    public $nom;
    public $telephone;
    public $email;
    public $password;
    public $db;

    public function __construct() {
        // Établir une connexion à la base de données en utilisant la classe PDO
        $dsn = "mysql:host=localhost;dbname=bref6: poo";
        $user = "root";
        $pass = " ";

        try {
            $this->db = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function Inscription($prenom, $nom, $telephone, $email, $password) {
        $query = "INSERT INTO utilisateurs (prenom, nom, telephone, email, password) VALUES (:prenom, :nom, :telephone, :email, :password)";
        $stmt = $this->db->prepare($query);

        // Liaison des valeurs
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "L'utilisateur s'est inscrit avec l'adresse email : " . $email . "<br>";
        } else {
            echo "Erreur lors de l'inscription.<br>";
        }
    }

    public function Connexion($email, $password) {
        $query = "SELECT * FROM utilisateurs WHERE email = :email AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "Connexion réussie pour " . $user['prenom'] . " " . $user['nom'] . "<br>";
        } else {
            echo "Échec de la connexion. Veuillez vérifier vos identifiants.<br>";
        }
    }

    public static function ConsulterListeUtilisateurs() {
        // Logique pour consulter la liste des utilisateurs depuis la base de données
        $dsn = "mysql:host=nom_du_serveur;dbname=nom_de_la_base_de_donnees";
        $user = "nom_utilisateur";
        $pass = "mot_de_passe";

        try {
            $db = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        $query = "SELECT * FROM utilisateurs";
        $stmt = $db->query($query);

        echo "Liste des utilisateurs :<br>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['prenom'] . " " . $row['nom'] . "<br>";
        }
    }
}

Utilisateur::ConsulterListeUtilisateurs();