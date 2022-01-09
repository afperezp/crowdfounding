<?php


// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingresa un usuario.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        
        $username_err = "Usuario solo puede contener letras, numero y rayita abajo.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este nombre de usuario ya ha sido usado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo ha ido mal. Por favor vuelve a intentarlo mas tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contrasena.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Contrasena debe tener al menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor ingresa un usuario.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contrasenas no han coincidido.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Algo ha sucedido, por favor intentalo mas tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
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
</head>

  
    

<!-- Codigo Propio -->




<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav">

    <header>
        <h1>Ingeniux</h1><br>
        <h5>Tu meme coin</h5>
    </header>
    <nav id="nav">
        <ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Sobre Nosotros</a>
            </li>
            <li>
                <a href="#">Donaciones</a>
            </li>
            <li>
                <a href="#">Contacto</a>
            </li>
        </ul>
    </nav>
  

    <div class="cards">
        <div class="card card1">
            <div class="container">
                <img src="images/business-5475660.jpg" alt="bussiness">
            </div>
            <div class="details">
                <h3>Negocio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.</p>
            </div>
        </div>
        <div class="card card2">
            <div class="container">
                <img src="images/bitcoin-3089728.jpg" alt="bitcoin">
            </div>
            <div class="details">
                <h3>Meme coin</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.</p>
            </div>
        </div>
        <div class="card card3">
            <div class="container">
                <img src="images/blockchain-3277336.png" alt="blockchain">
            </div>
            <div class="details">
                <h3>Blockchain</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.</p>
            </div>
        </div>
    </div>

    

    <section>

        <div class="container principal">
            <h1 class="el-meme"> El Meme coin para la Comunidad.<br> Hecho por la comunidad.</h1>
        </div>
        <div class="container px-4 py-5" id="featured-3">

            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
                    </div>
                    <h2>Cómo comprar Token?</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a href="#" class="icon-link">
                Adquiere tu token YA
                <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
              </a>
                </div>
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                    </div>
                    <h2>Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a href="#" class="icon-link">
                Empezar a comprar TOKENS
                <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
              </a>
                </div>
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
                    </div>
                    <h2>Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a href="#" class="icon-link">
                LOW GAS FEES!
                <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
              </a>
                </div>
            </div>
        </div>

        <div class="container">

            <h3>
                Ingenuix es una cadena de bloques descentralizada creada para permitir aplicaciones escalables y fáciles
                de usar para todo el mundo.
            </h3>
        </div>
    </section>


    <section class="iniciar-sesion">
      

        <form class="box" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
               
                <h2 class="iniciar-sesion-h2">
                    Ingresa YA para empezar a comprar TOKENS
                </h2>
                <input type="text" name  = "username" placeholder ="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                <label for="">Username</label>
            
                <input type="text" name  = "" placeholder ="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <label for="">Contrasena</label>
                <input type="submit" value = "Submit">
            <small>no tienes cuenta aún? <a href="#"> Registrate ya</a></small>
        </form>
        
    </section>
    <section class="ingenuix-numeros">
        <div class="grid-container">
            <h3>Ingenuix en numeros</h3>
        </div>
        <div class="grid-item">
            <h4>
                LOW FEES
            </h4>

        </div>
        <div class="grid-item">
            <h4>
                More People
            </h4>
        </div>
        <div class="grid-item">
            <h4>
                Scalability

            </h4>

        </div>
        <div class="grid-item">
            <h4>
                Security 4 everyone
            </h4>

        </div>
        <div class="grid-item">
            <h4>Forkless and Futured proof</h4>

        </div>


    </section>

</body>
<script src="static/_js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</html>