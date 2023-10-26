<?php
session_start();
include "dbConnection.php";

if (isset($_POST['login'])) {
    $email = trim($_POST['emailLogin']);
    $_SESSION['emailLogin'] = $email;
    $password = trim($_POST['passwordLogin']);
    $_SESSION['passwordLogin'] = $password;

    $sql = "SELECT * FROM usersmodule4exo3 WHERE email = :email";
    $result = $db->prepare($sql);
    $result->bindParam(':email', $email);
    $result->execute();

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $storedPassword = $row['password'];

        // SUCCESS
        if (password_verify($password, $storedPassword)) {  
            $_SESSION['successMessage'] = "Login successful!";
            $_SESSION['logged'] = true;
            unset($_SESSION['emailLogin']);
        } else {
            // Password
            $_SESSION['errorMessage'] = "Incorrect username or password. Please try again. (password)";
        }
        // Username
    } else {
        $_SESSION['errorMessage'] = "Incorrect username or password. Please try again. (username)";
    }
}

header("Location: index.php");
exit();
?>
