<?php require "includes/header.php" ?>
<main>
    <?php if(isset($_SESSION["role"])){ ?>

        <div class="dashboard">
            <h1>user test</h1>
        </div>

    <?php }else{
        header("Location: /login-form");
        die();
    }; ?>
</main>
<?php require "includes/footer.php" ?>