<?php
include "connection.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Get and sanitize the product_id from the GET request
$product_id = intval($_GET['product_id']);  // Using intval to sanitize

// Prepare the SQL statements
$sql = "DELETE FROM userselling WHERE product_id = ?";
$sql1 = "DELETE FROM products WHERE product_id = ?";

// Execute the first DELETE statement
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        // Execute the second DELETE statement
        if ($stmt1 = $conn->prepare($sql1)) {
            $stmt1->bind_param("i", $product_id);
            if ($stmt1->execute()) {
                echo "<script>alert('Record deleted successfully');</script>";
                header('Location: home.php');
                exit();
            } else {
                echo "Error: " . $stmt1->error;
            }
            $stmt1->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
