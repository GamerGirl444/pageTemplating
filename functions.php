<?php
function priceCalc($price, $quantity) {
    $discounts = [0, 0, 0.05, 0.1, 0.2, 0.25];
    $discountIndex = min($quantity - 1, 5);
    $discountPercentage = $discounts[$discountIndex];
    $discountedPrice = $price * (1 - $discountPercentage);
    $totalPrice = $discountedPrice * $quantity;
    return $totalPrice;
}
?>