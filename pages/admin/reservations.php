<?php require "includes/header.php" ?>
<?php if ($_SESSION['role'] == 'admin') { ?>
    <div class="admin-dashboard">
        <main>

            <div class="account-container">

            <?php require "includes/admin-sidebar.php" ?>

                <section class="dashboard admin-dashboard">

                    <h1>Reserveringen</h1>
                    <p class="accent-color">Overzicht van alle reserveringen</p>

                    <div class="admin-grid">

                        <?php
                        $stmt = $conn->prepare("SELECT cars.*, reservations.* FROM reservations JOIN cars ON reservations.car = cars.id");
                        $stmt->execute();
                        $reservations = $stmt->fetchAll();
                        ?>
                        <?php foreach ($reservations as $reservation): ?>

                        <div class="cars">
                            <h3>Details</h3>
                            <div class="car-details">
                                <img src="assets/images/products/car (1).svg" alt="">
                                <div>
                                    <?php $pickup_date = strtotime($reservation['pickup_date']) ?>
                                    <?php $dropoff_date = strtotime($reservation['dropoff_date']) ?>
                                    <h3><?php echo $reservation['name'] ?></h3>
                                    <span class="accent-color"># <?php echo $reservation['order'] ?></span>
                                </div>
                            </div>

                            <div class="admin-rental-info">
                                <div>
                                    <strong>Pick-up</strong>
                                    <p><?php echo $reservation['pickup_location']; ?></p>
                                    <span class="accent-color"><?php echo date("d-F", $pickup_date); ?> • <?php echo trim($reservation['pickup_time'], ":00"); ?></span>
                                </div>
                                <div>
                                    <strong>Drop-Off</strong>
                                    <p><?php echo $reservation['dropoff_location']; ?></p>
                                    <span class="accent-color"><?php echo date("d-F", $dropoff_date); ?> • <?php echo trim($reservation['dropoff_time'], ":00"); ?></span>
                                </div>
                            </div>

                            <div class="admin-total">
                                <span>Total Rental Price</span>
                                <span class="font-weight-bold">€ <?php echo $reservation['order_total'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>



                        
                        </div>

                    </div>

                </section>

            </div>

        </main>
    </div>

<?php } else {
    header("Location: /account");
    die();
}; ?>

<?php require "includes/footer.php" ?>