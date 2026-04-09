<?php require "includes/header.php" ?>
<?php if ($_SESSION['role'] == 'admin') { ?>
    <div class="admin-dashboard">
        <main>

            <div class="account-container">

                <?php require "includes/admin-sidebar.php" ?>

                <section class="dashboard admin-dashboard">
                    <?php
                    $stmt = $conn->prepare("SELECT `name`, `surname`, `email`, `adres`, `postal`, `phone`, `role`  FROM account");
                    $stmt->execute();
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                <div class="user-search">
                    <h1>Gebruikers</h1>
                    
                        <form action="">
                            <input type="search" name="" id="" placeholder="Gebruiker Opzoeken">
                            <img src="/../assets/images/icons/search-normal.svg" alt="" class="search-icon">
                        </form>
                    </div>
                    <p class="accent-color">Overzicht van alle gebruikers</p>

                    <div class="users-grid">
                        <?php foreach ($users as $user): ?>
                            <div class="user-card">
                                <img src="/assets/images/Profil.png" alt="">

                                <div class="user-main">
                                    <h3><?= htmlspecialchars($user['name']) ?> <?= htmlspecialchars($user['surname']) ?></h3>
                                    <span class="role-badge">
                                        <?= htmlspecialchars($user['role']) ?>
                                    </span>
                                </div>

                                <div class="user-details">
                                    <p><label>Email:</label> <?= htmlspecialchars($user['email']) ?></p>
                                    <p><label>Phone:</label> <?= htmlspecialchars($user['phone']) ?></p>
                                    <p><label>Adres:</label> <?= htmlspecialchars($user['adres']) ?></p>
                                    <p><label>Postcode:</label> <?= htmlspecialchars($user['postal']) ?></p>
                                </div>

                                <a href="#" class="button-primary edit-btn">Bewerken</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
            </div>
        </main>
    </div>

<?php } else {
    header("Location: /account");
    die();
}; ?>

<?php require "includes/footer.php" ?>