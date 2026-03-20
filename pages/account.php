<?php require "includes/header.php" ?>
<main>
    <?php if (isset($_SESSION["role"])) { ?>

        <div class="account-container">

            <aside class="account-sidebar">
                <ul>
                    <li class="account-sidebar-item active"><a href="#">Mijn Account</a></li>
                    <li class="account-sidebar-item"><a href="#">Accountinformatie</a></li>
                    <li class="account-sidebar-item"><a href="#">Reserveringen</a></li>
                    <li class="account-sidebar-item logout"><a href="#">Uitloggen</a></li>
                </ul>
            </aside>

            <section class="dashboard">
                <div class="account-info">
                    <h1>Mijn Account</h1>
                    <p>Welkom terug! Hier kun je jouw gegevens bekijken en beheren.</p>
                </div>
            </section>

        </div>

    <?php } else {
        header("Location: /login-form");
        die();
    }; ?>
</main>
<?php require "includes/footer.php" ?>