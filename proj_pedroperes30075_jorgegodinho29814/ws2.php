<?php
session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';
// WEB SERVICE ALUNO //
$namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws2.php";
$server = new nusoap_server();
$server->configureWSDL('ws2wsdl', 'urn:ws2wsdl');
$server->wsdl->schemaTargetNamespace = $namespace;
//LANCAR NOTAS EM BAIXO
$server->register(
//AQUI
);
$server->register(
        'updateInstructor', // method name
        array('nome' => 'xsd:string', // input parameters
    'gender' => 'xsd:string',
    'email' => 'xsd:string',
    'id' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws3wsdl', // namespace
        'urn:ws3wsdl#updateStudent', // soapaction
        'rpc', // style
        'encoded', // use
        'Atualizar instructor'                        // documentation
);
// ------------------------------------------------------------------------- //
//LANCAR NOTAS EM BAIXO
function lancarnotas($student_id, $course_id) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

//QUERY AQUI

    mysqli_close($conn);
}
function updateInstructor($nome, $gender, $email, $id) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "UPDATE student SET name='$nome', gender='$gender', email='$email' WHERE id=" . $id;
    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }
    mysqli_close($conn);
}
// Use the request to (try to) invoke the service -  XAMMP !!!!
if (!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);
?>
