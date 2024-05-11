<?php
// Include database connection file
include 'crud_operations.php';

// Check if user ID is set and numeric
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    // Get user ID from POST data
    $user_id = $_POST['id'];

    // Connect to the database
    $conn = connectDB();

    // Prepare SQL statement to fetch user data
    $sql = "SELECT * FROM users WHERE id = '$user_id'";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if query was successful
    if($result) {
        // Check if user exists
        if($result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();

            // Return user data as JSON
            echo json_encode($row);
        } else {
            // User not found
            echo "User not found.";
        }
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
?>
