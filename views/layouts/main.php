<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Lightning Pay' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
    <!-- QR Code Library -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
</head>
<body class="<?= isset($isAdmin) && $isAdmin ? 'admin-body' : '' ?>">
    <?php if (isset($isAdmin) && $isAdmin): ?>
        <?= $content ?>
    <?php else: ?>
        <div class="app-container">
            <!-- Glow effects for premium feel -->
            <div class="glow glow-1"></div>
            <div class="glow glow-2"></div>
            
            <?= $content ?>
        </div>
    <?php endif; ?>
</body>
</html>
