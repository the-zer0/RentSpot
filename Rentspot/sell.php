<?php
session_start();
include "connection.php";

if (isset($_POST['submit']) && isset($_FILES['screenshot'])) {
    $user_name = $_POST['user_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $category = $_POST['category'] ?? '';
    $from_date = $_POST['from_date'] ?? '';
    $to_date = $_POST['to_date'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $description = $_POST['description'] ?? '';

    // Check if description is set
    if (empty($description)) {
        echo "<script>alert('Description cannot be empty.');</script>";
        exit();
    }

    $img_name = $_FILES['screenshot']['name'];
    $img_size = $_FILES['screenshot']['size'];
    $tmp_name = $_FILES['screenshot']['tmp_name'];
    $error = $_FILES['screenshot']['error'];

    // Generate a 6-digit unique number
    $digits = range(0, 9);
    shuffle($digits);
    $randomNumberArray = array_slice($digits, 0, 6);
    $randomNumber = implode('', $randomNumberArray);
    $uniqueNumber = $randomNumber;

    if ($error === 0) {
        if ($img_size > 125000) { // Adjusted file size to 125 KB for example
            $em = "Sorry, your file is too large.";
            echo $em;
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "INSERT INTO products (user_name, email, phone_number, product_id, product_name, category, from_date, to_date, amount, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $sql1 = "INSERT INTO userselling (user_name, email, phone_number, product_id, product_name, category, from_date, to_date, amount, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                // Debugging: Check values before binding
                echo "user_name: $user_name, email: $email, phone_number: $phone_number, uniqueNumber: $uniqueNumber, product_name: $product_name, category: $category, from_date: $from_date, to_date: $to_date, amount: $amount, description: $description, new_img_name: $new_img_name";
                
                $stmt = $conn->prepare($sql);
                $stmt1 = $conn->prepare($sql1);
                $stmt->bind_param("sssssssssss", $user_name, $email, $phone_number, $uniqueNumber, $product_name, $category, $from_date, $to_date, $amount, $description, $new_img_name);
                $stmt1->bind_param("sssssssssss", $user_name, $email, $phone_number, $uniqueNumber, $product_name, $category, $from_date, $to_date, $amount, $description, $new_img_name);

                if ($stmt->execute() && $stmt1->execute()) {
                    echo "<script>alert('Record inserted successfully');</script>";
                    header('Location: home.php');
                } else {
                    echo "Error: " . $stmt->error;
                    echo "Error: " . $stmt1->error;
                }
                $stmt->close();
                $stmt1->close();
            } else {
                $em = "You can't upload files of this type";
                echo $em;
            }
        }
    } else {
        $em = "Unknown error occurred!";
        echo $em;
    }
} else {
    echo "Form not submitted properly.";
}
?>
