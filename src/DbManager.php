<?php

namespace Minougram\Classes;
use Exception;

class DbManager implements I_ApiCRUD{
    
    private $db;

    public function __construct(){
        $config = parse_ini_file('db' . DIRECTORY_SEPARATOR . 'db.ini', true);
        $dsn = $config['dsn'];
        $username = $config['username'];
        $password = $config['password'];
        $this->db = new \PDO($dsn, $username, $password);
        if (!$this->db) {
            die("Problème de connection à la base de données");
        }
    }

    public function ajouteUtilisateur(Utilisateur $utilisateur): int{
        $datas = [
            'userName' => $utilisateur->rendPseudo(),
            'firstName' => $utilisateur->rendPrenom(),
            'lastName' => $utilisateur->rendNom(),
            'telephone' => $utilisateur->rendNoTel(),
            'email' => $utilisateur->rendEmail(),
            'password' => $this->creerHash($utilisateur->rendMdp())
        ];
        $sql = "INSERT INTO users (userName,firstName,lastName, telephone, email, password) VALUES "
            . "(:userName,:firstName,:lastName,:telephone,:email,:password)";

        $this->db->prepare($sql)->execute($datas);


        return $this->db->lastInsertId();
    }

    public function rendUtilisateurEmail(string $email): Utilisateur{
        $sql = "SELECT * From users WHERE email = :email;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('email', $email, \PDO::PARAM_STR);
        return $this->rendUtilisateur($stmt);
    }

    private function rendUtilisateur(\PDOStatement $stmt): Utilisateur{
        $stmt->execute();
        $donnees = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $tabPersonnes = [];
        if ($donnees) {
            foreach ($donnees as $donneesPersonne) {
                $p = new Utilisateur(
                    $donneesPersonne["userName"],
                    $donneesPersonne["firstName"],
                    $donneesPersonne["lastName"],
                    $donneesPersonne["email"],
                    $donneesPersonne["telephone"],
                    $donneesPersonne["password"],
                    $donneesPersonne["id"]
                );
                $tabPersonnes[] = $p;
            }
        }
        return $tabPersonnes[0];
    }

    public function rendUtilisateurPhoto(Utilisateur $utilisateur): array{
        return [];
    }

    public function rendPublicationsUtilisateur(Utilisateur $utilisateur): array{
        return [];
    }

    public function rendPublications(): array{
        return [];
    }

    public function rendPublicationsLike(int $publicationId): int{
        return 0;
    }

    public function rendPersonneIdToken(string $token): int{
        return 0;
    }

    public function rendPersonneTokenId(int $id): string{
        return 0;
    }

    public function changePersonneToken(int $id, string $token): int{
        return 0;
    }

    private function creerHash(string $string): string{
        $hash = "";

        if (!empty($string)) {
            $hash = password_hash($string, PASSWORD_DEFAULT);
        }

        return $hash;
    }
}