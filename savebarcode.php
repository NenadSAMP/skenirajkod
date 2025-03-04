<?php
$pdo = new PDO("mysql:host=sql311.iceiy.com;dbname=icei_38439251_skenirajkod", "icei_38439251", "234432");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barkod = $_POST['barkod'];
    $poz1 = $_POST['pozicija1'] ?? null;
    $poz2 = $_POST['pozicija2'] ?? null;
    $poz3 = $_POST['pozicija3'] ?? null;

    $stmt = $pdo->prepare("INSERT INTO artikli (barkod, pozicija1, pozicija2, pozicija3) VALUES (?, ?, ?, ?)
                           ON DUPLICATE KEY UPDATE pozicija1 = VALUES(pozicija1), pozicija2 = VALUES(pozicija2), pozicija3 = VALUES(pozicija3)");
    $stmt->execute([$barkod, $poz1, $poz2, $poz3]);
    echo "Artikal sačuvan!";
}
?>
