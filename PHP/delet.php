<?php
    $id = $_GET['id'];
    try{
        include("connexion_bd.php");
        $sql="DELETE FROM produit WHERE Id_pro=$id";
        unset($id);
        header('location:acc_produit.php');
    }catch(Exception $e){
        die('Erreur:'.$e->getMessage());
    }
?>