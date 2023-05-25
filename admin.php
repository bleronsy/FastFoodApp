<!DOCTYPE html>
<html>
<head>
    <title>Add Food</title>
    <style>
        /* CSS styles */

        .add-food {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .add-food label {
            display: block;
            margin-bottom: 10px;
            color: #333333;
        }

        .add-food input[type="text"],
        .add-food textarea,
        .add-food select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .add-food input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .add-food input[type="submit"]:hover {
            background-color: #45a049;
        }

        .add-food textarea::placeholder,
        .add-food input::placeholder {
            color: #999999;
        }

        .add-food textarea:focus,
        .add-food input:focus {
            outline: none;
            border-color: #66afe9;
            box-shadow: 0 0 5px #66afe9;
        }

        .add-food .title {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        .add-food p.form-message {
            text-align: center;
            font-size: 14px;
            color: #333333;
        }
    </style>
</head>
<body>
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $foodName = isset($_POST["foodName"]) ? $_POST["foodName"] : "";
        $details = isset($_POST["details"]) ? $_POST["details"] : "";
        $price = isset($_POST["price"]) ? $_POST["price"] : "";
        $foodType = isset($_POST["foodType"]) ? $_POST["foodType"] : "";

        // Database credentials
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "fooddelivery";

        // Create a connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the query
        $sql = "INSERT INTO ushqimet (emri, detajet, cmimi, lloji) VALUES ('$foodName', '$details', '$price', '$foodType')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='form-message'>Food added successfully.</p>";
        } else {
            echo "<p class='form-message'>Error adding food: " . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <div class="add-food">
        <h2 class="title">Add Food</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="foodName">Emri i ushqimit:</label>
            <input type="text" id="foodName" name="foodName" required><br>

            <label for="details">Detajet:</label>
            <textarea id="details" name="details" placeholder="Shkruaj detajet e ushqimit" required></textarea><br>

            <label for="price">Çmimi:</label>
            <input type="number" id="price" name="price" step="0.01" required><br>

            <label for="foodType">Lloji:</label>
            <select id="foodType" name="foodType">
                <option value="Ofertë">Ofertë</option>
                <option value="Sandwich">Sandwich</option>
                <option value="Hamburger">Hamburger</option>
                <option value="Pizza">Pizza</option>
                <option value="Sallate">Sallate</option>
                <option value="Pije">Pije</option>
            </select><br>

            <input type="submit" value="Shto Ushqimin">
        </form>
    </div>
</body>
</html>
