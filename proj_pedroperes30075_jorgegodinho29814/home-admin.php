<?php
session_start();
// Incluir dbconnect.php que é onde é feita a ligação com a DB
include_once 'dbconnect.php';
// libraria do phpmailer que serve para enviar emails
require("PHPMailer-master/PHPMailerAutoload.php");

if (!isset($_SESSION['userSession'])) {
    header("Location: login-admin.php");
}

// Serve para depois usar o nome de utilizador
$query = $DBcon->query("SELECT * FROM admin WHERE id=" . $_SESSION['userSession']);
$userRow = $query->fetch_array();
$DBcon->close();
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

        <title>Painél de <?php echo $userRow['name']; ?></title>

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
            <h1>Menu</h1>
            <div class="list-group">
                <a class="list-group-item" href="register-student.php">Registar aluno</a>
                <a class="list-group-item" href="register-docente.php">Registar docente</a>
                <a class="list-group-item" href="register-admin.php">Registar administrativo</a>
                <a class="list-group-item" href="create-degree.php">Criar curso</a>
                <a class="list-group-item" href="add-instructor-course.php">Associar docentes a unidades curriculares</a>
                <a class="list-group-item" href="list-students.php">Obter lista de alunos inscritos</a> 
                <a class="list-group-item" href="">Criar horário para unidade curricular</a>
                <a class="list-group-item" href="set-room.php">Definir sala para unidade curricular</a>
                <a class="list-group-item" href="">Consultar a lista de notas de um aluno</a>
                <a class="list-group-item" href="list-free-room.php">Obter a lista de todas as salas livres num determinado periodo de tempo</a>
            </div>
        </div>
        <div class="col-sm-4"><li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li></div>

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