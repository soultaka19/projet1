<?php 
	session_start();
	@$nom=$_POST['nom'];
	@$prenom=$_POST['prenom'];
	@$login=$_POST['login'];
	@$pass=$_POST['pass'];
	@$rpass=$_POST['rpass'];
	@$save=$_POST['save'];
	$message='';

	if(isset($save)){
	if(empty($nom)) $message="<li>Nom ivalide</li>";
		if(empty($prenom)) $message="<li>prenom ivalide</li>";
		if(empty($login)) $message="<li>login ivalide</li>";
		if(empty($pass)) $message="<li>pass ivalide</li>";
		if($pass!=$rpass) $message="<li>le mot de pass doit etre identique</li>";
		if(empty($message)){
			include("../include/dataBase.php");
			$res=$connexion->prepare("select id from users where login=? limit 1");
			$res->setFetchMode(PDO::FETCH_ASSOC);
			$res->execute(array($login));
			$tab=$res->fetchAll();
			if(count($tab)>0){
				$message="<li>login existe deja</li>";
			}
			else{
				$ins="insert into users(id,date, nom,prenom,login,pass)
				values('',now(),'$nom','$prenom','$login','$pass')";
				$connexion->exec($ins);
				header("location:connexion.php");

			}
		}
	}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>inscription</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 offset-md-3 p-5">
                    <h2 class="m-3 text-center">inscription</h2>
                    <div class="m2-3">
                        <label for="exampleFormControlInput1" class="form-label">nom:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"  name="nom">
                    </div>
                    <div class="m2-3">
                        <label for="exampleFormControlInput1" class="form-label">prenom:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"  name="prenom">
                    </div>
                    <div class="m2-3">
                        <label for="exampleFormControlInput1" class="form-label">login:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"  name="login">
                    </div>
                    <div class="m2-3">
                        <label for="exampleFormControlInput1" class="form-label">password:</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1"  name="pass">
                    </div>
                    <div class="m2-3">
                        <label for="exampleFormControlInput1" class="form-label">confirmer le mot de pass:</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1"  name="rpass">
                    </div>
                    <input type="submit" value="s'inscrire" name="save" class="btn btn-primary w-50 mt-3 mx-5" >
                </div>
            </div>
        </form>
        <?php if(!empty($message)){?>
            <div id="message" class="alert alert-danger corner-radius "><?php echo $message?></div>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>