<?php
$pageTitle = "Invoice";
ob_start();

$albums = [
    'The Beatles' => 'The White Album',
    'Pink Floyd' => 'The Dark Side of the Moon',
    'AC/DC' => 'Back in Black',
    'Michael Jackson' => 'Thriller',
    'Fleetwood Mac' => 'Rumours',
    'Bee Gees' => 'Saturday Night Fever',
    'Eagles' => 'Hotel California',
    'Led Zeppelin' => 'Led Zeppelin IV',
    'Nirvana' => 'Nevermind',
    'Queen' => 'A Night at the Opera',
    'Adele' => '21'
];
?>
<h2>Album Order Form</h2>
<form action="handle-invoice.php" method="post">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="album">Album:</label>
        <select class="form-control" id="album" name="album" required>
            <?php
            foreach ($albums as $artist => $album) {
                echo "<option value=\"" . htmlspecialchars($artist) . "\">" . htmlspecialchars("$artist - $album") . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
    </div>
    <div class="form-group">
        <label for="format">Format:</label>
        <select class="form-control" id="format" name="format" required>
            <option value="CD">CD</option>
            <option value="Download">Download</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit Order</button>
</form>
<h3>Available Albums:</h3>
<ul>
    <?php
    foreach ($albums as $artist => $album) {
        echo "<li>" . htmlspecialchars("$artist - $album") . "</li>";
    }
    ?>
</ul>
<?php
$pageContents = ob_get_clean();
include 'template.php';
?>

