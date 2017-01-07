<?php
session_start();

require_once 'dbconnect.php';
// Libraria que me permite usar a função password_verify/hash em versões anteriores a PHP 5.5
require 'password_compat-master/lib/password.php';

if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

if (isset($_POST['btn-signup'])) {
    $selectDegree = $_POST['selectDegree'];
    $title = $_POST['title'];
    $ects = $_POST['ects'];
    $description = $_POST['description'];


    $query = $DBcon->query("SELECT id FROM degree WHERE name='$selectDegree'");
    $userRow = $query->fetch_array();

    $query1 = "INSERT INTO course (title, ects, degree_id, description) VALUES ('$title'," . $ects . "," .  $userRow['id'] . ", '$description')";
    header("Refresh:2");
    if ($DBcon->query($query1)) {
        $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Adicionado com sucesso!
					</div>";
    } else {
        $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Erro ao adicionar!
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
        <meta name="Pedro Peres" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Registar</title>
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
                <h2 class="form-signin-heading">Criar disciplina</h2><hr />
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Title" name="title" required  />
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Ects" name="ects" required  />
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Description" name="description" required  />
                </div>
                
                <label for="selectUser">Selecionar Degree: </label>
                    <select class="form-control" id="selectDegree" name="selectDegree">
                        <?php
                        $sql = "SELECT * FROM degree";
                        $result = $DBcon->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
                                <?php
                            }

                            echo $row["name"];
                        }

                        $DBcon->close();
                        ?> 
                    </select>

                <hr />
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