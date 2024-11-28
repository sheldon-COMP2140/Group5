// server.js
const express = require('express');
const bodyParser = require('body-parser');
const db = require('./database');  // Import database connection
require('dotenv').config();  // Load environment variables

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use(express.static('public'));  // Serve static files (HTML, JS, CSS)

app.get('/inventory', (req, res) => {
  db.query('SELECT * FROM inventory', (err, results) => {
    if (err) {
      res.status(500).send('Error fetching inventory.');
    } else {
      res.json(results);
    }
  });
});

app.post('/inventory', (req, res) => {
  const { name, description, price, quantity, image_url } = req.body;
  const query = 'INSERT INTO inventory (name, description, price, quantity, image_url) VALUES (?, ?, ?, ?, ?)';
  db.query(query, [name, description, price, quantity, image_url || null], (err, results) => {
    if (err) {
      res.status(500).send('Error adding item.');
    } else {
      res.status(201).send('Item added successfully.');
    }
  });
});

app.put('/inventory/:id', (req, res) => {
  const id = req.params.id;
  const { name, description, price, quantity, image_url } = req.body;
  const query = 'UPDATE inventory SET name = ?, description = ?, price = ?, quantity = ?, image_url = ? WHERE id = ?';
  db.query(query, [name, description, price, quantity, image_url || null, id], (err, results) => {
    if (err) {
      res.status(500).send('Error updating item.');
    } else {
      res.send('Item updated successfully.');
    }
  });
});

app.delete('/inventory/:id', (req, res) => {
  const id = req.params.id;
  const query = 'DELETE FROM inventory WHERE id = ?';
  db.query(query, [id], (err, results) => {
    if (err) {
      res.status(500).send('Error deleting item.');
    } else {
      res.send('Item deleted successfully.');
    }
  });
});

app.post('/transaction', (req, res) => {
  const { product_id, action, quantity } = req.body;
  const query = 'INSERT INTO transactions (product_id, action, quantity) VALUES (?, ?, ?)';
  db.query(query, [product_id, action, quantity], (err, results) => {
    if (err) {
      res.status(500).send('Error logging transaction.');
    } else {
      res.send('Transaction logged successfully.');
    }
  });
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
