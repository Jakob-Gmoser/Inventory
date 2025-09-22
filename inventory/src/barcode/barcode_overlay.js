
const overlay = document.getElementById("barcode-overlay");

function openOverlay() {
    overlay.style.display = "flex";

    open_barcode_scanner();
}

function closeOverlay() {
    overlay.style.display = "none";

    Quagga.stop();
}

document.getElementById("open-scanner").addEventListener("click", openOverlay);
document.getElementById("close-overlay-btn").addEventListener("click", closeOverlay);

function open_barcode_scanner() {
    Quagga.init({
        inputStream: {
        name: "Live",
        type: "LiveStream",
        target: document.querySelector("#barcode-scanner-video"),
        constraints: {
            facingMode: "environment" 
        }
        },
        decoder: {
        readers: [
            "ean_reader",   
        ]
        },
        locate: true
    }, function(err) {
        if (err) {
        console.error(err);
        return;
        }
        Quagga.start();
        console.log("QuaggaJS started");
    });

    Quagga.onDetected(function(data) {
        const code = data.codeResult.code;

        console.log("Barcode:", code);

        document.getElementById("open-scanner").innerText = code + " - Neu Scannen";
        document.getElementById("barcode-hidden").value = code;

        closeOverlay();
    });
}
