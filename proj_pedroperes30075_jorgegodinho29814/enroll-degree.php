<?php
session_start();
require 'lib/nusoap.php';
// Incluir dbconnect.php que é onde é feita a ligação com a DB
include_once 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

// Serve para depois usar o nome de utilizador
$query = $DBcon->query("SELECT * FROM student WHERE id=" . $_SESSION['userSession']);
$userRow = $query->fetch_array();

$query1 = $DBcon->query("SELECT name FROM degree");

if (isset($_POST["atualizar"])) {
    $client = new nusoap_client("http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws3.php");
    $client->soap_defencoding = 'UTF-8';
    
    $name = $_POST['name'];
    $student_id = $_SESSION['userSession'];
    
    $query2 = $DBcon->query("SELECT * FROM degree WHERE name='$name'");
    $userRow1 = $query2->fetch_array();
    
    $result = $client->call('enrollDegree', array('student_id' => $student_id, 'degree_id' => $userRow1['id']));

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
            <h1>Inscrição a Curso</h1>

            <form action="enroll-degree.php" method="post">
                Curso:
                <select name="name">
                    <?php while ($row = $query1->fetch_assoc()) { ?>
                        <option value="<?php echo $row['name']; ?>"> <?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>
                <br>
                <br>
                <input type="submit" name="atualizar" value="Atualizar">
            </form>
            
            <?php
            // Display the request and response
            echo '<h2>Request</h2>';
            echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
            echo '<h2>Response</h2>';
            echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
            // Display the debug messages
            echo '<h2>Debug</h2>';
            echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
            ?>
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
