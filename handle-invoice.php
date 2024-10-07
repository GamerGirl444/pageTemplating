<?php
include 'functions.php';
$pageTitle = "Order Summary";
ob_start();

$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$heading = "Cost by Quantity";
$albums = [
    'The Beatles' => 'The White Album',
    'Pink Floyd' => 'The Dark Side of the Moon',
    'AC/DC' => 'Back in Black',
    'Michael Jackson' => 'Thriller',
    'Fleetwood Mac' => 'Rumours',
    'Eagles' => 'Hotel California',
    'Bee Gees' => 'Saturday Night Fever',
    'Nirvana' => 'Nevermind',
    'Bruce Springsteen' => 'Born in the U.S.A.',
    'Prince' => 'Purple Rain',
    'Dire Straits' => 'Brothers in Arms'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requiredFields = ['name', 'album', 'quantity', 'format'];
    $error = '';
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $error = "All fields are required.";
            break;
        }
    }
    if (empty($error)) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $album = filter_input(INPUT_POST, 'album', FILTER_SANITIZE_STRING);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        $media = filter_input(INPUT_POST, 'format', FILTER_SANITIZE_STRING);
        if (!array_key_exists($album, $albums)) {
            $error = "Invalid album selection.";
        } elseif ($quantity === false || $quantity < 1) {
            $error = "Invalid quantity.";
        } elseif (!in_array($media, ['CD', 'Download'])) {
            $error = "Invalid format selection.";
        } else {
            $selectedAlbum = $albums[$album];
        }
    }
}
?>
<h1>Order Summary</h1>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php elseif (isset($name, $album, $quantity, $media, $selectedAlbum)): ?>
    <p>Thank you for your order, <?php echo htmlspecialchars($name); ?>!</p>
    <p>You've selected: <?php echo htmlspecialchars("$album - $selectedAlbum"); ?></p>
    <p>Format: <?php echo htmlspecialchars($media); ?></p>
    
    <h2><?php echo htmlspecialchars($heading); ?></h2>
    
    <?php
    $totalCost = 0;
    $basePrice = ($media == "CD") ? $cdPrice : $downloadPrice;
    for ($i = 1; $i <= $quantity; $i++) {
        $cost = priceCalc($basePrice, $i);
        $itemType = ($media == "CD") ? "CD" : "Download";
        echo "<p>" . $i . " " . $itemType . ($i > 1 ? "s" : "") . ": $" . number_format($cost, 2) . "</p>";
    }
    $totalCost = priceCalc($basePrice, $quantity);
    
    if ($media == "CD") {
        $totalCost += $shipping;
        echo "<p>Shipping: $" . number_format($shipping, 2) . "</p>";
    }
    
    echo "<h3>Total Cost: $" . number_format($totalCost, 2) . "</h3>";
    ?>
    
    <a href="invoice.php" class="btn btn-primary mt-3">Place Another Order</a>
<?php else: ?>
    <p>No order information available.</p>
<?php endif; ?>
<?php
$pageContents = ob_get_clean();
include 'template.php';
?>