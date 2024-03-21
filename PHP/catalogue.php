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
?>

<?php
include'..\html\catalogue.html';
?>