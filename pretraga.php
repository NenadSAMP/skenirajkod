<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretraga Artikala</title>
</head>
<body>
    <h2>Unesi ili skeniraj barkod</h2>
    <input type="text" id="barcodeInput" placeholder="Unesi barkod">
    <video id="video" width="300" height="200"></video>
    <button onclick="searchBarcode()">Pretraži</button>
    
    <h3>Pozicija artikla:</h3>
    <p id="position"></p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        function searchBarcode() {
            let barcode = document.getElementById("barcodeInput").value;
            if (barcode) {
                fetch("get_position.php?barkod=" + barcode)
                .then(response => response.text())
                .then(data => document.getElementById("position").innerHTML = data);
            }
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
            searchBarcode();
        });
    </script>
</body>
</html>
