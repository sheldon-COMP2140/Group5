const mysql = require('mysql2');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',     // MySQL username
    password: 'Admit1@j',     // MySQL password
    database: 'eagle'
});

connection.connect((err) => {
    if (err) {
        console.error('error connecting to the database: ' + err.stack);
        return;
    }
    console.log('connected to the database');
});

module.exports = connection;
