<?php
class BaseDeDonnees {
    private $db;

    public function __construct() {
        // Code de connexion à la base de données
        $dsn = "mysql:host=localhost;dbname=breef6: poo";
        $user = "root";
        $pass = "";

        try {
            $this->db = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getConnexion() {
        return $this->db;
    }
}

class Utilisateur {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function Inscription($prenom, $nom, $telephone, $email, $password, $password_retype) {
        // Logique d'inscription (utilisation de $this->db pour accéder à la base de données)
    }

    public function Connexion($email, $password) {
        // Logique de connexion (utilisation de $this->db pour accéder à la base de données)
    }
}

class PageInscription {
    public function afficherFormulaire() {
        // Affiche le formulaire d'inscription
    }
}

class PageConnexion {
    public function afficherFormulaire() {
        // Affiche le formulaire de connexion
    }
}

class PageBienvenue {
    private $utilisateur;

    public function __construct($utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    public function afficherListeUtilisateurs() {
        // Affiche la liste des utilisateurs (après connexion)
    }
}

// Code pour gérer les requêtes POST pour l'inscription et la connexion, et afficher les pages en conséquence
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new BaseDeDonnees();
    $utilisateur = new Utilisateur($db->getConnexion());

    if (isset($_POST['inscription'])) {
        // Traiter l'inscription
    } elseif (isset($_POST['connexion'])) {
        // Traiter la connexion
    }
}
