<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';

// WEB SERVICE ALUNO //

$namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws3.php";
$server = new nusoap_server();


$server->configureWSDL('ws3wsdl', 'urn:ws3wsdl');
$server->wsdl->schemaTargetNamespace = $namespace;


$server->register(
        'enrollDegree', // method name
        array('student_id' => 'xsd:string', // input parameters
    'degree_id' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws3wsdl', // namespace
        'urn:ws3wsdl#enrollDegree', // soapaction
        'rpc', // style
        'encoded', // use
        'Inscriçao em curso'                        // documentation
);

$server->register(
        'enrollCourse', // method name
        array('student_id' => 'xsd:string', // input parameters
    'course_id' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws3wsdl', // namespace
        'urn:ws3wsdl#enrollCourse', // soapaction
        'rpc', // style
        'encoded', // use
        'Inscriçao em disciplina'                        // documentation
);

$server->register(
        'updateStudent', // method name
        array('nome' => 'xsd:string', // input parameters
    'gender' => 'xsd:string',
    'email' => 'xsd:string',
    'id' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws3wsdl', // namespace
        'urn:ws3wsdl#updateStudent', // soapaction
        'rpc', // style
        'encoded', // use
        'Atualizar aluno'                        // documentation
);

// ------------------------------------------------------------------------- //

function enrollDegree($student_id, $degree_id) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO student_degree (student_id, degree_id) VALUES (" . $student_id . ", " . $degree_id . ")";

    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function enrollCourse($student_id, $course_id) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO student_course (student_id, course_id) VALUES (" . $student_id . ", " . $course_id . ")";

    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function updateStudent($nome, $gender, $email, $id) {
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