<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$credit_card_number = $credit_card_day = $credit_card_month = $credit_card_cvv ="";
$credit_card_number_err = $credit_card_day_err = $credit_card_month_err = $credit_card_cvv_err ="";

$amount = "";
$amount_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    // collect value of input field
    if(empty(trim($_POST["amount"]))){
        $amount_err = "Por favor ingresa una cantidad.";
    }
    else {
        $amount = trim($_POST["amount"]);
    }

    if(empty(trim($_POST["credit_card_number"]))){
        $credit_card_number_err  = "Please enter CC Number.";
    } 
    else{
        $credit_card_number= trim($_POST["credit_card_number"]);
    }
    //Check if Month or Date are empty
    if(empty(trim($_POST["credit_card_month"]))){
        $credit_card_month_err = "Please enter CC Month.";
    } 
    else{
        $credit_card_day = trim($_POST["credit_card_month"]);
    }

    if(empty(trim($_POST["credit_card_day"]))){
        $credit_card_day_err = "Please enter CC Year.";
    } 
    else {
        $credit_card_month = trim($_POST["credit_card_day"]);
    }

    if(empty(trim($_POST["credit_card_cvv"]))){
        $credit_card_cvv_err = "Please Your CVV.";
    }
    else{
        $credit_card_cvv = trim($_POST["credit_card_cvv"]);
    }
    

    if (empty($credit_card_cvv_err) && empty($credit_card_day_err) && empty( $credit_card_month_err) && empty($credit_card_number_err)){
        $sql ="INSERT INTO credit_card_user (credit_card_number,credit_card_month, credit_card_day , credit_card_cvv, date_added, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $sql_2 = "INSERT INTO investments_user (amount, date, user_id, payment_method) VALUES (?, ?, ?, ?)";
        if($stmt = mysqli_prepare($connection, $sql)){
            $timezone = date_default_timezone_get();
            mysqli_stmt_bind_param($stmt ,"iiiibi", $credit_card_number, $credit_card_month, $credit_card_day, $credit_card_cvv, $timezone, $_SESSION['id']);
        
            if(mysqli_stmt_execute($stmt)){
                //Redirect to thank you page.
                header("location: thankyou.php");
                echo "Success";
            }else{
                echo "Oops algo ha salido mal. Intentalo de nuevo más tarde.";
            }
            //Close Statement
            mysqli_stmt_close($stmt);
        }
    }

mysqli_close($connection);
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
    <link rel="stylesheet" href="static/_css/footer.css">
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
    <h1 class="h1-binvenido">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido</h1>
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
                <div style ="background-color:white;">
                    <h6 style ="font-size:2rem;">
                        Proyectos Actuales
                    </h6>
                </div>
                <button class ="btn btn-lg" style="background-color:black;"> <a href="Cardano.php" style ="text-decoration:none; color:white;"> Cardano </a></button>
                <button class ="btn btn-lg" style="background-color:black;"> <a href="LaraCoin.php" style ="text-decoration:none; color:white;"> Lara Coin</a></button>
                <button class ="btn btn-lg" style="background-color:black;"> <a href="XClone.php" style ="text-decoration:none; color:white;">XClone</a></button>
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
        <div class="box">
            <div class ="inner-message-invest">
                <span>
                <h2>
                    Estás a 2 pasos de ser parte de la <br>
                    comunidad más grande en Crypto!
                </h2>
                </span>
                
            </div>
    </div>
    </section>
    <section class="tokens-calculator">

        <div class="box" style ="color:white;">
        <h2>
            <italic> <strong> Ingenuix en números: </italic> </strong>
            
        </h2>   
        <br> 
        <h4>
                Cantidad de Tokens Total: <strong>43M</strong>
            </h4>
            <br>
            <h4>
                Cantidad de Tokens en Circulacion: <strong>13M</strong> 
            </h4>
            
            <br>

            <h4 class="price-token">
                Precio Actual Token: <strong>1 ING = 2,33 USD</strong> 
            </h4>
        </div>



    </section>


    <section class ="form-investments">
        <form class ="box"action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Invierte ya mismo!</h3>
           
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" style ="color:white;"> Ingresa el monto</label>
                                <input class="form-control" id="name" type="text" placeholder="3000 USD">
                            </div>
                        </div>
                    </div>
                    <div class="card-header"  style  ="color:white;">
                    <strong>Credit Card</strong>
                    <br>
                    <small>Ingresa tus datos de tarjeta</small>
            </div> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" style = "color:white;">Name</label>
                                <input class="form-control " id="name" type="text" placeholder="Enter your name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="ccnumber"  style ="color:white;">Credit Card Number</label>
                                <div class="input-group">
                                    <input class="form-control  <?php echo (!empty($credit_card_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $credit_card_number; ?>" type="text" placeholder="0000 0000 0000 0000" autocomplete="email" name ="credit_card_number">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ccmonth"  style  ="color:white;">Month</label>
                            <select class="form-control  <?php echo (!empty($credit_card_month_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $credit_card_month; ?>" id="ccmonth" name = "credit_card_month">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="ccyear" style  ="color:white;">Year</label>
                            <select class="form-control  <?php echo (!empty($credit_card_day_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $credit_card_day; ?>" id="ccyear" name = "credit_card_day">
                                <option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cvv"  style  ="color:white;">CVV/CVC</label>
                                <input class="form-control  <?php echo (!empty($credit_card_cvv_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $credit_card_cvv; ?>" id="cvv" type="text" placeholder="123" name ="credit_card_cvv">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                
                    <input type="submit" value="Comprar">
                    <button class="btn btn-sm" style="background-color:#a0a0a0;color:black;" type="reset">
                        <i class="mdi mdi-lock-reset"></i> Reset</button>
                </div>
            </div>
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

    <footer>
    <div class = "footer-container">
        <div class="footer">
            <div class ="footer-heading footer-1">
                <h2>
                    Sobre Nosotros
                </h2>
                <a href="">Blog</a>
                <a href="">Demo</a>
                <a href="">Customers</a>
                <a href="">Investors</a>
            </div>
        
            <div class ="footer-heading footer-2">
                <h2>
                    Contact Us
                </h2>
                <a href="">Jobs</a>
                <a href="">Contact</a>
                <a href="">Join Us</a>
                <a href="">Support</a>
                <a href="">Sponsorship</a>
            </div>
            <div class ="footer-heading footer-3">
                <h2> 
                    Social media
                </h2>
                <a href="">Instagram</a>
                <a href="">Twitter</a>
                <a href="">Facebook</a>
                <a href="">LinkedIn</a>
            </div>
    </div>



</footer>

</body>
</html>