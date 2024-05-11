<?php
// Include database connection file
include 'crud_operations.php';

// Check if user ID is set and numeric
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    // Get user ID from POST data
    $user_id = $_POST['id'];

    // Connect to the database
    $conn = connectDB();

    // Prepare SQL statement to delete user
    $sql = "DELETE FROM users WHERE id = '$user_id'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // User deleted successfully
        echo "User deleted successfully.";
    } else {
        // Error in query execution
        echo "Error: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // Invalid user ID
    echo "Invalid user ID.";
}

