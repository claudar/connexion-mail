<?php
function ajout_vue(){
$fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'login' . DIRECTORY_SEPARATOR . 'compteur'; //touver le cemin vers le fichier
$compteur = 1;
if (file_exists($fichier)){
    $compteur = (int)file_get_contents($fichier); //recupere les informations du fichier et je converti en entier en utilisant "int" sinon ca me renverra une chaine de caracteres
    $compteur++; // j'incremente mon compteur
}
file_put_contents($fichier, $compteur);// si le chemin n'existe pas on fait la creation du fichier
}
