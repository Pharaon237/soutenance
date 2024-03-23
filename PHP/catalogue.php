<?php
    function Afficher_produit(){
        include("connexion_bd.php");
     
     $query = $db->query("SELECT * FROM produit");
                
     if ($query->rowCount() > 0) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-4">';
            echo '<div class="product">';
            echo '<a href="produit.php?id=' . $row['Id_pro'] . '">';
            echo '<img src="' . $row['url_pro'] . '" alt="' . $row['Nom_pro'] . '">';
            echo '<h3 class="product-title">' . $row['Nom_pro'] . '</h3>';
            echo '<p>' . $row['PU_pro'] . '</p>';
            echo '</a>';
            echo '<p>' . $row['Desc_pro'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }else {
        echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
    }
}


function Afficher_produit(){
    include("connexion_bd.php");
    
    // Sélectionner les ID des 4 premiers produits de chaque catégorie
    $query_ids = $db->query("SELECT Id_produit FROM produit p1 WHERE (SELECT COUNT(*) FROM produit p2 WHERE p2.Id_cat = p1.Id_cat AND p2.Id_produit <= p1.Id_produit) <= 4");

    // Créer un tableau pour stocker les ID des produits à afficher
    $product_ids = [];
    while ($row = $query_ids->fetch(PDO::FETCH_ASSOC)) {
        $product_ids[] = $row['Id_produit'];
    }

    // Vérifier s'il y a des produits à afficher
    if (!empty($product_ids)) {
        // Convertir le tableau des ID des produits en une chaîne séparée par des virgules pour l'utilisation dans la clause IN de la requête principale
        $id_string = implode(',', $product_ids);

        // Sélectionner les produits correspondant aux ID récupérés
        $query = $db->query("SELECT p.*, c.Lib_cat FROM produit p JOIN categorie c ON p.Id_cat = c.Id_cat 
                             WHERE p.Id_produit IN ($id_string)");

        $current_cat = ""; // Pour suivre la catégorie actuelle

        if ($query->rowCount() > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                // Vérifier si la catégorie a changé
                if ($current_cat != $row['Lib_cat']) {
                    // Si oui, afficher le nom de la nouvelle catégorie
                    echo '<h2>' . $row['Lib_cat'] . '</h2>';
                    $current_cat = $row['Lib_cat'];
                }
                
                echo '<div class="col-md-4">';
                echo '<div class="product">';
                echo '<a href="groupes_produit.php?id=' . $row['Id_cat'] . '">';
                echo '<div class="">';
                echo '<img src="' . $row['url_pro'] . '" alt="' . $row['Nom_pro'] . '">';
                echo'</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
        }
    } else {
        echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
    }
}



?>

<?php
include'..\html\catalogue.html';
?>