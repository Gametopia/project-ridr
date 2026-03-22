<?php require "includes/header.php" ?>
<main>
    <?php if (isset($_SESSION["role"])) { ?>
        <?php $editMode = isset($_GET['edit']);
        $reservationMode = isset($_GET['reservations'])
        ?>
        <?php
        $userid = $_SESSION['id'];
        $stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->execute([':id' => $userid]);
        $userdata = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <?php $stmt = $conn->prepare("SELECT cars.*, reservations.`order` AS order_id FROM reservations JOIN cars ON reservations.car = cars.id WHERE reservations.user = :userid");
        $stmt->execute([':userid' => $userid]);
        $reservedCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="account-container">
            <aside class="account-sidebar">
                <ul>
                    <li class="account-sidebar-item <?php if (empty($_GET)): echo 'active';
                                                    endif; ?>"><a href="/account">Mijn Account</a></li>
                    <li class="account-sidebar-item <?php if ($editMode): echo "active";
                                                    endif; ?>"><a href="/account?edit=1">Accountinformatie</a></li>
                    <li class="account-sidebar-item <?php if ($reservationMode): echo 'active';
                                                    endif; ?>"><a href="/account?reservations=1">Reserveringen</a></li>
                    <li class="account-sidebar-item logout"><a href="/logout">Uitloggen</a></li>
                </ul>
            </aside>

            <?php if (empty($_GET)): ?>
                <section class="dashboard">
                    <?php if (isset($_GET['updated'])): ?>
                        <div class="succes-message">Gegevens succesvol bijgewerkt!</div>
                    <?php endif; ?>
                    <h1>Mijn Account</h1>
                    <p>Welkom terug! Hier kun je jouw gegevens bekijken en beheren.</p>
                    <section class="dashboard-card">
                        <div class="account-info">
                            <h1>Contactinformatie</h1>
                            <p><?= htmlspecialchars($userdata['name']) . " " . htmlspecialchars($userdata['surname']) ?></p>
                            <p><?= htmlspecialchars($userdata['email']) ?></p>
                            <p><?= htmlspecialchars($userdata['phone']) ?></p>

                            <br>

                            <a href="/account?edit=1" class="button-primary">Bewerken</a>
                        </div>
                    </section>
                </section>
            <?php elseif ($editMode): ?>
                <section class="dashboard">
                    <h1>Accountinformatie</h1>
                    <p>Hier kun je jouw account gegevens beheren.</p>
                    <section class="dashboard-card">
                        <div class="account-info">
                            <form method="post" action="/actions/account-edit.php" class="account-form">
                                <label>Voornaam</label>
                                <input type="text" name="name" value="<?= htmlspecialchars($userdata['name']) ?>">

                                <label>Achternaam</label>
                                <input type="text" name="surname" value="<?= htmlspecialchars($userdata['surname']) ?>">

                                <label>Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($userdata['email']) ?>">

                                <label>Telefoonnummer</label>
                                <input type="phone" name="phone" value="<?= htmlspecialchars($userdata['phone']) ?>">

                                <br><br>

                                <button type="submit" name="save" class="button-primary">Opslaan</button>
                                <a href="/account" class="button-secondary">Annuleren</a>
                            </form>
                        </div>
                    </section>
                </section>

            <?php elseif ($reservationMode): ?>
                <section class="dashboard">
                    <h1>Reserveringen</h1>
                    <p>Hier kun je jouw reserveringen bekijken en beheren.</p>
                    <div class="cars">
                        <?php foreach ($reservedCars as $car): ?>
                            <div class="car-details">
                                <div class="car-brand">
                                    <h3><?php echo $car['name'] ?></h3>
                                    <div class="car-type">
                                        <?php echo $car['category'] ?>
                                    </div>
                                </div>
                                <img src="<?php echo $car['image'] ?>" alt="">
                                <div class="car-specification">
                                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?php echo $car['fuel'] ?>L</span>
                                    <span><img src="assets/images/icons/car.svg" alt=""><?= $car['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?></span>
                                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?php echo $car['seats'] ?> Personen</span>
                                </div>
                                <div class="rent-details">
                                    <span><span class="font-weight-bold">€<?php echo $car['price'] ?>,00</span> / dag</span>
                                    <a href="/reservation?id=<?php echo $car['order_id'] ?>" class="button-primary">Bekijk Reservering</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

        <?php } else {
        header("Location: /login-form");
        die();
    }; ?>
</main>
<?php require "includes/footer.php" ?>