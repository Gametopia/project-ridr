<?php require "includes/header.php" ?>
<?php if ($_SESSION['role'] == 'admin') { ?>
    <div class="admin-dashboard">
        <main>

            <div class="account-container">

                <?php require "includes/admin-sidebar.php" ?>

                <section class="dashboard admin-dashboard">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM cars");
                    $stmt->execute();
                    $vehicles = $stmt->fetchAll();
                    ?>

                    <div class="user-search">
                        <h1>Voertuigen</h1>

                        <form action="">
                            <input type="search" name="" id="searchInput" placeholder="Voertuig Opzoeken">
                            <img src="/../assets/images/icons/search-normal.svg" alt="" class="search-icon">
                        </form>
                    </div>
                    <p class="accent-color">Overzicht van alle voertuigen</p>

                    <div class="cars">

                        <?php foreach ($vehicles as $car): ?>

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
                                    <a href="#=<?php echo $car['id'] ?>" class="button-primary">Bewerken</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

        </main>
    </div>

<?php } else {
    header("Location: /account");
    die();
}; ?>

<?php require "includes/footer.php" ?>