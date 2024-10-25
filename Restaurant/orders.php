<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any dishes were selected
    if (isset($_POST['dishes'])) {
        $selectedDishes = $_POST['dishes'];
    } else {
        $selectedDishes = [];
    }
} else {
    // Redirect back to the menu if accessed directly
    header("Location: index.html"); // Replace with your menu page URL
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background: #35424a;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        .order-list {
            list-style-type: none;
            padding: 0;
        }
        .order-list li {
            background: #ffffff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
        }
        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #35424a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .back-button:hover {
            background: #2c3e50;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your Order</h1>
    </header>

    <main>
        <h2>Selected Dishes</h2>
        <ul class="order-list">
            <?php
            $total = 0;
            // Display selected dishes
            foreach ($selectedDishes as $dish) {
                echo "<li>" . htmlspecialchars($dish) . "</li>";
                // Extract the price from the dish string
                $price = floatval(preg_replace('/[^\d.]/', '', $dish)); // Extract number
                $total += $price; // Add to total
            }
            ?>
        </ul>

        <div class="total">
            Total: $<?php echo number_format($total, 2); ?>
        </div>

        <a href="index.html" class="back-button">Back to Menu</a>
    </main