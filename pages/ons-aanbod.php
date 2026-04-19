<?php require "includes/header.php" ?>

<main>
    <h2>Ons aanbod</h2>

    <?php
    $cars = $conn->prepare("SELECT cars.*, brands.* FROM brands JOIN cars ON brands.brand_id = cars.brand_id");
    $cars->execute();
    $cars = $cars->fetchAll();

    $getAllCarTypes = $conn->prepare("SELECT * FROM brands ");
    $getAllCarTypes->execute();

    // $filteredCar = $conn->prepare("SELECT * FROM cars WHERE brand = :merk AND price <= :ppd AND category = :type AND transmission = :transmissie");
    // if (isset($_GET['merk'])) {
    //     $merk = $_GET['merk'];
    //     $filteredCar->bindParam(':merk', $merk);
    // } else {
    //     $filteredCar->bindValue(':merk', '%');
    // }
    
    ?>

    <div class="ons-aanbod-layout">
        <aside class="filter-sidebar">
            <form method="get">
                <div class="filter-menu">
                    <div class="filter-menu-header">
                        <h3>Filters</h3>
                        <button class="filter-reset" type="button">Reset</button>
                    </div>

                    <div class="active-filters">
                        <!-- <span class="filter-tag">SUV <button type="button">×</button></span>
                    <span class="filter-tag">Automaat <button type="button">×</button></span> -->
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title">Merk</div>
                        
                        <?php for ($i = 0; $i < $getAllCarTypes->rowCount(); $i++):
                            $getName = $conn->query("SELECT DISTINCT brand FROM cars where brand_id = $i")->fetchAll();
                            $name = $getName[$i];
                            ?>
                            <div class="filter-option">
                                <input type="checkbox" id="<?= $name ?>">
                                <label for="<?= $getAllCarTypes->fetchColumn() ?>"> </label>
                                <span class="filter-count"><?= $getAllCarTypes->rowCount() ?></span>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title">Type</div>

                        <div class="filter-option">
                            <input type="checkbox" id="suv">
                            <label for="suv">SUV</label>
                        </div>

                        <div class="filter-option">
                            <input type="checkbox" id="sedan">
                            <label for="sedan">Sedan</label>
                        </div>

                        <div class="filter-option">
                            <input type="checkbox" id="hatchback">
                            <label for="hatchback">Hatchback</label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title">Transmissie</div>

                        <div class="filter-option">
                            <input type="radio" name="transmission" id="automatic">
                            <label for="automatic">Automaat</label>
                        </div>

                        <div class="filter-option">
                            <input type="radio" name="transmission" id="manual">
                            <label for="manual">Handgeschakeld</label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title">Prijs per dag</div>

                        <div class="price-range">
                            <div class="price-range-values">
                                <span>€50</span>
                                <span>€250</span>
                            </div>
                            <input type="range" min="50" max="250" value="150">
                        </div>
                    </div>

                    <div class="filter-actions">
                        <button class="filter-clear" type="button">Wissen</button>
                        <button class="filter-apply" type="submit">Toepassen</button>
                    </div>
                </div>
            </form>
        </aside>

        <section class="ons-aanbod-results">
            <div class="cars" id="cars-extended">
                <?php for ($i = 0; $i < count($cars); ): ?>
                    <?php if ($cars[$i]['available'] !== 1):
                        $i++; endif; ?>
                    <div class="car-details">
                        <div class="car-brand">
                            <h3> <?php echo $cars[$i]['brand'] . ' ' . $cars[$i]['name'] ?></h3>
                            <div class="car-type">
                                <?php echo $cars[$i]['category'] ?>
                            </div>
                        </div>

                        <img src="<?php echo $cars[$i]['image'] ?>" alt="">
                        <div class="car-specification">
                            <span>
                                <img src="assets/images/icons/gas-station.svg" alt="">
                                <?php echo $cars[$i]['fuel'] ?>L
                            </span>
                            <span>
                                <img src="assets/images/icons/car.svg" alt="">
                                <?= $cars[$i]['transmission'] === 'automatic' ? 'Automaat' : 'Schakel' ?>
                            </span>
                            <span>
                                <img src="assets/images/icons/profile-2user.svg" alt="">
                                <?php echo $cars[$i]['seats'] ?> Personen
                            </span>
                        </div>

                        <div class="rent-details">
                            <span>
                                <span class="font-weight-bold">€<?php echo $cars[$i]['price'] ?>,00</span> / dag
                            </span>
                            <a href="/car-detail?id=<?php echo $cars[$i]['id'] ?>" class="button-primary">Bekijk nu</a>
                        </div>
                    </div>
                    <?php $i++; endfor; ?>
            </div>
        </section>
    </div>
</main>

<?php require "includes/footer.php" ?>