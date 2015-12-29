<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add a costumer's email.</title>

        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body class="container">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/addEmail.html">Elvis Store!</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/addEmail.html">Agregar email </a></li>
                        <li><a href="/sendEmail.php">Enviar email!</a></li>
                        <li><a href="/emails.php">Borrar email</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <div class="jumbotron">
        <?php
        $outputForm = false;
            if (!empty($_POST['subject']) and !empty($_POST['body'])) {
                $emailSubject = $_POST['subject'];
                $body=$_POST['body'];
                $from = "julizsxd@gmail.com";
                //db connection
                $dbc = mysqli_connect('localhost','root','andrea','elvisStore') or die('Error connecting to database.');

                //making the query
                $query ="SELECT * FROM emailList";

                //executing the query

                $result = mysqli_query($dbc,$query) or die('error making the query');
                
                

                echo "<h1>Send them!</h1>";
                echo "<p>Now you can relax and make you a coffe!</p>";
                echo '<a href="/sendEmail.php" class="btn-lg btn-success">Ok!</a>';
                echo "<br><br>";
                //looping through the result
                while($row = mysqli_fetch_array($result))
                {
                    echo $row['firstName'].' '.$row['lastName'].' '.$row['email'].'<br>';
                }
                mysqli_close($dbc);

            }
            if(empty($_POST['subject']) and isset($_POST['submit']))
            {
                echo "olvidaste el asunto. <br>";
                $outputForm = true;
            }
            if (empty($_POST['body']) and isset($_POST['submit'])) {
                echo "olvidaste el cuerpo del mensaje<br>";
                $outputForm = true;
            }
            if (!isset($_POST['submit'])) {
                $outputForm = true;
            }
            ?>
            <?php 
            if ($outputForm) {
            ?>
            <h1>Send the emails to all your costumers!</h1>
            <p>Here you can create the email and send it.</p>
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="subject">Subject </label>
                    <input type="text" name="subject" class="form-control" placeholder="Insert email's subject.">
                </div>
                <div class="form-group">
                    <label for="body">Body </label>
                    <textarea class="form-control" name="body" rows="7" placeholder="Insert your message."></textarea>
                </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary">enviar!</button>
            </form>
            
            <?php
             }
             ?>

        </div>           

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </body>
</html>
