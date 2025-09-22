
function get_products() {
    fetch(config.get_products_api)
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            add_inventory_product_cards(data);
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
}

function add_inventory_product_cards(products) {
    fetch("../product_cards/product_card.html")
        .then(response => response.text())
        .then(template => {
            for (i=0;i<products.length;i++) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(template, "text/html");
                
                const card = doc.querySelector(".card");
                card.id = "product-card-" + products[i].ID;

                card.querySelector("#delete-button").id = "delete-button-" + products[i].ID;
                card.querySelector("#edit-button").id = "edit-button-" + products[i].ID;
                
                card.querySelector(".card-title").textContent = products[i].productname;
                card.querySelector(".card-title").id = "card-title-" + products[i].ID;

                card.querySelector("#amount").textContent = products[i].amount;
                card.querySelector("#amount").id = "amount-" + products[i].ID;

                card.querySelector("#price").textContent = products[i].price;
                card.querySelector("#price").id = "price-" + products[i].ID;

                card.querySelector("#category").textContent = products[i].category;
                card.querySelector("#category").id = "category-" + products[i].ID;

                card.querySelector("#barcode").dataset.barcode = products[i].barcode;
                card.querySelector("#barcode").id = "barcode-" + products[i].ID;
                
                let img_path = products[i].img_path

                if (img_path == "") {
                    img_path = "../icons/icon.png";
                }

                card.querySelector("#product-img").src = img_path;
                card.querySelector("#product-img").id = "product-img-" + products[i].ID;

                document.getElementById("inventory-products").appendChild(card);
            }
        }
    )
    .catch(err => console.error("Failed to load the template:", err));
}

addEventListener("DOMContentLoaded", () => { 
    get_products();
})

function edit_product_redirect(id) {
    product_id = id.split("-")[2];

    product_name = document.getElementById("card-title-" + product_id).innerText;
    product_amount = document.getElementById("amount-" + product_id).innerText;
    product_price = document.getElementById("price-" + product_id).innerText;
    product_category = document.getElementById("category-" + product_id).innerText;
    barcode = document.getElementById("barcode-" + product_id).dataset.barcode;
    img_path = document.getElementById("product-img-" + product_id).src;

    window.location.href = `../edit_product/edit_product.php?product_name=${product_name}&product_amount=${product_amount}&product_price=${product_price}&product_category=${product_category}&
    barcode=${barcode}&img_path=${img_path}&product_id=${product_id}`;
}
