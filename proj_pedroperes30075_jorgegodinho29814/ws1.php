<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';

// WEB SERVICE ADMIN //

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
        'urn:ws1wsdl#wregisterstudent', // soapaction
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
        'urn:ws1wsdl#registerinstructor', // soapaction
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
        'urn:ws1wsdl#registeradmin', // soapaction
        'rpc', // style
        'encoded', // use
        'Faz o registo de um admin'                        // documentation
);

$server->register(
        'createDegree', // method name
        array('name' => 'xsd:string', // input parameters
    'code' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#createdegree', // soapaction
        'rpc', // style
        'encoded', // use
        'Criar curso'                        // documentation
);

$server->register(
        'addInstructorCourse', // method name
        array('instructor_id' => 'xsd:string', // input parameters
    'course_id' => 'xsd:string', // input parameters
    'section_id' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#addinstructorcourse', // soapaction
        'rpc', // style
        'encoded', // use
        'Adicionar docente a disciplina'                        // documentation
);

$server->register(
        'setRoom', // method name
        array('selectRoom' => 'xsd:string', // input parameters
    'selectInstructor' => 'xsd:string', // input parameters
    'selectCourse' => 'xsd:string', // input parameters
    'day' => 'xsd:string', // input parameters
    'start_hour' => 'xsd:string', // input parameters
    'duration' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#setroom', // soapaction
        'rpc', // style
        'encoded', // use
        'Definir sala'                        // documentation
);

$server->register(
        'listStudents', // method name
        array('name' => 'xsd:string', // input parameters
    'code' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws1wsdl', // namespace
        'urn:ws1wsdl#liststudent', // soapaction
        'rpc', // style
        'encoded', // use
        'Listar estudantes'                        // documentation
);

// ------------------------------------------------------------------------- //

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

function createDegree($name, $code) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO degree(name,code) VALUES('$name','$code')";

    if (mysqli_query($conn, $query)) {
        $msg = "Disciplina criada com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function addInstructorCourse($instructor_id, $course_id, $section_id) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO teaches(instructor_id,course_id,section_id) VALUES ('" . $instructor_id . "','" . $course_id . "','" . $section_id . "')";

    if (mysqli_query($conn, $query)) {
        $msg = "Registado com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function listStudents($name, $code) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM student";
    $result = mysqli_query($conn, $query);
    $array = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    mysqli_close($conn);

    return $array;
}

function setRoom($selectRoom, $selectInstructor, $selectCourse, $day, $start_hour, $duration) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO class(course_id,room_id,instructor_id,day,start_hour, duration) VALUES "
            . "('" . $selectCourse . "','" . $selectRoom . "','" . $selectInstructor . "','" . $day . "','" . $start_hour . "','" . $duration ."')";

    if (mysqli_query($conn, $query)) {
        $msg = "Registado com sucesso!";
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