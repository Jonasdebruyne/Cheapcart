<?php
function canLogin($email, $password)
{
    $conn = new PDO('mysql:host=127.0.0.1;dbname=cheapcart', "root", "root");
    $statement = $conn->prepare("select email, password, firstname, lastname, id from users where email = :email");
    $statement->bindValue(":email", $email);
    $statement->execute();
    $user = $statement->fetch();
    if (!$user) {
        return false;
    }

    // exit();

    $hash = $user["password"];
    if (password_verify($password, $hash)) {
        // login
        session_start();
        $_SESSION["firstname"] = $user['firstname'];
        $_SESSION["lastname"] = $user['lastname'];
        $_SESSION["email"] = $email;
        $_SESSION["userid"] = $user['id'];
        return true;
    } else {
        var_dump(password_verify($password, $hash));
        return false;
    }
}

if (!empty($_POST)) {
    // er is verzonden!
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (canLogin($email, $password)) {
        // redirect
        header("location: home.php");
        die;
    } else {
        // error
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheapcart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $page = "Aanmelden";
    require_once("./views/menu_top.php");
    ?>

    <div class="content">
        <form action="" method="post" class="login">
            <?php if (isset($error)): ?>
                <p>Wachtwoord is niet correct!</p>
            <?php endif; ?>

            <label for="email">E-mailadres</label>
            <input type="text" id="email" name="email">

            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Inloggen" class="btn">
            <a href="#">Wachtwoord vergeten?</a>

            <div>
                <div class="new">
                    <p class="border"></p>
                    <p>Nieuw hier?</p>
                    <p class="border"></p>
                </div>
                <a href="register.php">Maak nu een profiel aan</a>
            </div>
        </form>
    </div>
</body>

</html>