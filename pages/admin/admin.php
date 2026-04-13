<?php require "includes/header.php" ?>
<main>
    <?php if ($_SESSION['role'] == 'admin') { ?>



        <div class="admin-dashboard">
            <main>

                <div class="account-container">

                   <?php require "includes/admin-sidebar.php" ?>

                    <section class="dashboard admin-dashboard">

                        <h1>Dashboard</h1>
                        <p class="accent-color">Overview of your rental platform performance</p>

                        <div class="admin-grid">

                            <?php
                            $stmt = $conn->prepare("SELECT cars.*, reservations.* FROM reservations JOIN cars ON reservations.car = cars.id");
                            $stmt->execute();
                            $reservations = $stmt->fetchAll();
                            $latest = end($reservations);
                            ?>

                            <div class="white-background admin-card large">
                                <h3>Details Rental</h3>

                                <div class="admin-map"></div>
                                
                                    <div class="admin-car">
                                        <img src="assets/images/products/car (1).svg" alt="">
                                        <div>
                                            <?php $pickup_date = strtotime($latest['pickup_date']) ?>
                                            <?php $dropoff_date = strtotime($latest['dropoff_date']) ?>
                                            <h3><?php echo $latest['brand'] . ' ' . $latest['name'] ?></h3>
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
                        

                        <div class="white-background admin-card">
                            <h3>Top 5 Car Rental</h3>
                            <div class="admin-chart"></div>
                        </div>

                        <div class="white-background admin-card">
                            <h3>Recent Transaction</h3>



                            <div class="admin-transactions">
                                <?php
                                $stmt = $conn->prepare("SELECT cars.*, reservations.* FROM reservations JOIN cars ON reservations.car = cars.id");
                                $stmt->execute();
                                $reservations = $stmt->fetchAll();
                                ?>


                                <?php for ($i = 0; $i < min(3, count($reservations)); $i++): ?>

                                    <div class="admin-transaction">
                                        <img src="assets/images/products/car (0).svg">
                                        <div>
                                            <p><?php echo $reservations[$i]['brand'] . ' ' . $reservations[$i]['name']  ?></p>
                                            <span class="accent-color">€ <?php echo $reservations[$i]["order_total"] ?></span>
                                        </div>
                                    </div>
                                <?php endfor; ?>
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
</main>
<?php require "includes/footer.php" ?>