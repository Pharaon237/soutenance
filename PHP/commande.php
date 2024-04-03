<?php
    function Enregistrer_vente($qte, $id_util)
    {
        try {
            include 'connexion_bd.php';

            // Insertion des données dans la base de données
            $sql = 'INSERT INTO commande(Qte_com,Etat_com,Id_util) values(:qte,:etat,:id)';
            $sql = $db->prepare($sql);
            $sql->bindValue(':id', $id_util);
            $sql->bindValue(':Etat_com', 'passer');
            $sql->bindValue(':qte', $qte);
            $sql->execute();
            if ($sql) {
                echo "<script><h3><font color=blue>alert('produit commander');</font></h3></script>";
                header('Location:commande.php');
            } else {
                echo '<h3><div class="alert alert-danger"><em>Échec de la commande</em></div></h3>';
            }
            $sql->closeCursor();
        } catch (Exception $e) {
            exit('Erreur:'.$e->getMessage());
        }
    }

    function enregis($id_produit, $mont)
    {
        try {
            include 'connexion_bd.php';
            $daten = date('Y-m-d H:i:s');
            $sql = 'INSERT INTO ligne_commande(Id_pro,Mt_com,Date_com) values(:pro,:mont,:daten)';
            $sql = $db->prepare($sql);
            $sql->bindValue(':pro', $id_produit);
            $sql->bindValue(':mont', $mont);
            $sql->bindValue(':daten', $daten);
            $sql->execute();
            if ($sql) {
                echo "<script><h3><font color=blue>alert('produit commander');</font></h3></script>";
                header('Location:commande.php');
            } else {
                echo '<h3><div class="alert alert-danger"><em>Échec de la commande</em></div></h3>';
            }
            $sql->closeCursor();
        } catch (Exception $e) {
            exit('erreur2'.$e->getmessage());
        }
    }
    function Afficher_commande()
    {
        try {
            include 'connexion_bd.php';

            // $id_util = $_SESSION['id'];
            $sql = 'SELECT *
            FROM commandes
            INNER JOIN utilisateurs ON commandes.Id_util = utilisateurs.id_util
            INNER JOIN ligne_commande ON commandes.Id_com = ligne_commande.Id_com
            INNER JOIN produit ON ligne_commande.Id_pro = produit.Id_pro;
            ';
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo '<form  method="post" action="#">';
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Date</th>';
                echo '<th>Produit</th>';
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
                    echo '<td>'.$row['Id_com'].'</td>';
                    echo '<td>'.$row['Date_com'].'</td>';
                    echo '<td class="my-2 h-100"><img src="'.$row['url_pro'].'" alt="image du produit" style="max-height: 100px;"></td>';
                    echo '<td>'.$row['Qte_com'].'</td>';
                    echo '<td>'.$row['PU_pro'].'</td>';
                    echo '<td>'.$row['Mt_com'].'</td>';
                    echo '<td>'.$row['Etat_com'].'</td>';
                    echo '<td>';
                    echo '<a href="panier.php?id='.$row['id_panier'].'" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet enregistrement ?\');" class="mr-5"><i class="fas fa-trash-alt"></i></a>';
                    echo '<button type="button" name="commander_single" class="commander-btn ope mr-8" data-id="'.$row['id_panier'].'"><i class="fas fa-credit-card"></i></button>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</form>';
            }
        } catch (Exseption $e) {
            echo 'erreur 2:'.$e->getmessage();
        }
    }
?>




<?php
$qte = '';
$id_util = '';
$mont = '';
$id_produit = '';
if (isset($_POST['quantite'])) {
    $qte = $_POST['quantite'];
}
if (isset($_SESSION['id'])) {
    $id_util = $_SESSION['id'];
}
if (isset($_POST['id_produit'])) {
    $id_produit = $_POST['id_produit'];
}
if (isset($_POST['mont'])) {
    $mont = $_POST['mont'];
}
 if (isset($_POST['commander_single'])) {
     Enregistrer_vente($qte, $id_util, );
     enregis($id_produit, $mont);
 }
include '../html/commande.html';
?>