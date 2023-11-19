<?php
session_start(); 

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$filename = dirname(__FILE__) . "/users.json";

try {
    $file = file_get_contents($filename);
} catch (Exception $e) {
    echo "<h1>Couldn't Get Accounts</h1>";
    echo "" . $e->getMessage() . "";
    exit();
}

$accounts = json_decode($file, true);

$authenticated = false;
foreach ($accounts["accounts"] as $account) {
    if ($account["username"] == $username && $account["password"] == $password) {
        $authenticated = true;

        $_SESSION['user'] = $account;
        break;
    }
}


if ($authenticated) {
    header("Location: contact.html");
    exit();
} else {
    echo "<html>
            <link rel='stylesheet' href='menucss.css'>
        </html>";
    echo "<h1>Invalid username or password</h1>";
    echo "<a href='menu.html'>Return to Login</a>";
    exit();
}
?>
