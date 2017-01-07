<?php
session_start();

require_once 'dbconnect.php';
// Libraria que me permite usar a função password_verify/hash em versões anteriores a PHP 5.5
require 'password_compat-master/lib/password.php';

if (isset($_SESSION['userSession']) != "") {
    //header("Location: home.php");
}

if (isset($_POST['btn-signup'])) {
    // Tirar tags de HTML e PHP da string
    $name = strip_tags($_POST['name']);
    $code = strip_tags($_POST['code']);

    // Tirar caracteres especiais usados em SQL
    $name = $DBcon->real_escape_string($name);
    $code = $DBcon->real_escape_string($code);

    $query = "INSERT INTO degree(name,code) VALUES('$name','$code')";

    if ($DBcon->query($query)) {
        $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Disciplina criada com sucesso!
					</div>";
    } else {
        $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Erro ao registar!
					</div>";
    }

    $DBcon->close();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="Projeto" content="">
        <meta name="Pedro Peres, Jorge Godinho" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Criar disciplina</title>
        <!-- Bootstrap core CSS -->
        <link href="../bootstrap-3.3.7/docs/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../bootstrap-3.3.7/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../bootstrap-3.3.7/docs/assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form class="form-signin" action="create-degree.php" method="post" id="register-form">
                <h2 class="form-signin-heading">Criar disciplina</h2><hr />
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" required  />
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Code" name="code" required  />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default" name="btn-signup">
                        <span class="glyphicon glyphicon-log-in"></span> &nbsp; Adicionar
                    </button> 
                </div> 
            </form>
        </div>
        <div class="col-sm-4"></div>

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../bootstrap-3.3.7/docs/dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../bootstrap-3.3.7/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>