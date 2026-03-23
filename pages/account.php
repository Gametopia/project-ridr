<?php require "includes/header.php" ?>
<main>
    <?php if (isset($_SESSION["role"])) { ?>
        <?php
        $editMode = isset($_GET['edit']);
        $reservationMode = isset($_GET['reservations']);
        $reservationView = isset($_GET['reservation']);
        $cancelView = isset($_GET['cancel']);
        ?>
        <?php
        $userid = $_SESSION['id'];
        $stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->execute([':id' => $userid]);
        $userdata = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <?php
        $stmt = $conn->prepare("SELECT cars.*, reservations.`order` AS order_id FROM reservations JOIN cars ON reservations.car = cars.id WHERE reservations.user = :userid");
        $stmt->execute([':userid' => $userid]);
        $reservedCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_cancel'])) {
            $reservationNumber = $_POST['reservation_id'];
            $userid = $_SESSION['id'];
            $stmt = $conn->prepare("DELETE FROM reservations WHERE `order` = :reservationnumber AND user = :userid");
            $stmt->execute([':reservationnumber' => $reservationNumber, ':userid' => $userid]);
            header("Location: /account?reservations=1&deleted=1");
            exit;
        }
        ?>


        <div class="account-container">
            <aside class="account-sidebar">
                <ul>
                    <li class="account-sidebar-item <?php if (empty($_GET)):
                        echo 'active';
                    endif; ?>"><a href="/account">Mijn Account</a></li>
                    <li class="account-sidebar-item <?php if ($editMode):
                        echo "active";
                    endif; ?>"><a href="/account?edit=1">Accountinformatie</a></li>
                    <li class="account-sidebar-item <?php if (($reservationMode) || ($reservationView)):
                        echo 'active';
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
                    <?php if (empty($reservedCars)): ?>
                        <p class="accent-color">Je hebt nog geen reserveringen.</p>
                        <a href="/ons-aanbod" class="button-primary">Boek Nu</a>
                    <?php endif; ?>
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
                                    <span><img src="assets/images/icons/car.svg"
                                            alt=""><?= $car['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?></span>
                                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?php echo $car['seats'] ?>
                                        Personen</span>
                                </div>
                                <div class="rent-details">
                                    <span><span class="font-weight-bold">€<?php echo $car['price'] ?>,00</span> / dag</span>
                                    <a href="?reservation=<?php echo $car['order_id'] ?>" class="button-primary">Bekijk
                                        Reservering</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

            <?php elseif ($reservationView): ?>
                <?php
                $reservationNumber = $_GET['reservation'];
                $stmt = $conn->prepare("SELECT cars.*, reservations.* FROM reservations JOIN cars ON reservations.car = cars.id WHERE reservations.order = :reservationnumber");
                $stmt->execute([":reservationnumber" => $reservationNumber]);
                $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <?php if (@$reservation['user'] === $userid): ?>
                    <section class="dashboard">
                        <h1>Reservering #<?php echo $reservation['order'] ?></h1>
                        <div class="cars">
                            <div class="car-details">
                                <div class="car-brand">
                                    <h3><?php echo $reservation['name'] ?></h3>
                                    <div class="car-type">
                                        <?php echo $reservation['category'] ?>
                                    </div>
                                </div>
                                <img src="<?php echo $reservation['image'] ?>" alt="">
                                <div class="car-specification">
                                    <span><img src="assets/images/icons/gas-station.svg"
                                            alt=""><?php echo $reservation['fuel'] ?>L</span>
                                    <span><img src="assets/images/icons/car.svg"
                                            alt=""><?= $reservation['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?></span>
                                    <span><img src="assets/images/icons/profile-2user.svg"
                                            alt=""><?php echo $reservation['seats'] ?> Personen</span>
                                </div>
                                <div class="rent-details">
                                    <?php $pickup_date = strtotime($reservation['pickup_date']) ?>
                                    <p>Ophaaldatum: <?php echo date("d-m-Y", $pickup_date) ?></p>
                                    <p>Ophaaltijd: <?php echo trim($reservation['pickup_time'], ":00") ?></p>
                                    <a href="?cancel=<?php echo $reservation['order'] ?>" class="button-primary">Reservering
                                        Annuleren</a>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php else: ?>
                    <h1>Geen reservering gevonden</h1>
                <?php endif; ?>

            <?php elseif ($cancelView): ?>
                <?php
                $reservationNumber = $_GET['cancel'];
                $stmt = $conn->prepare("SELECT cars.*, reservations.* FROM reservations JOIN cars ON reservations.car = cars.id WHERE reservations.order = :reservationnumber");
                $stmt->execute([":reservationnumber" => $reservationNumber]);
                $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <?php if ($reservation && $reservation['user'] == $userid): ?>
                    <section class="dashboard">
                        <h1>Reservering Annuleren</h1>
                        <p>Weet je zeker dat je jouw reservering wilt annuleren?</p>
                        <form method="post">
                            <input type="hidden" name="reservation_id" value="<?= $reservation['order'] ?>">

                            <button type="submit" name="confirm_cancel" class="button-primary">
                                Reservering Annuleren
                            </button>

                            <a href="/account?reservations=1" class="button-secondary">
                                Annuleren
                            </a>
                        </form>
                    </section>
                <?php else: ?>
                    <h1>Geen reservering gevonden</h1>
                <?php endif; ?>
            <?php endif; ?>

        <?php } else {
        header("Location: /login-form");
        die();
    }
    ; ?>
</main>
<?php require "includes/footer.php" ?>