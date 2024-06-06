 <?php
    header('Content-Type: application/json');
    
    if (isset($_GET['auction_id'])) {
        $auction_id = intval($_GET['auction_id']);  // Sanitize the input
    
        // Database connection (replace with your own connection details)
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "sneaker_auction";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
        }
    
        $sql = "SELECT auction_id, title, description, start_time, end_time, bid_count FROM auctions WHERE auction_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $auction_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $auction = $result->fetch_assoc();
            echo json_encode($auction);
        } else {
            echo json_encode(['error' => 'Auction not found']);
        }
    
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['error' => 'No auction ID provided']);
    }
    ?>