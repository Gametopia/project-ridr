<?php require "includes/header.php" ?>
<main>
    <?php if (isset($_SESSION["role"])) { ?>

    <div class="w3-sidebar w3-border w3-light-grey">
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Mijn Account</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Accountinformatie</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Reserveringen</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Uitloggen</a>
    </div>
        <div class="dashboard">

        </div>

    <?php } else {
        header("Location: /login-form");
        die();
    }; ?>
</main>
<?php require "includes/footer.php" ?>