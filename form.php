<?php

// Check if isset first_name and last_name
if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
    // Check if first and last name have a value
    if (!empty(trim($_POST['first_name'])) && !empty($_POST['last_name'])) {
        // Echo success message and concat first and last name
        echo json_encode([
            'success' => true,
            'message' => $_POST['first_name'] . ' ' . $_POST['last_name'],
        ]);

        return;
    }
}

echo json_encode([
    'success' => false,
    'message' => 'Please enter a first and a last name',
]);
