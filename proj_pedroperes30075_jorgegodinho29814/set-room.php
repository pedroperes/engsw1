<?php
session_start();
require 'lib/nusoap.php';
require_once 'dbconnect.php';
// Libraria que me permite usar a função password_verify/hash em versões anteriores a PHP 5.5
require 'password_compat-master/lib/password.php';

if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

if (isset($_POST['btn-signup'])) {
    $selectRoom = $_POST['selectRoom'];
    $selectInstructor = $_POST['selectInstructor'];
    $selectCourse = $_POST['selectCourse'];
    $day = $_POST['day'];
    $start_hour = $_POST['start_hour'];
    $duration = $_POST['duration'];
    
    $query = $DBcon->query("SELECT id FROM instructor WHERE name='$selectInstructor'");
    $selectInstructor = $query->fetch_array();
    
    $query = $DBcon->query("SELECT id FROM room WHERE number='$selectRoom'");
    $selectRoom = $query->fetch_array();
    
    $query = $DBcon->query("SELECT id FROM course WHERE title='$selectCourse'");
    $selectCourse = $query->fetch_array();

    $client = new nusoap_client("http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws1.php");
    $client->soap_defencoding = 'UTF-8';

    $result = $client->call('setRoom', array('selectRoom' => $selectRoom['id'], 
        'selectInstructor' => $selectInstructor['id'], 
        'selectCourse' => $selectCourse['id'], 
        'day' => $day, 
        'start_hour' => $start_hour,
        'duration' => $duration));

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
        <title>Definir Sala</title>
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
            <form class="form-signin" method="post" id="register-form">
                <h2 class="form-signin-heading">Definir sala</h2><hr />
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <label for="selectUser">Selecionar Sala: </label>
                <select class="form-control" id="selectDegree" name="selectRoom">
                    <?php
                    $sql = "SELECT number FROM room";
                    $result = $DBcon->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["number"]; ?>"><?php echo $row["number"]; ?></option>
                            <?php
                        }

                        echo $row["name"];
                    }
                    ?> 
                </select>

                <label for="selectUser">Selecionar Docente: </label>
                <select class="form-control" id="selectDegree" name="selectInstructor">
                    <?php
                    $sql = "SELECT name FROM instructor";
                    $result = $DBcon->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
                            <?php
                        }

                        echo $row["name"];
                    }
                    ?> 
                </select>

                <label for="selectUser">Selecionar Disciplina: </label>
                <select class="form-control" id="selectDegree" name="selectCourse">
                    <?php
                    $sql = "SELECT title FROM course";
                    $result = $DBcon->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["title"]; ?>"><?php echo $row["title"]; ?></option>
                            <?php
                        }

                        echo $row["name"];
                    }

                    $DBcon->close();
                    ?> 
                </select>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Dia" name="day" required  />
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Hora começo" name="start_hour" required  />
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Duraçao" name="duration" required  />
                </div>

                <hr />
                <div class="form-group">
                    <button type="submit" class="btn btn-default" name="btn-signup">
                        <span class="glyphicon glyphicon-log-in"></span> &nbsp; Adicionar
                    </button> 
                </div> 
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