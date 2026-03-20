<?php require "includes/header.php" ?>
<main>
    <?php if (isset($_SESSION["role"])) { ?>
        <?php $editMode = isset($_GET['edit']); ?>
        <?php
        $userid = $_SESSION['id'];
        $stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->execute([':id' => $userid]);
        $userdata = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="account-container">
            <aside class="account-sidebar">
                <ul>
                    <li class="account-sidebar-item active"><a href="#">Mijn Account</a></li>
                    <li class="account-sidebar-item"><a href="#">Accountinformatie</a></li>
                    <li class="account-sidebar-item"><a href="#">Reserveringen</a></li>
                    <li class="account-sidebar-item logout"><a href="/logout">Uitloggen</a></li>
                </ul>
            </aside>



            <section class="dashboard">
                <?php if (isset($_GET['updated'])): ?>
                    <div class="succes-message">Gegevens succesvol bijgewerkt!</div>
                <?php endif; ?>
                <h1>Mijn Account</h1>
                <p>Welkom terug! Hier kun je jouw gegevens bekijken en beheren.</p>
                <section class="dashboard-card">
                    <div class="account-info">
                        <h1>Contactinformatie</h1>

                        <?php if ($editMode): ?>

                            <form method="post" action="/actions/account-edit.php" class="account-form">
                                <label>Voornaam</label>
                                <input type="text" name="name" value="<?= htmlspecialchars($userdata['name']) ?>">

                                <label>Achternaam</label>
                                <input type="text" name="surname" value="<?= htmlspecialchars($userdata['surname']) ?>">

                                <label>Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($userdata['email']) ?>">

                                <br><br>

                                <button type="submit" name="save" class="button-primary">Opslaan</button>
                                <a href="/account" class="button-secondary">Annuleren</a>
                            </form>

                        <?php else: ?>


                            <p><?= htmlspecialchars($userdata['name']) . " " . htmlspecialchars($userdata['surname']) ?></p>
                            <p><?= htmlspecialchars($userdata['email']) ?></p>

                            <br>

                            <a href="/account?edit=1" class="button-primary">Bewerken</a>

                        <?php endif; ?>

                    </div>
                </section>

                <section class="dashboard-card">
                    <div class="account-info">
                        <h1>Standaard Factuuradres</h1>
                        <p></p>
                    </div>
                </section>

        </div>

    <?php } else {
        header("Location: /login-form");
        die();
    }; ?>
</main>
<?php require "includes/footer.php" ?>