<?php

namespace Minougramm\Classes;

// Ce script permet d'envoyer un mail sur le serveur mail : MailHog en local
// Remarque : Pour que cela fonctionne, il faut avoir démarré le serveur ;-)
// Libraire permettant l'envoi de mail (Symfony Mailer)
require_once '../vendor/autoload.php';
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Minougramm\Classes\Utilisateur;
use \Exception;


class EmailManager
{


    public static function sendValidationEmail(Utilisateur $destinator, string $token)
    {
        if (!empty($destinator)) {
            $transport = Transport::fromDsn('smtp://localhost:1025');
            $mailer = new Mailer($transport);
            $email = (new Email())
                ->from('confirmation@minougram.ch')
                ->to($destinator->rendEmail())
                ->subject('Account creation validation')
                ->text('Veuillez confirmer la création du compte')
                ->html("<a href=http://localhost/deuxieme_annee/exercice_auth_simple/confirmation.php?token=$token>Confirmer la création du compte</a>");
            try{
                $mailer->send($email);
            }catch(Exception $e){
                echo $e->getMessage();
            }
                
        }
    }
}