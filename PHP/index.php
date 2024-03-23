
<?php
    // function Afficher_produit(){
    //     include("connexion_bd.php");
        
        // Sélectionner les ID des 4 premiers produits de chaque catégorie
        // $query_ids = $db->query("SELECT Id_pro FROM produit p1 WHERE (SELECT COUNT(*) FROM produit p2 WHERE p2.Id_cat = p1.Id_cat AND p2.Id_pro <= p1.Id_pro) <= 4");
    
        // Créer un tableau pour stocker les ID des produits à afficher
        // $product_ids = [];
        // while ($row = $query_ids->fetch(PDO::FETCH_ASSOC)) {
        //     $product_ids[] = $row['Id_pro'];
        // }
    
        // Vérifier s'il y a des produits à afficher
        // if (!empty($product_ids)) {
            // Convertir le tableau des ID des produits en une chaîne séparée par des virgules pour l'utilisation dans la clause IN de la requête principale
        //     $id_string = implode(',', $product_ids);
    // 
            // Sélectionner les produits correspondant aux ID récupérés
            // $query = $db->query("SELECT p.*, c.Lib_cat FROM produit p JOIN cathegories c ON p.Id_cat = c.Id_cat 
            //                      WHERE p.Id_pro IN ($id_string)");
    
            // $current_cat = ""; // Pour suivre la catégorie actuelle
    
            // if ($query->rowCount() > 0) {
            //     while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            //         // Vérifier si la catégorie a changé
            //         if ($current_cat != $row['Lib_cat']) {
            //             // Si oui, afficher le nom de la nouvelle catégorie
            //             echo '<h2>' . $row['Lib_cat'] . '</h2>';
            //             $current_cat = $row['Lib_cat'];
            //         }
                    
                //     echo '<div class="col-md-4">';
                //     echo '<div class="product">';
                //     echo '<a href="groupes_produit.php?id=' . $row['Id_cat'] . '">';
                //     // echo '<div class="">';
                //     echo '<img src="' . $row['url_pro'] . '" alt="' . $row['Nom_pro'] . '">';
                //     echo'</div>';
                //     echo '</a>';
                //     echo '</div>';
                //     // echo '</div>';
                // }
    //         } else {
    //             echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
    //         }
    //     } else {
    //         echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
    //     }
    // }

    

    function Afficher_produit(){
        include("connexion_bd.php");
        
        // Sélectionner toutes les catégories
        $query_categories = $db->query("SELECT DISTINCT c.Id_cat, c.Lib_cat FROM cathegories c JOIN produit p ON c.Id_cat = p.Id_cat");
    
        while ($category_row = $query_categories->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="category-block">';
            echo '<h2>' . $category_row['Lib_cat'] . '</h2>';
            
            // Ouvrir un nouveau bloc pour les images de la catégorie actuelle
            echo '<div class="category-images row">';
            
            // Sélectionner les produits de la catégorie actuelle
            $query_products = $db->prepare("SELECT * FROM produit WHERE Id_cat = ?");
            $query_products->execute([$category_row['Id_cat']]);
            
            if ($query_products->rowCount() > 0) {
                while ($product_row = $query_products->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="col-md-3">';
                    echo '<div class="product">';
                    echo '<a href="groupes_produit.php?id=' . $product_row['Id_cat'] . '">';
                    echo '<div class="">';
                    echo '<img src="' . $product_row['url_pro'] . '" alt="' . $product_row['Nom_pro'] . '">';
                    echo'</div>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
            }
            
            // Fermer le bloc des images de la catégorie actuelle
            echo '</div>'; 
            
            // Fermer le bloc de catégorie
            echo '</div>'; 
        }
    }
    
    
    
    
?>


<?php
    include("..\html\index.html");
?>