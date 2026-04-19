<?php require "includes/header.php" ?>
<header>
    <div class="advertorials">
        <div class="advertorial">
            <h2>Hét platform om een auto te huren</h2>
            <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
            <a href="/ons-aanbod" class="button-primary">Huur nu een auto</a>
            <img src="assets/images/car-rent-header-image-1.png" alt="">
            <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
        </div>
        <div class="advertorial">
            <h2>Wij verhuren ook bedrijfswagens</h2>
            <p>Voor een vaste lage prijs met prettig voordelen.</p>
            <a href="#" class="button-primary">Huur een bedrijfswagen</a>
            <img src="assets/images/car-rent-header-image-2.png" alt="">
            <img src="assets/images/header-block-background.svg" alt="" class="background-header-element">

        </div>
    </div>
</header>

<main>

    <?php
    $cars = $conn->prepare("SELECT * FROM cars");
    $cars->execute();
    $cars = $cars->fetchAll();
    ?>

    <h2 class="section-title">Populaire auto's</h2>
    <div class="cars">

        <?php
        $start = max(0, count($cars) - 4);
        for ($i = $start; $i < count($cars); $i++):
        ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?php echo $cars[$i]['brand'] . ' ' . $cars[$i]['name'] ?></h3>
                    <div class="car-type">
                        <?php echo $cars[$i]['category'] ?>
                    </div>
                </div>
                <img src="<?php echo $cars[$i]['image'] ?>" alt="">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?php echo $cars[$i]['fuel'] ?>L</span>
                    <span><img src="assets/images/icons/car.svg" alt=""><?= $cars[$i]['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?></span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?php echo $cars[$i]['seats'] ?> Personen</span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?php echo $cars[$i]['price'] ?>,00</span> / dag</span>
                    <a href="/car-detail?id=<?php echo $cars[$i]['id'] ?>" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <h2 class="section-title">Aanbevolen auto's</h2>
    <div class="cars" id="cars-preview">
        <?php for ($i = 0; $i < min(8, count($cars)); $i++): ?>
            <div class="car-details">
                <div class="car-brand">

                    <h3><?php echo $cars[$i]['brand'] . ' ' . $cars[$i]['name'] ?></h3>

                    <div class="car-type">
                        <?php echo $cars[$i]['category'] ?>
                    </div>  
                </div>
                <img src="<?php echo $cars[$i]['image'] ?>" alt="">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?php echo $cars[$i]['fuel'] ?>L</span>
                    <span><img src="assets/images/icons/car.svg" alt=""><?= $cars[$i]['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?></span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?php echo $cars[$i]['seats'] ?> Personen</span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?php echo $cars[$i]['price'] ?>,00</span> / dag</span>
                    <a href="/car-detail?id=<?php echo $cars[$i]['id'] ?>" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>

        <div class="cars" id="cars-extended" style="margin-top: 20px; display: none;">
            <?php for ($i = 0; $i < count($cars); $i++): ?>
                <div class="car-details">
                    <div class="car-brand">
                        <h3><?php echo $cars[$i]['brand'] . ' ' . $cars[$i]['name'] ?></h3>
                        <div class="car-type">
                            <?php echo $cars[$i]['category'] ?>
                        </div>
                    </div>
                    <img src="<?php echo $cars[$i]['image'] ?>" alt="">
                    <div class="car-specification">
                        <span><img src="assets/images/icons/gas-station.svg" alt=""><?php echo $cars[$i]['fuel'] ?>L</span>
                        <span><img src="assets/images/icons/car.svg" alt=""><?= $cars[$i]['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?></span>
                        <span><img src="assets/images/icons/profile-2user.svg" alt=""><?php echo $cars[$i]['seats'] ?> Personen</span>
                    </div>
                    <div class="rent-details">
                        <span><span class="font-weight-bold">€<?php echo $cars[$i]['price'] ?>,00</span> / dag</span>
                        <a href="/car-detail?id=<?php echo $cars[$i]['id'] ?>" class="button-primary">Bekijk nu</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

    <div class="show-more">
        <button class="button-primary" id="showAllBtn">Toon Alle</button>
    </div>
</main>

<?php require "includes/footer.php" ?>