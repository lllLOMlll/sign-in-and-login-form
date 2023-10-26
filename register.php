  <?php
  session_start();
  include "dbConnection.php";

  if (isset($_POST['buttonRegister'])) {
    $_SESSION['registrationInProgress'] = true;
    $email = trim($_POST['emailRegister']);
    $_SESSION['emailRegister'] = $email; 
    $passwordRegistration = trim($_POST['passwordRegister']);
    $_SESSION['passwordRegister'] = $passwordRegistration;  
    $confirmPassword = trim($_POST['passwordConfirmRegister']);
    $_SESSION['passwordConfirmRegister'] = $confirmPassword; 


    // ********************************************   VALIDATION   ********************************************
    $errorMessageRegister = "";

    // Empty registration
    if (empty($_POST['emailRegister']) || empty($_POST['passwordRegister']) || empty($_POST['passwordConfirmRegister'])) { 
      $_SESSION['errorMessage'] = "You must complete all the fields";
      header("Location: index.php");
      exit();
    }

      // EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessageRegister .= "Invalid email format. <br>";
    }
    if (strlen($email) > 50) {
      $errorMessageRegister .= "Email must be less than 50 characters long. <br>";
    }

        // Check if email already exists in the database
    $query = $db->prepare("SELECT * FROM usersmodule4exo3 WHERE email = :email");
    $query->bindValue(':email', $email);
    $query->execute();

    if ($query->rowCount() > 0) {
       $_SESSION['errorMessage'] = "This email is already registered. Please choose another. <br>";
      header("Location: index.php");
      exit();
    }

      // PASSWORD
    if (strlen($passwordRegistration) < 8) {
      $errorMessageRegister .= "Password must be at least 8 characters long. <br>";
    } 
    if (!preg_match("/[A-Z]/", $passwordRegistration)) {
      $errorMessageRegister .= "Password must contain at least one uppercase letter. <br>";
    } 
    if (!preg_match("/[!@#\$%\^&*()]/", $passwordRegistration)) {
      $errorMessageRegister .= "Password must contain at least one special character. <br>";
    }
    if ($passwordRegistration != $confirmPassword) {
      $errorMessageRegister .= "Your password and your confimation password does not match. <br>";
    }

    // ERROR MESSAGE
    if (!empty($errorMessageRegister)) {
      $_SESSION['errorMessage'] = $errorMessageRegister;
      header("Location: index.php");
      exit();
    }

    // SUCCESS!!!
    if (empty($errorMessageRegister)) {
      $query = $db->prepare("INSERT INTO usersmodule4exo3 (email, password) VALUES (:email, :password)");

      $query->bindValue(':email', $email);

        // Hash password before inserting into the database
      $passwordHash = password_hash($passwordRegistration, PASSWORD_DEFAULT);
      $query->bindValue(':password', $passwordHash);

      $query->execute();

      $_SESSION['successMessage'] = "Successful registration!";
      unset($_SESSION['emailRegister']);
      unset($_SESSION['passwordRegister']);
      unset($_SESSION['passwordConfirmRegister']);
      unset($_SESSION['errorMessageRegister']);
      unset($_SESSION['emailLogin']);
      header("Location: index.php");
      exit();
    }
  }
  ?>
