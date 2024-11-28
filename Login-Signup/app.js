const express = require('express');
const bcrypt = require('bcryptjs');
const session = require('express-session');
const bodyParser = require('body-parser');
const db = require('./db');  // Import the MySQL connection

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(session({
    secret: 'secret_key',
    resave: false,
    saveUninitialized: true
}));

// Serve the sign-up and login pages
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

app.get('/login', (req, res) => {
    res.sendFile(__dirname + '/login.html');
});

app.get('/signup', (req, res) => {
    res.sendFile(__dirname + '/signup.html');
});
// Sign-up route
app.post('/signup', (req, res) => {
    const { Fname,Lname, DOB, Telephone, email, password} = req.body;
    const hashedPassword = bcrypt.hashSync(password, 10);

    // Check if the Fname already exists
    db.query('SELECT * FROM eagleaccount WHERE email = ?', [email], (err, result) => {
        if (err) {
            console.log(err);
            return res.status(500).send('Server error');
        }
        if (result.length > 0) {
            return res.status(400).send('User already exists');
        }

        // Insert new user into the database
        db.query('INSERT INTO eagleaccount (Fname, Lname , DOB, Telephone, email, Password) VALUES (?, ?, ?, ?, ?, ?)', [Fname, Lname, DOB, Telephone, email, hashedPassword], (err, result) => {
            if (err) {
                console.log(err);
                return res.status(500).send('Server error');
            }
            res.send('User created successfully');
        });
    });
});

// Login route
app.post('/login', (req, res) => {
    const { email1, password1 } = req.body;

    // Check if the eagleaccount exists
    db.query('SELECT * FROM eagleaccount WHERE email = ?', [email1], (err, result) => {
        if (err) {
            console.log(err);
            return res.status(500).send('Server error');
        }
        if (result.length === 0) {
            return res.status(400).send('User not found');
        }

        // Compare passwords
        const user = result[0];
        bcrypt.compare(password1, user.Password, (err, isMatch) => {
            if (err) {
                console.log(err);
                return res.status(500).send('Server error');
            }
            if (!isMatch) {
                return res.status(400).send('Incorrect password');
            }

            // Create session for the user
            req.session.userId = user.id;
            res.sendFile(__dirname + '/Home.html');
        });
    });
});

// Logout route
app.get('/logout', (req, res) => {
    req.session.destroy(() => {
        res.send('Logged out successfully');
    });
});

app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});

