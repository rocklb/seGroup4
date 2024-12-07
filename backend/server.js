// Import required modules
const express = require('express');
const { createClient } = require('@supabase/supabase-js');
const cors = require('cors');
const path = require('path');

// Initialize Express app
const app = express();

// Middleware to parse JSON requests
app.use(cors());
app.use(express.json());

// Serve static files from the 'Code' folder
app.use(express.static(path.join(__dirname, '../Code')));

// Supabase setup
const SUPABASE_URL = 'https://mktewrgkuekhwtnwsgwq.supabase.co';
const SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im1rdGV3cmdrdWVraHd0bndzZ3dxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzMzMzEwMjAsImV4cCI6MjA0ODkwNzAyMH0.YC8tpl2P9P2EftqU3dGXHmDpUBTG0FZHK7K2PZ4qoKU';
const supabase = createClient(SUPABASE_URL, SUPABASE_KEY);

// Serve the main HTML file for the default route
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, '../Code/index.html'));
});

// Registration route
app.post('/register', async (req, res) => {
    const { username, email, password } = req.body;

    // Validate input
    if (!username || !email || !password) {
        return res.status(400).send('All fields are required.');
    }

    try {
        // Insert user into the Supabase 'users' table
        const { data, error } = await supabase
            .from('users')
            .insert([{ username, email, password }]);

        if (error) {
            return res.status(400).send(error.message);
        }

        res.status(201).send('Registration successful!');
    } catch (err) {
        console.error('Error during registration:', err);
        res.status(500).send('An error occurred during registration.');
    }
});

// Set the port
const PORT = process.env.PORT || 3000;

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
