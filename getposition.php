<?php
$pdo = new PDO("mysql:host=sql311.iceiy.com;dbname=icei_38439251_skenirajkod", "icei_38439251", "234432");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['barkod'])) {
    $barkod = $_GET['barkod'];
    $stmt = $pdo->prepare("SELECT pozicija1, pozicija2, pozicija3 FROM artikli WHERE barkod = ?");
    $stmt->execute([$barkod]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo implode(", ", array_filter($result)); // Prikazuje samo popunjene pozicije
    } else {
        echo "Artikal nije pronađen!";
    }
}
?>
