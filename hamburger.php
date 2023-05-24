
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- <nav>
            <img src="./images/hamburger.png" alt="app-logo">
            <h1>Fast Food App</h1>
        </nav> -->
        <div class="bigCnt bigCntHeader">
            <div class="logo"></div> 
           
            <div class="miniCartTotal">0.00€</div>
           <div class="alertProductAddToCart">
           Shporta
            </div>
       </div>
    </header>
    <main>
        <div class="pjesaKryesoreListaDheUshqimet">
        <ul class="lista_e_ushqimeve">
            <li><a href="./Oferta.php">Oferta</a></li>
            <li><a href="./sandwich.php">Sandwich-a</a></li>
            <li><a href="./hamburger.php">Hamburgera</a></li>
            <li><a href="./pizza.php">Pizza</a></li>
            <li><a href="./sallata.php">Sallata</a></li>
            <li><a href="./pije.php">Pije</a></li>
            <li><a href="./kycu.php">Kyçu</a></li>
            <li><a href="./regjistrohu.php">Regjistrohu</a></li>
        </ul>

        <div class="gjithaUshqimet">
            <?php
                $host = 'localhost';
                $dbname = 'fooddelivery';
                $username = 'root';
                $password = '';

                try {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT emri, detajet, cmimi, imazhi FROM oferta";
                    $stmt = $conn->query($query);
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    //data to be displayed
                    if ($stmt->rowCount() > 0) {
                        foreach ($result as $row) {
                            echo "<div class='ushqimi'>";
                            echo "<div class='emri'>".$row['emri']."</div>";
                            echo "<div class='detajet'>".$row['detajet']."</div>";
                            echo "<div class='cmimi'>".$row['cmimi']."</div>";
                            echo "<div class='imazhi'><img src='".$row['imazhi']."' alt='' /></div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No records found.";
                    }
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            ?>
        </div>
        </div>

    </main>
</body>
</html>



