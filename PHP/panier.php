<?php

function Enregistrer_produit($qtes, $id, $id_util, $preced)
{
    try {
        include 'connexion_bd.php';

        // Insertion des données dans la base de données
        $sql = 'INSERT INTO panier(qte_voulu,Etat,Id_util,Id_pro) values(:qte,:etat,:util,:pro)';
        $sql = $db->prepare($sql);
        $sql->bindValue(':util', $id_util);
        $sql->bindValue(':qte', $qtes);
        $sql->bindValue(':pro', $id);
        $etat = ($qtes <= $qte) ? 'quantité Disponible' : 'quantité indisponible';
        $sql->bindValue(':etat', $etat);
        $sql->execute();
        if ($sql) {
            echo "<script><h3><font color=blue>alert('produit ajouté au panier');</font></h3></script>";
            header('Location: '.$preced);
        } else {
            echo '<h3><div class="alert alert-danger"><em>Échec d\'envoi dans le panier</em></div></h3>';
        }
        $sql->closeCursor();
    } catch (Exception $e) {
        exit('Erreur:'.$e->getMessage());
    }
}

function Afficher_produit($id_util)
{
    try {
        include 'connexion_bd.php';

        // $id_util = $_SESSION['id'];
        $sql = "SELECT * FROM panier, produit WHERE Id_util=$id_util AND panier.Id_pro=produit.Id_pro";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<form id="panierForm" method="post" action="../php/commande.php">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Produit</th>';
            echo '<th>Nom du produit</th>';
            echo '<th>Quantité</th>';
            echo '<th>Prix unitaire</th>';
            echo '<th>Montant du produit</th>';
            echo '<th>Etats</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td class="my-2 h-100"><img src="'.$row['url_pro'].'" alt="image du produit" style="max-height: 100px;"></td>';
                echo '<td class="product-title">'.$row['Nom_pro'].'</td>';
                echo '<td><input type="text" name="quantite" value="'.$row['qte_voulu'].'"></td>';
                echo '<td>'.$row['PU_pro'].'</td>';
                $mont = $row['PU_pro'] * $row['qte_voulu'];
                echo '<td>'.$mont.'</td>';
                echo '<td>'.$row['Etat'].'</td>';
                echo '<td>';
                echo '<a href="panier.php?id='.$row['id_panier'].'" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet enregistrement ?\');" class="mr-5"><i class="fas fa-trash-alt"></i></a>';
                echo '<button type="submit" name="commander_single" class="commander-btn ope mr-8" data-id="'.$row['id_panier'].'"><i class="fas fa-credit-card"></i></button>';

                // Ajout des champs cachés pour chaque produit
                echo '<input type="hidden" name="id_produit[]" value="'.$row['Id_pro'].'">';
                echo '<input type="hidden" name="id_panier[]" value="'.$row['id_panier'].'">';
                echo '<input type="hidden" name="montant[]" value="'.$mont.'">';

                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</form>';

            /*echo '
                <button type="button" name="commander_all" class="commander-btn ope mr-8">Tout Commander</button>
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Choisissez votre mode de paiement :</h2>
                        <div id="modePaiementForm">
                            <label for="modePaiement">Mode de paiement :</label>
                            <select id="modePaiement" name="modePaiement">
                                <option value="Espèces">Payement a la livraison</option>
                                <!--<option value="Carte de crédit">Carte de crédit</option>
                                <option value="PayPal">PayPal</option>
                                <option value="Virement bancaire">Virement bancaire</option>--!>
                            </select>
                            <input type="submit" name="valider" value="Valider">
                        </div>
                    </div>
                </div>
            ';*/

            if (isset($_POST['commander_single'])) {
                echo '<form id="commanderSingleForm" method="post" action="../php/commande.php">';
                echo '<input type="hidden" name="id_produit" value="'.$_POST['Id_pro'].'">';
                echo '<input type="hidden" name="id_panier" value="'.$_POST['id_panier'].'">';
                echo '<input type="hidden" name="mont" value="'.$mont.'">';
                echo '</form>';
                echo '<script>document.getElementById("commanderSingleForm").submit();</script>';
            }

            if (isset($_POST['commander_all'])) {
                echo '<form id="commanderAllForm" method="post" action="../php/commande.php">';
                // Ajoutez d'autres champs invisibles pour d'autres données nécessaires
                echo '</form>';
                echo '<script>document.getElementById("commanderAllForm").submit();</script>';
            }
        } else {
            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
        }
    } catch (PDOException $e) {
        echo 'Erreur : '.$e->getMessage();
    }
}

function supprimer_produit($id)
{
    try {
        include 'connexion_bd.php';
        $sql = 'DELETE FROM panier WHERE id_panier=:id';
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
        exit('Erreur:'.$e->getMessage());
    }
}

?>

<?php
$preced = '';
$qtes = '';
$id_util = '';

if (isset($_POST['qant'])) {
    $qtes = $_POST['qant'];
}

if (isset($_POST['pageName'])) {
    $preced = $_POST['pageName'];
}

if (isset($_POST['val_enr'])) {
    $id = $_POST['val_enr'];
    session_start();
    $id_util = $_SESSION['id'];
    Enregistrer_produit($qtes, $id, $id_util, $preced);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimer_produit($id);
}

include '../html/panier.html';
?>
