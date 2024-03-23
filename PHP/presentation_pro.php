
<?php
//    function recuper_produit($id) {
//     global $nom, $pu, $desc,$photo, $coul, $qte, $lib_cat, $lib_marq;
//     try {
//         include("connexion_bd.php");
//         $sql = "SELECT p.Nom_pro, p.PU_pro, p.Desc_pro, p.url_pro, p.Coul_pro, p.Qte_pro, c.Lib_Cat, m.Lib_marq 
//                 FROM produit p 
//                 INNER JOIN cathegories c ON p.Id_cat = c.Id_cat
//                 INNER JOIN marques m ON p.Id_marq = m.Id_marq
//                 WHERE p.Id_pro = :id";
//         $stmt = $db->prepare($sql);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         $stmt->execute();

//         if ($stmt->rowCount() > 0) {
//             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//                 $nom = $row['Nom_pro'];
//                 $pu = $row['PU_pro'];
//                 $desc = $row['Desc_pro'];
//                 $photo = $row['url_pro'];
//                 $coul = $row['Coul_pro'];
//                 $qte = $row['Qte_pro'];
//                 $lib_cat = $row['Lib_Cat'];
//                 $lib_marq = $row['Lib_marq'];
//             }
//         } else {
//             echo "Aucun produit trouvé pour l'ID $id";
//         }
//     } catch (PDOException $e) {
//         echo "Erreur : " . $e->getMessage();
//     }
// }

function recuper_produit($id) {
    global $nom, $pu, $desc, $coul, $qte, $lib_cat, $lib_marq, $marq_id, $cat_id, $val_enr, $photos, $garan, $nat;
    try {
        include("connexion_bd.php");
        $sql = "SELECT p.Id_pro,p.Nom_pro,p.Natur_produit,p.Garanti_pro, p.PU_pro, p.Desc_pro,p.url_pro, p.Coul_pro, p.Qte_pro, c.Id_cat, c.Lib_Cat,m.Id_marq, m.Lib_marq 
                FROM produit p 
                INNER JOIN cathegories c ON p.Id_cat = c.Id_cat
                INNER JOIN marques m ON p.Id_marq = m.Id_marq
                WHERE p.Id_pro = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nom = $row['Nom_pro'];
                $pu = $row['PU_pro'];
                $desc = $row['Desc_pro'];
                $coul = $row['Coul_pro'];
                $photos=$row['url_pro'];
                $qte = $row['Qte_pro'];
                $garan = $row['Garanti_pro'];
                $nat = $row['Natur_produit'];
                $lib_cat = $row['Lib_Cat'];
                // $cat_id=$row['Id_cat'];
                $lib_marq = $row['Lib_marq'];
                // $marq_id=$row['Id_marq'];
                $val_enr=$row['Id_pro'];
            }
        } else {
            echo "Aucun produit trouvé pour l'ID $id";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<?php

$nom="";
$pu="";
$desc="";
$photo="";
$coul="";
$qte="";
$lib_cat="";
$lib_marq="";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    recuper_produit($id);
}

    include("..\html\presentation_pro.html");
?>