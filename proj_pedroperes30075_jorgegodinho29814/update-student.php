<?php
session_start();
// Incluir dbconnect.php que é onde é feita a ligação com a DB
include_once 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

// Serve para depois usar o nome de utilizador
$query = $DBcon->query("SELECT * FROM student WHERE id=" . $_SESSION['userSession']);
$userRow = $query->fetch_array();


if (isset($_POST["atualizar"])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];


    $sql = "UPDATE student SET name='$nome', gender='$gender', email='$email' WHERE id=" . $_SESSION['userSession'];

    if ($DBcon->query($sql) === TRUE) {
        
    } else {
        echo "Erro: " . $DBcon->error;
    }
}

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
            <h1>Atualizar dados</h1>

            <form action="update-student.php" method="post">
                Nome:<br><input type="text" name="nome" value=""><br>
                Endereço Email:<br><input type="email" name="email" value=""><br>
                Gender:<br>
                <select name="gender">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
                <br>
                <br>
                <br>
                <input type="submit" name="atualizar" value="Atualizar">
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

