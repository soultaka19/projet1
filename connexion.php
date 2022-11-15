<?php
    session_start();
    @$login=$_POST["login"];
    @$pass=$_POST["pass"];
    @$save=$_POST["save"];
    $message="";
    if(isset($save)){
        include("../include/dataBase.php");
		$sel=$connexion->prepare("select * from users where login=? and pass=? limit 1");
		$sel->execute(array($login,$pass));
		$tab=$sel->fetchAll();
		if(count($tab)>0){
			$_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
			" ".strtoupper($tab[0]["nom"]);
			$_SESSION["autoriser"]="oui";
			header("location:../index.php");
		}
        else{
			$message="Mauvais login ou mot de passe!";
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
    <title>connexion</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 offset-md-3 p-5">
                    <h2 class="m-3 text-center">connexion</h2>
                    <div class="">
                        <label for="exampleFormControlInput1" class="form-label">login:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"  name="login">
                    </div>
                    <div class="">
                        <label for="exampleFormControlInput1" class="form-label">password:</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1"  name="pass">
                    </div>
                    <input type="submit" value="se connecter" name="save" class="btn btn-primary w-50 mt-3 mx-5" >
                    <div class="text-right ">
						vous n'avez pas de compte?
						<a href="inscription.php">
							s'inscrire
						</a>
					</div>
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
