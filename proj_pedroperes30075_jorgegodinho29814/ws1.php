<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';


$namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws1.php";
$server = new nusoap_server();


$server->configureWSDL('ws1wsdl', 'urn:ws1wsdl');
$server->wsdl->schemaTargetNamespace = $namespace;


$server->register(
        'registerStudent', // method name
        array('uname' => 'xsd:string', // input parameters
    'email' => 'xsd:string', // input parameters
    'gender' => 'xsd:string', // input parameters
    'upass' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#ws1', // soapaction
        'rpc', // style
        'encoded', // use
        'Faz o registo de um estudante'                        // documentation
);

$server->register(
        'registerInstructor', // method name
        array('uname' => 'xsd:string', // input parameters
    'email' => 'xsd:string', // input parameters
    'gender' => 'xsd:string', // input parameters
    'upass' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#ws1', // soapaction
        'rpc', // style
        'encoded', // use
        'Faz o registo de um docente'                        // documentation
);

$server->register(
        'registerAdmin', // method name
        array('uname' => 'xsd:string', // input parameters
    'email' => 'xsd:string', // input parameters
    'upass' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#ws1', // soapaction
        'rpc', // style
        'encoded', // use
        'Faz o registo de um admin'                        // documentation
);

function registerStudent($uname, $email, $gender, $upass) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

    $query = "INSERT INTO student(name,email,password, gender) VALUES('$uname','$email','$hashed_password', '$gender')";

    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function registerInstructor($uname, $email, $gender, $upass) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // So funciona em PHP 5.5 ou mais recente, portanto usei uma lib que me permite usar esta função
    $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

    $query = "INSERT INTO instructor(name,email,password, gender) VALUES('$uname','$email','$hashed_password', '$gender')";

    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function registerAdmin($uname, $email, $upass) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // So funciona em PHP 5.5 ou mais recente, portanto usei uma lib que me permite usar esta função
    $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

    $query = "INSERT INTO admin(name,email,password) VALUES('$uname','$email','$hashed_password')";

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