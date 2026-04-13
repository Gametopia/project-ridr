<?php require "includes/header.php" ?>

<?php
$carView = isset($_GET['id']);

$vehicleid = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
$stmt->execute([':id' => $vehicleid]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if ($carView) {
?>


    <main class="car-detail">
        <div class="grid">
            <div class="row">
                <div class="advertorial">
                    <h2>Altijd een auto die bij u past.</h2>
                    <p>Veiligheid en comfort terwijl je rijd in een futiristische en elante auto </p>
                    <img src="<?php echo $car['image'] ?>" alt="">
                    <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
                </div>
            </div>
            <div class="row white-background">
                <h2><?php echo $car['brand'] . ' ' . $car['name'] ?></h2>
                <div class="rating">
                    <span class="stars stars-4"></span>
                    <span>440+ reviewers</span>
                </div>
                <p><?php echo $car['description'] ?></p>
                <div class="car-type">
                    <div class="grid">
                        <div class="row"><span class="accent-color">Type Car</span><span><?php echo ucfirst($car['category']) ?></span></div>
                        <div class="row"><span class="accent-color">Capacity</span><span><?php echo $car['seats'] ?></span></div>
                    </div>
                    <div class="grid">
                        <div class="row"><span class="accent-color">Steering</span><span><?php echo ucfirst($car['transmission']) ?></span></div>
                        <div class="row"><span class="accent-color">Gasoline</span><span><?php echo $car['fuel'] ?>L</span></div>
                    </div>
                    <div class="call-to-action">
                        <div class="row"><span class="font-weight-bold">€<?php echo $car['price'] ?></span> / dag</div>
                        <div class="row"><a href="" class="button-primary">Huur nu</a></div>
                    </div>

                </div>
            </div>
        </div>
    </main>
<?php } else {
    header("Location: /ons-aanbod");
    die();
}; ?>

<?php require "includes/footer.php" ?>