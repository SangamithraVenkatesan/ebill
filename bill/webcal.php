<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMIL NADU ELECTRICITY BILL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>TAMIL NADU ELECTRICITY BILL</h1>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" required><br><br>

        <label for="id">USER ID:</label><br>
        <input type="text" name="id" id="id" required><br><br>

        <label for="area">Area:</label><br>
        <input type="text" name="area" id="area" required><br><br>

        <label for="unit">Units Consumed:</label><br>
        <input type="number" name="unit" id="unit" min="0" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize inputs
        $name = htmlspecialchars($_POST['name']);
        $id = htmlspecialchars($_POST['id']);
        $area = htmlspecialchars($_POST['area']);
        $unit = filter_var($_POST['unit'], FILTER_VALIDATE_INT); // Ensure valid integer

        // Check for valid unit input
        if ($unit === false || $unit < 0) {
            echo "<p style='color:red;'>Invalid input for units consumed. Please enter a non-negative number.</p>";
        } else {
            // Calculate the bill amount
            $amount = 0.0;

            if ($unit <= 100) {
                $amount = $unit * 0.00;
            } elseif ($unit <= 200) {
                $amount = 100 * 0.00 + ($unit - 100) * 2.35;
            } elseif ($unit <= 400) {
                $amount = 100 * 0.00 + 100 * 2.35 + ($unit - 200) * 4.70;
            } elseif ($unit <= 500) {
                $amount = 100 * 0.00 + 100 * 2.35 + 200 * 4.70 + ($unit - 400) * 6.30;
            } elseif ($unit <= 600) {
                $amount = 100 * 0.00 +300 * 4.70 + 100 * 6.30 + ($unit - 500) * 8.40;
            } elseif ($unit <= 800) {
                $amount = 100 * 0.00 + 300 * 4.70 + 100 * 6.30 + 100 * 8.40 + ($unit - 600) * 9.45;
            } elseif ($unit <= 1000) {
                $amount = 100 * 0.00 +300 * 4.70 + 100 * 6.30 + 100 * 8.40 + 200 * 9.45 + ($unit - 800) * 10.50;
            } else {
                $amount = 100 * 0.00 + 300 * 4.70 + 100 * 6.30 + 100 * 8.40 + 200 * 9.45 + 200 * 10.50 + ($unit - 1000) * 11.55;
            }

            // Display the bill
            echo "<h2>_____ELECTRICITY BILL_____</h2>";
            echo "NAME: " . htmlspecialchars($name) . "<br>";
            echo "USER ID: " . htmlspecialchars($id) . "<br>";
            echo "AREA: " . htmlspecialchars($area) . "<br>";
            echo "UNITS CONSUMED: " . htmlspecialchars($unit) . "<br>";
            echo "TOTAL AMOUNT: ₹" . number_format($amount, 2);
        }
    }
    ?>
</body>
</html>
