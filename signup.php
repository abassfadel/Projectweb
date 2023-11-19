<?php

$filename = dirname(__FILE__) ."/users.json";

try{
    $file = file_get_contents($filename);
}catch(Exception $e){
    echo "<h1>Couldnt Get Accounts</h1>";
    echo "". $e->getMessage() ."";
}

$accounts = json_decode($file, true);

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$age   = $_POST["birthdate"];
$sex   = $_POST["sex"];
$username = $_POST["username"];
$password = $_POST["password"];

$userExists = false;



foreach ($accounts["accounts"] as $account) {
    if ($account["username"] == $username) {
        $userExists = true;
        break;
    }
}


if ($userExists) {
    echo "<html>
        <link rel='stylesheet' href='../style/common.css'>
    </html>";
    echo "<h1>User Already Exists </h1>";
    echo "<a href='../pages/signup.html'>Return to Sign Up</a>";
    exit();
} 

$newUser = array(
    "username"=> $username,
    "password"=> $password,
    "fname"=> ucwords($fname),
    "lname"=> ucwords($lname),
    "age"=> $age,
    "sex"=> $sex,
);

$accounts["accounts"][] = $newUser;

$updatedJson = json_encode($accounts, JSON_PRETTY_PRINT);
file_put_contents($filename, $updatedJson);
header("Location:../login.html");
?>


