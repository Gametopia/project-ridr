<?php require "includes/header.php" ?>
<main>
    <?php if($_SESSION['role'] == 'admin') { ?>

        <div class="dashboard">
            <h1>admin test</h1>
        </div>

    <?php }else{
        header("Location: /account");
        die();
    }; ?>
</main>
<?php require "includes/footer.php" ?>