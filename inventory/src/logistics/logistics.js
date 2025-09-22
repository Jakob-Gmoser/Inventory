
const products = [];

get_products();

function get_products() {
    fetch(config.get_products_api)
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            for (i=0;i<data.length;i++) {
                products.push({
                    id: data[i].ID,
                    name: data[i].productname,
                    img: (data[i].img_path != "") ? (data[i].img_path) : "../icons/icon.png",
                    amount: data[i].amount
                });
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
}

const input = document.getElementById("search-product");
const suggestions = document.getElementById("suggestions");
const confirmBtn = document.getElementById("confirm-btn");

input.addEventListener("input", () => {
  const value = input.value.trim().toLowerCase();

  if (!value) {
    suggestions.style.display = "none";
    suggestions.innerHTML = "";
    confirmBtn.disabled = true;
    return;
  }

  const filtered = products.filter(p => p.name.toLowerCase().includes(value));

  if (filtered.length === 0) {
    suggestions.style.display = "none";
    suggestions.innerHTML = "";
    confirmBtn.disabled = true;
    return;
  }

  suggestions.innerHTML = filtered.map(item => {
    return `
      <li class="list-group-item list-group-item-action d-flex align-items-center" 
          style="cursor:pointer;" 
          data-productid="${item.id}">
        <img src="${item.img}" alt="${item.name}" style="width: 40px; height: 40px; object-fit: contain; margin-right: 1rem; border-radius: 4px;">
        <div style="flex-grow: 1;">${item.name}</div>
        <span class="badge bg-secondary">${item.amount} Stück</span>
      </li>
    `;
  }).join("");
  suggestions.style.display = "block";

  const exactMatch = products.some(p => p.name.toLowerCase() === value);
  confirmBtn.disabled = !exactMatch;
});

suggestions.addEventListener("click", e => {
  const li = e.target.closest("li");
  if (li) {
    const productId = li.getAttribute("data-productid");
    const amount = parseInt(li.dataset.amount);
    const selected = li.querySelector("div").textContent;
    console.log("Ausgewählte Produkt-ID:", productId);
    input.value = selected;
    suggestions.style.display = "none";
    suggestions.innerHTML = "";
    confirmBtn.disabled = false;
  }
});

input.addEventListener("blur", () => {
  setTimeout(() => suggestions.style.display = "none", 150);
});

function getSelectedProduct() {
    const name = input.value.trim().toLowerCase();
    return products.find(p => p.name.toLowerCase() === name) || null;
}

function logistics_btn_pressed(event) {
    event.preventDefault();

    const formData = new FormData();

    const product = getSelectedProduct();

    product_amount = product.amount;
    product_name = product.name;
    amount = document.getElementById("quantity").value;
    logistic_name = document.getElementById("logistics-name").value;
    logistics = document.getElementById("action-type").selectedIndex - 1;
    product_id = product.id;

    formData.append("product_amount", product_amount);
    formData.append("product_name", product_name);
    formData.append("amount", amount);
    formData.append("logistic_name", logistic_name);
    formData.append("logistics", logistics);
    formData.append("product_id", product_id);

    fetch(config.logistics_api, {
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

function format_date(isoDate) {
    const [year, month, day] = isoDate.split("-");
    return `${day}.${month}.${year}`;
}

function get_action(action) {
    if (action == 0) {
        return "Einlagern";
    }
    return "Auslagern";
}

addEventListener("DOMContentLoaded", () => { 
    const logistic_history = document.querySelector("#logistic-history ul");

    fetch(config.get_history_api)
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            for (i=0;i<data.length;i++) {
                const history_item = document.createElement("li");
                history_item.className = "list-group-item";
                history_item.textContent = `${format_date(data[i].date)} - ${data[i].logistic_name} - ${data[i].product_name} - 
                                            ${get_action(data[i].action)} - ${data[i].amount} Stück`;

                logistic_history.prepend(history_item);
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
})
