
let product_id;

function open_delete_overlay(id) {
    document.getElementById("close-delete-product-overlay").addEventListener("click", closeOverlay);

    product_id = id.split("-")[2];

    document.getElementById("delete-product-overlay").style.display = "flex";

    document.getElementById("delete-product-name").innerText = document.getElementById("card-title-" + product_id).innerText;
}

function delete_product() {
    const formData = new FormData();

    formData.append("product_id", product_id);

    fetch(config.delete_products_api, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
}

function closeOverlay() {
    document.getElementById("delete-product-overlay").style.display = "none";
}
