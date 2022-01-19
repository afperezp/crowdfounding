<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}


require_once "config.php";

$amount = "";
$amount_err ="";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["amount"]))){
        $amount_err = "Por favor ingresa una cantidad.";
    }
    else {
        $amount = trim($_POST["amount"]);
    }
    if (empty($amount_err)){
        $sql= "INSERT INTO investments_user (amount, date_added, user_id, payment_method) VALUES (?, ?, ?, ?)";
        if($stmt = mysqli_prepare($connection, $sql)){
            $timezone = date_default_timezone_get();
            $proyect_id =3;
            $payment_method = 2;
            mysqli_stmt_bind_param($stmt ,"ibiii",$amount, $timezone, $_SESSION['id'], $payment_method, $proyect_id);
        
            if(mysqli_stmt_execute($stmt)){
                
                //Redirect to thank you page.
                header("location: thankyou.php");
                echo "Success";
            }else{
                echo "Oops algo ha salido mal. Intentalo de nuevo más tarde.";
                echo mysqli_stmt_error($stmt);
               
            }
            //Close Statement
            mysqli_stmt_close($stmt);
        }
    }

mysqli_close($connection);
}

// Include config file


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href ="static/_css/footer.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cardano</title>
    <meta name="description" content="Brand new Crypto">
    <style>
         body{ font: 14px sans-serif;
                background-color:black !important; }
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
    <link href="static/_css/button.css" rel="stylesheet">
</head>
<body>


<section>
    <div style="width:100%;color:white!important; ">
        <h2 style ="font-size:4rem;">
            XClone
        </h2>
    </div>
    <div class ="box">
        <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <input type="text"   class="form-control  <?php echo (!empty($amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $amount; ?>" type="text" placeholder="$10,000" autocomplete="email" name ="amount">
           <label style ="color:white;"for="">Ingresa tu Cantidad</label>
           <input type="submit" value="Invertir">
        </form>
    </div >
</section>

<button class ="btn-volver-proyect">
    <a href="welcome.php">Volver</a>
    
</button>


    
</body>
</html>