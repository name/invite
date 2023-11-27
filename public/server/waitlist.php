<?php

function addWaitlistEntry($username) {
    global $pdo;

    // Function to check if username exists in the waitlist
    function isUsernameExists($pdo, $username) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM waitlist WHERE x_username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    // Function to insert a new username into the waitlist
    function insertUsername($pdo, $username) {
        $stmt = $pdo->prepare("INSERT INTO waitlist (x_username) VALUES (:username)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        return $stmt->execute();
    }

    try {
        if (isUsernameExists($pdo, $username)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username already in waitlist.'
            ]);
        } else {
            if (insertUsername($pdo, $username)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'You have been added to the waitlist.'
                ]);
            } else {
                throw new Exception('Unable to add to waitlist.');
            }
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

?>
