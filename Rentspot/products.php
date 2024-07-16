<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <title>RENTSPOT</title>
</head>

<body>
    <div class="nav">
        <div class="logo">
            <h2>RENTSPOT</h2>
        </div>
        <form action="" method="get">
            <div class="search">
                <input type="text" name="search" id="search" placeholder="Search Here">
                <button>Search</button>
            </div>
        </form>
        
        <div class="user">
            <h3 style="color: #fff;">Account: <?php echo htmlspecialchars($_SESSION['email']); ?> </h3>
        </div>
    </div>

    <div class="title">
        <h2>Products</h2>
    </div>
    <table>
    <?php
    include "connection.php";
    $searchTerm = "";
    $searchCondition = "";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $searchCondition = "WHERE product_name LIKE '%$searchTerm%' OR category LIKE '%$searchTerm%'";
    }

    $sql = "SELECT * FROM products $searchCondition";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count % 6 == 0) {
                echo "<tr>";
            }
            echo "<td>
                    <div class='card'>
                        <div class='imgBx'>
                            <img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Product Image'>
                        </div>
                        <div class='contentBx'>
                            <h3>" . htmlspecialchars($row['product_name']) . "</h3>
                            <h2 class='price'>" . htmlspecialchars($row['amount']) . "</h2>
                            <a href='description.php?user_name=" . htmlspecialchars($row['user_name']) . "&email=" . htmlspecialchars($row['email']) . "&phone_number=" . htmlspecialchars($row['phone_number']) . "&product_name=" . htmlspecialchars($row['product_name']) . "&category=" . htmlspecialchars($row['category']) . "&from_date=" . htmlspecialchars($row['from_date']) . "&to_date=" . htmlspecialchars($row['to_date']) . "&amount=" . htmlspecialchars($row['amount']) . "&description=" . htmlspecialchars($row['description']) . "&image=" . htmlspecialchars($row['image']) . "' class='buy' style='margin-top:35px;'>Rent Now</a>
                        </div>
                    </div>
                  </td>";
            if ($count % 6 == 5 || $count == $result->num_rows - 1) {
                echo "</tr>";
            }
            $count++;
        }
    } else {
        echo "<tr><td colspan='6'>No results found</td></tr>";
    }
    $conn->close();
    ?>
    </table>    
</body>

</html>
