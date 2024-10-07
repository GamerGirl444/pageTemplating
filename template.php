<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1>Music Store</h1>
        <p>by kennedy claxton nodoubt</p>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="invoice.php">Order Form</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <?php if (isset($pageContents)): ?>
            <?php echo $pageContents; ?>
        <?php else: ?>
            <p>Error: Page content not found.</p>
        <?php endif; ?>
    </div>
    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; <?php echo date("Y"); ?> Music Store. All rights reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>