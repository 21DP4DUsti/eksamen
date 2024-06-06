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

$response = array('success' => false, 'error' => 'Unknown error');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных о аукционе из формы
    $sneaker_id = $_POST['auction_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $bid_count = $_POST['bid_count'];

    // Подготовка SQL запроса
    $sql = "INSERT INTO auctions (auction_id, title, description, start_time, end_time, bid_count) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Подготовка и выполнение запроса
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $auction_id, $title, $description, $start_time, $end_time, $bid_count);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'error' => 'Error adding auction: ' . $conn->error);
    }

    // Закрытие запроса
    $stmt->close();
}

// Закрытие соединения
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>