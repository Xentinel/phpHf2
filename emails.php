<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Email added.</title>

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
            <h1>Tus clientes. </h1>
            <p>
                Selecciona algunos clientes para eliminarlos de tu lista. Ten cuidado,
                esta acción no se puede deshacer.
            </p>
                <?php

                //select all clientes from the database
                $dbc = mysqli_connect('localhost','root','andrea','elvisStore') or die('Error conecting.');

                $query = "SELECT * FROM emailList";

                $result = mysqli_query($dbc,$query) or die('Error insertando en la bd');
                
                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post" role="form">';
                echo '<div class="form-group">';

                 while($row = mysqli_fetch_array($result))
                {
                    
                    echo '<input type="checkbox" value ="'.$row['id'].'" name = "toDelete[]"/>';
                    echo ' '.$row['firstName'].' '.$row['lastName'].': '.$row['email'].'<br>';
                }
                echo '<br><button type="submit" name="submit" value="submit" class="btn btn-primary">Borrar</button>';
                echo '</div>';                
                
                mysqli_close($dbc);
                ?>
        </div>
        
            <?php 
            if(isset($_POST['submit']))
            {
                echo '<div class = "jumbotron">';
                $dbc = mysqli_connect('localhost','root','andrea','elvisStore') or die ('Error Connecting.');
                echo '<h2>Deleted elements.</h2> <p>';
                foreach ($_POST['toDelete'] as $deleteId)
                {
                    //first of all displaying all the elements to delete before doing it.
                    $query = 'SELECT * FROM emailList WHERE id = "'.$deleteId.'"';
                    $result = mysqli_query($dbc,$query) or die ('Error querying the database');
                    $row = mysqli_fetch_array($result);
                    echo ' '.$row['firstName'].' '.$row['lastName'].': '.$row['email'].'<br>';
                    
                    //deleting the elements.
                    $query = 'DELETE FROM emailList WHERE id="'.$deleteId.'"';
                    $result = mysqli_query($dbc,$query) or die ('Error Deleting');
                }
                echo '</p><a href="/emails.php" class="btn-lg btn-success">Ok!</a>';
                echo '</div>';
            }
            ?>
        

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </body>
</html>
