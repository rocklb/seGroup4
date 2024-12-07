// Import required modules
const express = require('express');
const { createClient } = require('@supabase/supabase-js');

const cors = require('cors');

// Initialize Express app
const app = express();

// Middleware to parse JSON requests
app.use(cors());
app.use(express.json());

// Supabase setup
const SUPABASE_URL = 'https://mktewrgkuekhwtnwsgwq.supabase.co';
const SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im1rdGV3cmdrdWVraHd0bndzZ3dxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzMzMzEwMjAsImV4cCI6MjA0ODkwNzAyMH0.YC8tpl2P9P2EftqU3dGXHmDpUBTG0FZHK7K2PZ4qoKU'; 
const supabase = createClient(SUPABASE_URL, SUPABASE_KEY);

//default route to confirm sever is running
app.get('/', (req, res) => {
    res.send('Server is live');
});



// Registration route
app.post('/register', async (req, res) => {
    const { username, email, password } = req.body;

    // Log incoming data
    console.log('Request data:', {username, email, password});

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
            // Handle duplicate username or email error
            if (error.code === '23505') {
                return res.status(400).send('Username or email already exists.');
            }

            // Throw other unexpected errors
            throw error; 
        }

        // Return success response
        res.status(201).send('Registration successful!');

    } catch (err) {
        console.error('Error during registration:', err);
        res.status(500).send('An error occurred during registration.');
    }
});


// set the port to render 
const PORT = process.env.PORT || 3000;

// start sever 
app.listen(PORT, () => {
    console.log('Sever is running on port ${PORT{}');
});



