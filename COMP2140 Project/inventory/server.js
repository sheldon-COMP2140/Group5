const express = require('express');
const bodyParser = require('body-parser');
const db = require('./database');  // Import database connection
require('dotenv').config();  // Load environment variables

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use(express.static('public'));  // Serve static files (HTML, JS, CSS)

// Fetch inventory
app.get('/inventory', (req, res) => {
  const query = 'SELECT InvID, Item, Colour, Grade, Price FROM Eagle.EagleInventory';
  db.query(query, (err, results) => {
    if (err) {
      res.status(500).send('Error fetching inventory.');
    } else {
      res.json(results);
    }
  });
});

// Add new item to inventory
app.post('/inventory', (req, res) => {
  const { Item, Colour, Grade, Price } = req.body;
  const query = 'INSERT INTO Eagle.EagleInventory (Item, Colour, Grade, Price) VALUES (?, ?, ?, ?)';
  db.query(query, [Item, Colour, Grade, Price], (err, results) => {
    if (err) {
      res.status(500).send('Error adding item.');
    } else {
      res.status(201).send('Item added successfully.');
    }
  });
});

// Update inventory item
app.put('/inventory/:InvID', (req, res) => {
  const InvID = req.params.InvID;
  const { Item, Colour, Grade, Price } = req.body;
  const query = 'UPDATE Eagle.EagleInventory SET Item = ?, Colour = ?, Grade = ?, Price = ? WHERE InvID = ?';
  db.query(query, [Item, Colour, Grade, Price, InvID], (err, results) => {
    if (err) {
      res.status(500).send('Error updating item.');
    } else {
      res.send('Item updated successfully.');
    }
  });
});

// Delete item from inventory
app.delete('/inventory/:InvID', (req, res) => {
  const InvID = req.params.InvID;
  const query = 'DELETE FROM Eagle.EagleInventory WHERE InvID = ?';
  db.query(query, [InvID], (err, results) => {
    if (err) {
      res.status(500).send('Error deleting item.');
    } else {
      res.send('Item deleted successfully.');
    }
  });
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
