<?php
  function recuper_utilisateur($email){
    try{
        include("../php/connexion_bd.php");
        global $d,$a,$b,$c,$e;
        $sql="SELECT * FROM utilisateurs WHERE email_util=:email";
        $sql=$db->prepare($sql);
        $sql -> bindvalue(':email',$email);
        $sql->execute();
        if($sql->rowcount()>0){
            while($donnees=$sql->fetch(PDO::FETCH_ASSOC)) {
                $a=$donnees['Nom_util'];
                $b=$donnees['Prenom_util'];
                $c=$donnees['url_photo'];
                $d=$donnees['Pwd_util'];
                $e=$donnees['email_util'];
            }
            $sql->closecursor();
        } 
    }catch(Exception $e){
        die('Erreur:'.$e->getmessage());
    }
}
  ?>


<?php
    $mot_de_passe="";
    $email="";
    if(isset($_POST['email'])){
        $email=$_POST['email'];
    }
    if(isset($_POST['mot_de_passe'])){
        $key = "Super_Amind.Key";
        $mot_de_passe= encrypt($_POST['mot_de_passe'], $key);
    }
    if(isset($_POST['connecter'])){
        recuper_utilisateur($email);
        if($d==$mot_de_passe){
            echo"<script>alert(<h3><font color=blue>bien venune ".$a."</font></h3>);</scritp>";
                session_start();
                $_SESSION['nom']=$a;
                $_SESSION['prenom']=$b;
                $_SESSION['email']=$e;
                $_SESSION['photo']=$c;
                $_SESSION['nat']="0";
                $_SESSION['role']="ADMIN";
            header('location:../php/acc_produit.php');
        }else{
            echo'echec d autentification';
        }
    }
    include '../html/connexion.html';
?>