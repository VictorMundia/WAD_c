
<?php
function getUserById($conn, $userId) {
    try {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    } catch (Exception $e) {
        error_log("Error in getUserById: " . $e->getMessage());
        return null;
    }
}

function getFeaturedEvents($conn, $limit) {
    try {
        $sql = "SELECT * FROM events WHERE is_featured = 1 LIMIT ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Error in getFeaturedEvents: " . $e->getMessage());
        return [];
    }
}

function getUpcomingEvents($conn, $limit) {
    try {
        $sql = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Error in getUpcomingEvents: " . $e->getMessage());
        return [];
    }
}
?>