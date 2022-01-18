<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Ingeniux: Sign up</title>
    <meta name="description" content="Brand new Crypto">
    <style>
         body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        
        @import url('https://fonts.googleapis.com/css2?family=Yuji+Boku&display=swap');
    </style>
    <link href="static/_css/Main.css" rel="stylesheet">
</head>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Welcome: Ingenuix</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        
        @import url('https://fonts.googleapis.com/css2?family=Yuji+Boku&display=swap');
    </style>
    <link href="static/_css/Main.css" rel="stylesheet">
    <link href="static/_css/welcome.css" rel="stylesheet">
</head>
<body>
    <div style="background-color: white;">
    <h1 class="my-5">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido</h1>
    </div>

    <p>
        <a href="index.php" class="btn btn-dark ml-4" style = "background-color:#38d7fd !important;"> Inicio</a>
        <a href="reset-password.php" class="btn btn-warning">Cambia tu contrasena</a>
        <a href="logout.php" class="btn btn-danger ml-3" style = "background-color:#fb36f4 !important;">Logout</a>
        <a href="#form-investments" class="btn btn-dark ml-3"> Invierte en nuestro Proyecto!</a>
    </p>
    <section class ="welcome">
        <div class="box-welcome">
            <div class ="inner-div">
            <h3>
                Te agradecemos que seas parte de este cambio.
            </h3>
            </div>
            
            <div class="inner-div-2">
                <h5>
                    Gracias a ti, la economía decentralizada será un hecho apoyándonos en este y futuros proyectos!
                </h5>
            </div>
            <div>
            <p>
            Ingenuix Coin tiene como objetivo cambiar el futuro de la economía digital.
            <br>
            Ingenuix Coin es la primera plataforma que permite a los usuarios diseñar, crear y administrar fácilmente tokens personales, corporativos, NFT y DeFi.
            </p>
            </div>
        </div>
    </section>
    <section class ="message-preinvestment">
    <div class ="inner-message-invest">
        <span>
        <h2>
            Estás a 2 pasos de ser parte de la <br>
            comunidad más grande en Crypto!
        </h2>
        </span>
        
    </div>
    </section>
    <section class ="form-investments">
        <form class ="box"action="">
            <h3>Invierte ya mismo!</h3>    
            <input type="number" name  = "quantity" placeholder ="Cantidad de Tokens a comprar" class="form-control" value="" >
            <label for="">Cantidad</label>
            <input type="password" name="password"  placeholder ="Password" class="form-control ">
            <label for="">Contrasena</label>
            <input type="submit" value = "Comprar Tokens">
        </form>
    </section>

    <section class="mobile-app">
        <div>
            <h3>
                Obtén nuestra aplicacion para móvil
            </h3>
            <p>
                130.000 descargas y subiendo
            </p>
            <div class="grid-container">
                <div class="grid-item">
                    <img src="static/googleplaystore.png" alt="">
                </div>
                <div class="grid-item">
                    <img src="static/applestore.png" alt="">
                </div>
            </div>
        </div>
    </section>

</body>
</html>