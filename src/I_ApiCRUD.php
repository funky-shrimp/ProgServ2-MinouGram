<?php

namespace Minougram\Classes;

interface I_ApiCRUD {
    /**
     * Permet d'ajouter un utilisateur dans la base de données
     * @param \Minougram\Classes\Utilisateur $utilisateur
     * @return int Retourne l'ID de l'utilisateur
     */
    public function ajouteUtilisateur(Utilisateur $utilisateur): int;
    /**
     * Retourne un utilisateur suivant son adresse mail
     * @param string $email
     * @return \Minougram\Classes\Utilisateur Retourne un objet Utilisateur
     */
    public function rendUtilisateurEmail(string $email): Utilisateur;
    
    /**
     * Retourne la photo de profil d'un utilisateur
     * @param \Minougram\Classes\Utilisateur $utilisateur
     * @return array Retourne un tableau contenant l'image
     */
    public function rendUtilisateurPhoto(Utilisateur $utilisateur): array;
    /**
     * Rend les publications du jour précédent et du jour même.
     * @return array Retourne un tableau de publications
     */
    public function rendPublications(): array;
    /**
     * Retourne les publications d'un utilisateur
     * @param \Minougram\Classes\Utilisateur $utilisateur
     * @return array Retourne une tableau de publications
     */
    public function rendPublicationsUtilisateur(Utilisateur $utilisateur): array;
    /**
     * Retourne le nombre de likes d'une publication
     * @param int $publicationId
     * @return int Retourne le nombre de likes
     */
    public function rendPublicationsLike(int $publicationId):int;
    /**
     * Rend l'Id de l'utilisateur associé au Token
     * @param string $token
     * @return int Retourne l'ID
     */
    public function rendPersonneIdToken(string $token): int;
    /**
     * Rend le token d'un utilisateur suivant l'Id de ce dernier
     * @param int $id
     * @return string Retourne une string contenant le token
     */
    public function rendPersonneTokenId(int $id): string;
    /**
     * Change le token d'un utilisateur suivant l'Id de ce dernier
     * @param int $id
     * @param string $token
     * @return int Retourne le nombre de lignes affectées
     */
    public function changePersonneToken(int $id, string $token): int;
}