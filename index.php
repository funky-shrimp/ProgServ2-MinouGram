<?php

require './vendor/autoload.php';

use Minougram\Classes\DbManager;
use Minougram\Classes\Utilisateur;

$db = new DbManager();

$user = new Utilisateur("funkyshrimp", "Funky", "Shrimp", "funky.shrimp@gmail.com", "0786247487", "MdpMdp1!");

$id = $db->ajouteUtilisateur($user);

