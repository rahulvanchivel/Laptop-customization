<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "wt";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['calc'])) {
    $os = $_POST["os"];
    $processor = $_POST["processor"];
    $graphicsCard = $_POST["graphics-card"];
    $ram = $_POST["ram"];
    $storage = $_POST["storage"];
    $colour = $_POST["colour"];
    $displaySize = $_POST["ds"];
    $displayType = $_POST["dt"];
    $battery = $_POST["battery"];
    $wifi = $_POST["wifi"];

    $totalPrice = calculateTotalPrice($os,$processor, $graphicsCard, $ram, $storage,$colour,$displaySize,$displayType,$battery,$wifi);

    

    $sql = "INSERT INTO laptop_options (os, processor,graphics_card, ram, storagee, colour, display_size, display_type, battery, wifi, total_price)
            VALUES ('$os', '$processor','$graphicsCard', '$ram', '$storage', '$colour', '$displaySize', '$displayType', '$battery', '$wifi', '$totalPrice')";

    if ($conn->query($sql) === TRUE) {
        $output = "<html>
                    <head>
                        <title>Total Price</title>
                        <style>
                            body {
                                background-color: #8400d5;
                                color: #333333;
                            }
                            h2 {
                                text-align: center;
                                color: #ffffff;
                                font-size: 44px;
                            }
                        </style>
                    </head>
                    <body>
                        <h2>Total Price: $totalPrice</h2>
                    </body>
                </html>";
    
    $filename = "output.html";
    file_put_contents($filename, $output);
    header ("Location:./output.html");

    echo "<center><h2>Total Price: $totalPrice</h2></center>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function calculateTotalPrice($os,$processor, $graphicsCard, $ram, $storage,$colour,$displaySize,$displayType,$battery,$wifi) {
    $osprices = array(
        "windows" => 10000,
        "linux" => 100
    );
    
    $processorPrices = array(
        "i310" => 20000,
        "i510" => 30000,
        "i710" => 40000,
        "i910" => 50000,
        "i311" => 25000,
        "i511" => 35000,
        "i711" => 45000,
        "i911" => 55000,
        "i312" => 27500,
        "i512" => 37500,
        "i712" => 47500,
        "i912" => 57500,
        "i313" => 30000,
        "i513" => 40000,
        "i713" => 50000,
        "i913" => 60000,
        "r75g" => 35000,
        "r75x" => 45001,
        "r75hs" => 55000,
        "r7h" => 6500,
        "r7hx" => 7500,
        "r75h" => 8500,
        "r75x" => 9500,
        "r95x" => 9000,
        "r950x" => 10000,
        "r95hx" => 11000,
        "r95h" => 12000,
        "r95hs" => 13000,
        "r950hx" => 14000,
        "r96xt" => 15000
    );
    

    $graphicsCardPrices = array(
        "gr38" => 8000,
        "gr37" => 6000,
        "gr36" => 4000,
        "gr35" => 3000,
        "gr35ti" => 3500,
        "gr37ti" => 7000,
        "gr38ti" => 9000,
        "arr68s" => 5000,
        "arr67s" => 4000,
        "irxg" => 2000
    );    

    $ramPrices = array(
        "4gb" => 5000,
        "8gb" => 10000,
        "16gb" => 20000,
        "32gb" => 40000
    );
    

    $storagePrices = array(
        "512gb-ssd" => 5500,
        "1tb-ssd" => 7250,
        "2tb-ssd" => 14400,
        "4tb-ssd" => 18800
    );
    
    $colourPrices = array(
        "white" => 700,
        "black" => 500,
        "blue"  => 900,
        "silver"=> 1100,
        "yellow"=> 1250,
        "pink"  => 1050,
        "violet"=> 985,
        "green" => 1150,
        "gold"  => 1800,
        "red"   => 1300,
        "gray"  => 550,
        "orange"=> 1350,
        "brown" => 930,
    );
    $displaySizeprices = array(
        "13" => 7000,
        "14" => 8000,
        "16" => 9000,
        "17.3" => 11000,
        "18" => 12500
    );
    $displayTypeprices = array(
        "60hz" => 2000,
        "120hz" => 3500,
        "144hz" => 4000,
        "165hz" => 4500,
        "240hz" => 6000,
        "300hz" => 7000,
        "360hz" => 8000,
        "WQHD" => 9000,
        "FHD+" => 10000,
        "UHD+" => 12000,
        "UHD+/FHD+" => 15000
    );
    $batteryprices = array(
        "48wh" => 1000,
        "60wh" => 1500,
        "66wh" => 1800,
        "76wh" => 2000,
        "90wh" => 2500
    );
    $wifiprices = array(
        "wifi5" => 8000,
        "wifi6" => 12000
    );
    

    $totalPrice = $osprices[$os] + $processorPrices[$processor] + $graphicsCardPrices[$graphicsCard] + $ramPrices[$ram] + $storagePrices[$storage] + $colourPrices[$colour] + $displaySizeprices[$displaySize] + $displayTypeprices[$displayType] + $batteryprices[$battery] + $wifiprices[$wifi];
    return $totalPrice;
}
?>