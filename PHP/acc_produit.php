<?php

function Afficher_produit(){
    try {
        include("connexion_bd.php");

        $sql = "SELECT p.Id_pro, p.Nom_pro, p.PU_pro, p.Desc_pro, p.Coul_pro, p.Qte_pro, c.Lib_Cat, m.Lib_marq 
                FROM produit p
                INNER JOIN cathegories c ON p.Id_cat = c.Id_cat
                INNER JOIN marques m ON p.Id_marq = m.Id_marq";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>#</th>";
            echo "<th>Nom</th>";
            echo "<th>Prix unitaire</th>";
            echo "<th>Description</th>";
            echo "<th>Couleurs</th>";
            echo "<th>Quantité</th>";
            echo "<th>Catégorie</th>";
            echo "<th>Marque</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Id_pro'] . "</td>";
                echo "<td class=\"product-title\">" . $row['Nom_pro'] . "</td>";
                echo "<td>" . $row['PU_pro'] . "</td>";
                echo "<td>" . $row['Desc_pro'] . "</td>";
                echo "<td>" . $row['Coul_pro'] . "</td>";
                echo "<td>" . $row['Qte_pro'] . "</td>";
                echo "<td>" . $row['Lib_Cat'] . "</td>";
                echo "<td>" . $row['Lib_marq'] . "</td>";
                echo "<td>";
                // echo '<a href="acc_produit.php?id=' . $row['Id_pro'] . '" class="me-3"><i class="fas fa-eye"></i></a>';
                echo '<a href="update_produit.php?id=' . $row['Id_pro'] . '" class="me-3"><i class="fas fa-pencil-alt"></i></a>';
                echo '<a href="acc_produit.php?id=' . $row['Id_pro'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet enregistrement ?\');"><i class="fas fa-trash"></i></a>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

    function Enregistrer_marque(){
        global $name,$descriptions;
        try{
            include("connexion_bd.php");
            $sql="INSERT INTO marques(Lib_marq,Des_marq) values(:lib,:marq)";
            $sql=$db->prepare($sql);
            $sql -> bindvalue(':lib',$name);
            $sql -> bindvalue(':marq',$descriptions);
            $sql -> execute();
            if($sql){
                header('location:..acc_produit.php');
            }
            else{
                echo '<h3><div class="alert alert-danger"><em>Echec d\'insertion</em></div></h3>';
            }
            $sql->closecursor();
        }catch(Exception $e){
            die('Erreur:'.$e->getMessage());
        }
    }


    function Enregistrer_categorie(){
        global $lib;
        try{
            include("connexion_bd.php");
            $sql="INSERT INTO cathegories(Lib_Cat) values(:lib)";
            $sql=$db->prepare($sql);
            $sql -> bindvalue(':lib',$lib);
            $sql -> execute();
            if($sql){
                header('location:acc_produit.php');
            }
            else{
                echo '<h3><div class="alert alert-danger"><em>Echec d\'insertion</em></div></h3>';
            }
            $sql->closecursor();
        }catch(Exception $e){
            die('Erreur:'.$e->getMessage());
        }
    }


    function supprimer_produit($id){
        try{
            include("connexion_bd.php");
            $sql="DELETE FROM produit WHERE Id_pro=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                // Suppression réussie
                header('location: acc_produit.php');
            }else{
                echo '<h3><div class="alert alert-danger"><em>Echec de suppression</em></div></h3>';
            }
        }catch(Exception $e){
            die('Erreur:'.$e->getMessage());
        }
    }


?>

<?php

$descriptions="";
$name="";
$lib="";

    if(isset($_POST['name'])){
        $name=$_POST['name'];
    }

    if(isset($_POST['descriptions'])){
       $descriptions=$_POST['descriptions'];
    }

    if(isset($_POST['lib'])){
        $lib=$_POST['lib'];
    }
    if(isset($_POST['marq'])){
        echo"enfin";
        Enregistrer_marque();
    }
    if(isset($_POST['cat'])){
        Enregistrer_categorie();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        supprimer_produit($id);
    }
    
    include("../html/acc_produit.html");
?>
