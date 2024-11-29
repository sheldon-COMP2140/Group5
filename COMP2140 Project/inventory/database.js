// database.js
const mysql = require('mysql2');
require('dotenv').config();  // Load environment variables

// Setup the database connection pool
const db = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
