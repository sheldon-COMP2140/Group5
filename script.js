// public/script.js
let inventory = [];

function loadInventory() {
  fetch('/inventory')
    .then(response => response.json())
    .then(data => {
      inventory = data;
      const tableBody = document.querySelector("#inventory-table tbody");
      tableBody.innerHTML = ''; // Clear existing table rows

      inventory.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${item.name}</td>
          <td>${item.description}</td>
          <td>${item.price}</td>
          <td>${item.quantity}</td>
          <td>
            <button onclick="openEditItemForm(${item.id})">Edit</button>
            <button onclick="removeItem(${item.id})">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    })
    .catch(error => console.error('Error loading inventory:', error));
}

function openAddItemForm() {
  document.getElementById("add-item-form").style.display = "block";
  document.getElementById("item-name").value = '';
  document.getElementById("item-description").value = '';
  document.getElementById("item-price").value = '';
  document.getElementById("item-quantity").value = '';
  document.getElementById("item-id").value = ''; // Clear hidden item ID
}

function saveItem() {
  const name = document.getElementById("item-name").value;
  const description = document.getElementById("item-description").value;
  const price = document.getElementById("item-price").value;
  const quantity = document.getElementById("item-quantity").value;
  const id = document.getElementById("item-id").value;

  if (name && price && quantity) {
    const item = { name, description, price, quantity };
    const url = id ? `/inventory/${id}` : '/inventory';

    fetch(url, {
      method: id ? 'PUT' : 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(item),
    })
      .then(response => response.json())
      .then(() => {
        loadInventory();
        cancelAddItem();
      })
      .catch(error => console.error('Error saving item:', error));
  } else {
    alert('Please fill out all compulsory fields.');
  }
}

function cancelAddItem() {
  document.getElementById("add-item-form").style.display = "none";
}

function openEditItemForm(id) {
  const item = inventory.find(i => i.id === id);
  document.getElementById("add-item-form").style.display = "block";
  document.getElementById("item-name").value = item.name;
  document.getElementById("item-description").value = item.description;
  document.getElementById("item-price").value = item.price;
  document.getElementById("item-quantity").value = item.quantity;
  document.getElementById("item-id").value = item.id; // Set hidden field with item ID
}

function removeItem(id) {
  const confirmed = confirm('Are you sure you want to delete this item?');
  if (confirmed) {
    fetch(`/inventory/${id}`, {
      method: 'DELETE',
    })
    .then(() => {
      loadInventory();  // Refresh inventory list after deletion
    })
    .catch(error => console.error('Error deleting item:', error));
  }
}
