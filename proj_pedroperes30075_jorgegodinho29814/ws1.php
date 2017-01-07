<?php
session_start();
require 'lib/nusoap.php';
require 'dbconnect.php';

function registerStudent($uname, $email, $gender, $upass) {
    require 'dbconnect.php';
    $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

    $check_email = $DBcon->query("SELECT email FROM student WHERE email='$email'");
    $count = $check_email->num_rows;

    if ($count == 0) {

        $query = "INSERT INTO student(name,email,password, gender) VALUES('$uname','$email','$hashed_password', '$gender')";

        if ($DBcon->query($query)) {
            $msg = "Registo feito com sucesso!";
            return $msg;
        } else {
            $msg = "Erro ao registar!";
            return $msg;
        }
    } else {
        $msg = "Email já está registado.";
        return $msg;
    }

    $DBcon->close();
}

$namespace = "http://127.0.0.1/engsw/proj_pedroperes30075_jorgegodinho29814/ws1.php";
$server = new nusoap_server();
$server->configureWSDL('ws1wsdl', 'urn:ws1wsdl');
$server->wsdl->schemaTargetNamespace = $namespace;
$server->wsdl->addComplexType(
        'query', 'complexType', 'array', 'sequence', '', array('result' => array('name' => 'result', 'type' => 'xsd:string'))
);

$server->register(
        'registerStudent', // method name
        array('uname' => 'xsd:string', // input parameters
    'email' => 'xsd:string', // input parameters
    'gender' => 'xsd:string', // input parameters
    'upass' => 'xsd:string'), // input parameters
        array('result' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#registar', // soapaction
        'rpc', // style
        'encoded', // use
        'Faz o registo de um estudante'                        // documentation
);

$server->service($GLOBALS['HTTP_RAW_POST_DATA']);
?>