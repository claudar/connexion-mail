<?php
session_start(); // on initialise la session

if (isset($_POST["submit"])) //on verifie si la variable est bien citée dans le if
{
    // on recupere les variables username et password si on fait un echo de $username ou  password on aura le nom qui s'affichera
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    //on se connecte a la base de données

    $db = new PDO('mysql:host=localhost;dbname=loginsystem','root','root');


    // on fait notre requete pour recuperer les informations sur l'utilisateur dans la base de données
    $sql = " SELECT * FROM user where username = '$username' ";
    $result = $db->prepare($sql);
    $result -> execute();
    if ($result->rowCount() > 0) //on va tester si on a un enregistrement dans la base de données
    {
// pour eviter qu'un uilisateur se connecte plusieurs fois avec le meme nom/pseudo on procede comme suit
        $data = $result->fetchAll(); // je crée une variable data avec un fetchAll pour verifier le mot de passe
        if (password_verify($pass, $data[0]["password"])) //verification si le mot de passe de l'utilisateur est le meme que dans la base de données
        {
            echo "connexion done";
            $_SESSION['username'] = $username; // on enregistre une variable de session qui va nous servir a dire aux autres pages du site qu'un utilisateur est bien connecté
            header('Location:index.php'); // je rajoute un header location pour bien etre redirigé sur la page d'accueil du site et non sur la page login php si l'utilisateur est deja connu
        }
        else
        {

        }


    }

    else
    {
        // dans le cas ou il y a pas d'utilisateur on va hashé le password
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        // on insere un nouvel utilisateur dans la base de données via cette requete
        $sql ="INSERT INTO user (username, password) VALUES ('$username','$pass')";
        $req =$db->prepare($sql);
        $req->execute();
        echo "Registery Done"; //message qui va s'afficher si on a une nouvelle entrée dans la base de données'

    }
}


?>
