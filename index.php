<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez
 * en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.
$server = "localhost";
$db = "table_test_php";
$user = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = ( "
        INSERT INTO user VALUES (null, 'Ard', 'Chloé', 'ruelle vitou', 4, 59186, 'Anor', 'France', 'chlochlo.ard@mail.fr')
    ");

    $bdd->exec($sql1);

    $stm = $bdd->prepare("
        UPDATE user SET nom = :nom WHERE id = :id
    ");

    $nom2 = "Ardoise";
    $id2 = $bdd->lastInsertId();

    $stm->bindParam(":nom", $nom2);
    $stm->bindParam(":id", $id2);

    $stm->execute();
    if ($stm->rowCount() > 0) {
        echo "Utilisateur a été modifié !";
    }
    else {
        echo "Aucun utilisateur n'a été modifié";
    }
}
catch(PDOException $e) {
    echo $e->getMessage();
    $bdd->rollBack();
}



/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */