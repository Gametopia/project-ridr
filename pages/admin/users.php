<?php require "includes/header.php" ?>
<?php if ($_SESSION['role'] == 'admin') { ?>
    <div class="admin-dashboard">
        <main>

            <div class="account-container">

            <?php require "includes/admin-sidebar.php" ?>

                <section class="dashboard admin-dashboard">

                    <h1>Gebruikers</h1>
                    <p class="accent-color">Overzicht van alle gebruikers</p>

                    

        </main>
    </div>

<?php } else {
    header("Location: /account");
    die();
}; ?>

<?php require "includes/footer.php" ?>