<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Artikal</title>
</head>
<body>
    <h2>Dodaj novi artikal</h2>
    <input type="text" id="barcodeInput" placeholder="Unesi barkod">
    <video id="video" width="300" height="200"></video>
    
    <input type="text" id="position1" placeholder="Pozicija 1">
    <input type="text" id="position2" placeholder="Pozicija 2">
    <input type="text" id="position3" placeholder="Pozicija 3">
    
    <button onclick="saveBarcode()">Sačuvaj</button>

    <p id="status"></p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        function saveBarcode() {
            let barcode = document.getElementById("barcodeInput").value;
            let pos1 = document.getElementById("position1").value;
            let pos2 = document.getElementById("position2").value;
            let pos3 = document.getElementById("position3").value;

            fetch("save_barcode.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `barkod=${barcode}&pozicija1=${pos1}&pozicija2=${pos2}&pozicija3=${pos3}`
            })
            .then(response => response.text())
            .then(data => document.getElementById("status").innerHTML = data);
        }

        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#video"),
            },
            decoder: { readers: ["ean_reader", "code_128_reader"] }
        }, function(err) {
            if (err) { console.error(err); return; }
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            document.getElementById("barcodeInput").value = result.codeResult.code;
            Quagga.stop();
        });
    </script>
</body>
</html>
