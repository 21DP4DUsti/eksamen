<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sneaker_auction";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['seller_id'])) {
    $seller_id = intval($_GET['seller_id']);
    $sql = "SELECT seller_id, first_name, last_name, email, reputation, verification_info FROM sellers WHERE seller_id = $seller_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'seller_id' => $row['seller_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'reputation' => $row['reputation'],
            'verification_info' => $row['verification_info']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Seller not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>