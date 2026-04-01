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
                        $latest = end($reservations);
                        ?>

                        <div class="white-background admin-card large">
                            <h3>Details Rental</h3>

                            

                            <div class="admin-car">
                                <img src="assets/images/products/car (1).svg" alt="">
                                <div>
                                    <?php $pickup_date = strtotime($latest['pickup_date']) ?>
                                    <?php $dropoff_date = strtotime($latest['dropoff_date']) ?>
                                    <h3><?php echo $latest['name'] ?></h3>
                                    <span class="accent-color"># <?php echo $latest['order'] ?></span>
                                </div>
                            </div>

                            <div class="admin-rental-info">
                                <div>
                                    <strong>Pick-up</strong>
                                    <p><?php echo $latest['pickup_location']; ?></p>
                                    <span class="accent-color"><?php echo date("d-F", $pickup_date); ?> • <?php echo trim($latest['pickup_time'], ":00"); ?></span>
                                </div>
                                <div>
                                    <strong>Drop-Off</strong>
                                    <p><?php echo $latest['dropoff_location']; ?></p>
                                    <span class="accent-color"><?php echo date("d-F", $dropoff_date); ?> • <?php echo trim($latest['dropoff_time'], ":00"); ?></span>
                                </div>
                            </div>

                            <div class="admin-total">
                                <span>Total Rental Price</span>
                                <span class="font-weight-bold">€ <?php echo $latest['order_total'] ?></span>
                            </div>
                        </div>




                        
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