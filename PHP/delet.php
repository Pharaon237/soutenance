<?php
function supprime_image($db, $id){
    try{
        // Sélectionner l'URL de l'image à partir de la base de données
        $sql = "SELECT url_pro FROM produit WHERE Id_pro=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Spécifiez le chemin d'accès de l'image à supprimer
                $chemin_image_a_supprimer = $row['url_pro'];

                // Vérifiez si le fichier existe avant de tenter de le supprimer
                if (file_exists($chemin_image_a_supprimer)) {
                    // Supprimez le fichier
                    unlink($chemin_image_a_supprimer);
            }
        } else {
            echo "Aucune image associée à cet ID de produit.";
        }
    } catch(Exception $e){
        die('Erreur:'.$e->getMessage());
    }
}

// Assurez-vous que l'ID est défini
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    try{
        include("connexion_bd.php");
        supprime_image($db, $id);

        // Supprimez l'entrée de produit après avoir supprimé l'image
        $sql = "DELETE FROM produit WHERE Id_pro=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        unset($id); // Effacez l'ID après la suppression
        header('location:acc_produit.php');
    } catch(Exception $e){
        die('Erreur:'.$e->getMessage());
    }
} else {
    echo "ID du produit non spécifié.";
}
?>
