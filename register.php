<?php
include_once(__DIR__ . "/classes/User.php");

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setPhoneNumber($_POST['phoneNumber']);
        $user->setPostalCode($_POST['postalCode']);
        $user->setCity($_POST['city']);
        $user->setStreet($_POST['street']);
        $user->setHouseNumber($_POST['houseNumber']);
        $user->setEmail($_POST['email']);
        $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));

        $user->save();
        $success = "User saved!";


    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}

$users = User::getAll();

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
    <header>
        <nav>
            <div class="top-nav">
                <a href="home.php" class="logo">
                    <img src="assets/images/Uitwerking logo cheapcart.svg" alt="logo">
                </a>
                <div class="profile">
                    <a href="index.php"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <div class="bottom-nav">
                <h2>Registreren</h2>
            </div>
        </nav>
    </header>
    <?php if (isset($error)): ?>
        <p>Wachtwoord is niet correct!</p>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="error" style="color: red">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="success" style="color: red">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <div class="content">
        <form action="" method="post" class="registter">
            <label for="sex">Aanhef</label>
            <div class="bullets">
                <input type="radio" id="mevrouw" name="fav_language" value="mevrouw">
                <label for="mevrouw">Mevrouw</label><br>
                <input type="radio" id="meneer" name="fav_language" value="meneer">
                <label for="meneer">Meneer</label><br>
                <input type="radio" id="ander" name="fav_language" value="ander">
                <label for="ander">Ander</label>
            </div>

            <div>
                <div>
                    <label for="firstname">Voornaam</label>
                    <input type="text" id="firstname" name="firstname">
                </div>
                <div>
                    <label for="lastname">Familienaam</label>
                    <input type="text" id="lastname" name="lastname">
                </div>
            </div>

            <label for="dateOfBirth">Geboortedatum</label>
            <input type="text" id="dateOfBirth" name="dateOfBirth">

            <label for="phoneNumber">Telefoonnummer</label>
            <input type="text" id="phoneNumber" name="phoneNumber">

            <div>
                <div>
                    <label for="postalCode">Postcode</label>
                    <input type="text" id="postalCode" name="postalCode">
                </div>
                <div>
                    <label for="city">Stad</label>
                    <input type="text" id="city" name="city">
                </div>
            </div>

            <div>
                <div>
                    <label for="street">Straat</label>
                    <input type="text" id="street" name="street">
                </div>
                <div>
                    <label for="houseNumber">Huisnummer</label>
                    <input type="text" id="houseNumber" name="houseNumber">
                </div>
            </div>

            <div>
                <div>
                    <label for="email">E-mailadres</label>
                    <input type="text" id="email" name="email">
                </div>
                <!-- <div>
                        <label for="email2">Herhaal e-mailadres</label>
                        <input type="text" id="email2" name="email2">
                    </div> -->
            </div>

            <div>
                <div>
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password">
                </div>
                <!-- <div>
                        <label for="password2">Herhaal wachtwoord</label>
                        <input type="password" id="password2" name="password">
                    </div> -->
            </div>

            <input type="submit" value="Aanmelden" class="btn">
        </form>
    </div>
</body>

</html>