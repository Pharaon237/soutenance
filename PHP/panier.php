<?php
function recuper_produit($id) {
    global $nom, $pu, $qte, $photos;
    try {
        include("connexion_bd.php");
        $sql = "SELECT p.Nom_pro, p.PU_pro,p.url_pro, p.Qte_pro
                FROM produit p 
                WHERE p.Id_pro = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nom = $row['Nom_pro'];
                $pu = $row['PU_pro'];
                $photos = $row['url_pro'];
                $qte = $row['Qte_pro'];
            }
        } else {
            echo "Aucun produit trouvé pour l'ID";
            echo $id;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function Enregistrer_produit($nom, $pu, $photos, $qte, $qtes, $preced,$id_util) {
    try {
        include("connexion_bd.php");

        // Insertion des données dans la base de données
        $sql = "INSERT INTO panier(Nom_pro,PU_pro,qte_voulu,url_pro,Etat,mt_total,Id_util) values(:nom,:pu,:qte,:photo,:etat,:mot,:util)";
        $sql = $db->prepare($sql);
        $sql->bindValue(':nom', $nom);
        $sql->bindValue(':util',$id_util);
        $sql->bindValue(':pu', $pu);
        $sql->bindValue(':qte', $qtes);
        $sql->bindValue(':photo', $photos);
        $etat = ($qtes <= $qte) ? "quantité Disponible" : "quantité indisponible";
        $sql->bindValue(':etat', $etat);
        $mot = intval($pu) * intval($qtes);
        $sql->bindValue(':mot', $mot);
        $sql->execute();
        if ($sql) {
            echo "<script><h3><font color=blue>alert('produit ajouté au panier');</font></h3></script>";
            header('Location: ' . $preced);
        } else {
            echo '<h3><div class="alert alert-danger"><em>Échec d\'envoi dans le panier</em></div></h3>';
        }
        $sql->closeCursor();
    } catch (Exception $e) {
        die('Erreur:' . $e->getMessage());
    }
}

function Afficher_produit($id_util) {
    try {
        include("connexion_bd.php");

        // $id_util = $_SESSION['id'];
        $sql = "SELECT * FROM panier WHERE Id_util=$id_util";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>Produit</th>";
            echo "<th>Nom du produit</th>";
            echo "<th>Quantité</th>";
            echo "<th>Prix unitaire</th>";
            echo "<th>Montant du produit</th>";
            echo "<th>Etats</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo '<td class="my-2 h-100"><img src="' . $row['url_pro'] . '" alt="image du produit" style="max-height: 100px;"></td>';
                echo "<td class=\"product-title\">" . $row['Nom_pro'] . "</td>";
                echo "<td>" . $row['qte_voulu'] . "</td>";
                echo "<td>" . $row['PU_pro'] . "</td>";
                echo "<td>" . $row['mt_total'] . "</td>";
                echo "<td>" . $row['Etat'] . "</td>";
                echo '<td>';
                echo '<a href="panier.php?id=' . $row['id_panier'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet enregistrement ?\');" class="mr-5"><i class="fas fa-trash-alt"></i></a>';
                echo '<button class="commander-btn ope mr-8" data-id="' . $row['id_panier'] . '" data-nom="' . $row['Nom_pro'] . '" data-pu="' . $row['PU_pro'] . '" data-qte="' . $row['qte_voulu'] . '"><i class="fas fa-credit-card"></i></button>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo '
                <button type="button" id="openModalBtn" class="commander-btn ope">Tout Commander</button>
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Choisissez votre mode de paiement :</h2>
                        <form id="modePaiementForm" action="traitement.php" method="post">
                            <label for="modePaiement">Mode de paiement :</label>
                            <select id="modePaiement" name="modePaiement">
                                <option value="Espèces">Espèces</option>
                                <option value="Carte de crédit">Carte de crédit</option>
                                <option value="PayPal">PayPal</option>
                                <option value="Virement bancaire">Virement bancaire</option>
                            </select>
                            <input type="submit" value="Valider">
                        </form>
                    </div>
                </div>
            ';
        } else {
            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function supprimer_produit($id) {
    try {
        include("connexion_bd.php");
        $sql = "DELETE FROM panier WHERE id_panier=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            // Suppression réussie
            header('location: panier.php');
        } else {
            echo '<h3><div class="alert alert-danger"><em>Echec de suppression</em></div></h3>';
        }
    } catch (Exception $e) {
        die('Erreur:' . $e->getMessage());
    }
}

?>

<?php
$preced = "";
$qtes = "";
$id_util="";

if (isset($_POST['qant'])) {
    $qtes = $_POST['qant'];
}

if (isset($_POST['pageName'])) {
    $preced = $_POST['pageName'];
}

if (isset($_POST['val_enr'])) {
    $id = $_POST['val_enr'];
    recuper_produit($id);
    session_start();
    $id_util=$_SESSION['id'];
    Enregistrer_produit($nom, $pu, $photos, $qte, $qtes, $preced,$id_util);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimer_produit($id);
}

include '../html/panier.html';
?>
