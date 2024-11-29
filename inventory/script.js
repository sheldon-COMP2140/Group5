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
          <td>${item.Item}</td>
          <td>${item.Colour}</td>
          <td>${item.Grade}</td>
          <td>${item.Price}</td>
          <td>
            <button onclick="openEditItemForm(${item.InvID})">Edit</button>
            <button onclick="removeItem(${item.InvID})">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    })
    .catch(error => console.error('Error loading inventory:', error));
}

function openAddItemForm() {
  document.getElementById("add-item-form").style.display = "block";
  // Clear the form inputs
  document.getElementById("item-name").value = '';
  document.getElementById("item-colour").value = '';
  document.getElementById("item-grade").value = '';
  document.getElementById("item-price").value = '';
  document.getElementById("item-id").value = ''; // Clear hidden item ID
}

function saveItem() {
  const name = document.getElementById("item-name").value;
  const colour = document.getElementById("item-colour").value;
  const grade = document.getElementById("item-grade").value;
  const price = document.getElementById("item-price").value;
  const id = document.getElementById("item-id").value;

  if (name && colour && grade && price) {
    const item = { Item: name, Colour: colour, Grade: grade, Price: price };
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
  const item = inventory.find(i => i.InvID === id);
  document.getElementById("add-item-form").style.display = "block";
  document.getElementById("item-name").value = item.Item;
  document.getElementById("item-colour").value = item.Colour;
  document.getElementById("item-grade").value = item.Grade;
  document.getElementById("item-price").value = item.Price;
  document.getElementById("item-id").value = item.InvID; // Set hidden field with item ID
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
