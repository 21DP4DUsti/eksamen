<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sneaker_auction";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest auction entry
$sql = "SELECT * FROM auctions ORDER BY auction_id DESC LIMIT 1";
$result = $conn->query($sql);
$latest_auction = $result->fetch_assoc();

// Закрытие соединения
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Info</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="Brands.html">Brands</a></li>
                <li><a href="Contact.html">Contact</a></li>
                <li><a href="AboutUs.html">About Us</a></li>
            </ul>
        </nav>
        <h1>Auction Information</h1>
    </header>
    
    <section class="auction-details">
        <h2>Auction Details</h2>
        <table>
            <tr><td>Auction ID:</td><td id="auctionId"><?php echo htmlspecialchars($latest_auction['auction_id']); ?></td></tr>
            <tr><td>Title:</td><td id="auctionTitle"><?php echo htmlspecialchars($latest_auction['title']); ?></td></tr>
            <tr><td>Description:</td><td id="auctionDescription"><?php echo htmlspecialchars($latest_auction['description']); ?></td></tr>
            <tr><td>Start Time:</td><td id="auctionStartTime"><?php echo htmlspecialchars($latest_auction['start_time']); ?></td></tr>
            <tr><td>End Time:</td><td id="auctionEndTime"><?php echo htmlspecialchars($latest_auction['end_time']); ?></td></tr>
            <tr><td>Bid Count:</td><td id="auctionBidCount"><?php echo htmlspecialchars($latest_auction['bid_count']); ?></td></tr>
        </table>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>About Us</h3>
                <p>Sneaker Aukcion is the leading online auction platform for sneaker enthusiasts. Discover rare finds and bid on your favorite sneakers today.</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="Brands.html">Brands</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                    <li><a href="AboutUs.html">About Us</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
                    <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
                    <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Address: Martas-Rinkas1, Riga, Latvija</p>
                <p>Phone: +371 22303133</p>
                <p>Email: <a href="mailto:info@sneakerstore.com">info@sneakerstore.com</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Sneaker Store. All rights reserved.</p>
        </div>
    </footer>

    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
    }
    
    header {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
    }
    
    header nav ul {
        list-style: none;
        text-align: center;
    }
    
    header nav ul li {
        display: inline;
        margin: 0 15px;
    }
    
    header nav ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }
    
    header h1 {
        text-align: center;
        margin-top: 10px;
    }
    
    .auction-details {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .auction-details h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .auction-details table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .auction-details table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    
    footer {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        margin-top: 20px;
    }
    
    .footer-container {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        flex-wrap: wrap;
    }
    
    .footer-column {
        flex: 1;
        margin: 10px;
    }
    
    .footer-column h3 {
        margin-bottom: 10px;
    }
    
    .footer-column p,
    .footer-column ul,
    .footer-column .social-links {
        margin-bottom: 10px;
    }
    
    .footer-column ul {
        list-style: none;
        padding: 0;
    }
    
    .footer-column ul li {
        margin-bottom: 5px;
    }
    
    .footer-column ul li a {
        color: #fff;
        text-decoration: none;
    }
    
    .footer-column .social-links a {
        display: inline-block;
        margin-right: 10px;
    }
    
    .footer-column .social-links img {
        width: 24px;
        height: 24px;
    }
    
    .footer-bottom {
        text-align: center;
        margin-top: 20px;
    }
    
    .footer-bottom p {
        margin: 0;
    }
    </style>
</body>
</html>