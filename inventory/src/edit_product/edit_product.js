
document.getElementById("product-image").addEventListener("change", function() {
  const file = this.files[0];
  if (file) {
    const imgPreview = document.getElementById("preview-edit");
    const imgURL = URL.createObjectURL(file);
    
    imgPreview.src = imgURL;
    imgPreview.style.display = "block";
      
    imgPreview.onload = () => {
        URL.revokeObjectURL(imgURL);
    };
  }
});

function edit_product(event, product_id) {
    event.preventDefault();

    product_name = document.getElementById("product-name").value;
    product_amount = document.getElementById("product-amount").value;
    product_price = document.getElementById("product-price").value;
    product_category = document.getElementById("product-category").value;
    barcode = document.getElementById("barcode-hidden").value;

    const formData = new FormData();

    formData.append("product_name", product_name);
    formData.append("product_amount", product_amount);
    formData.append("product_price", product_price);
    formData.append("product_category", product_category);
    formData.append("barcode", barcode);
    formData.append("product_id", product_id);

    const imageInput = document.getElementById("product-image");
    formData.append("img", imageInput.files[0]);

    fetch(config.update_products_api, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        window.location.href = "../inventory/inventory.php";
    })
    .catch(error => {
        console.error(error);
    });
}
