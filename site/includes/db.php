<?php
/**
 * Database Configuration
 * Fitness App - User Authentication System
 */

// Database credentials - adjust these if needed
if (!defined('DB_HOST')) {
    $envHost = getenv('DB_HOST');
    $envUser = getenv('DB_USER');
    $envPass = getenv('DB_PASS');
    $envName = getenv('DB_NAME');
    $envPort = getenv('DB_PORT');

    if ($envHost === false || $envHost === '') $envHost = getenv('MYSQLHOST');
    if ($envUser === false || $envUser === '') $envUser = getenv('MYSQLUSER');
    if ($envPass === false) $envPass = getenv('MYSQLPASSWORD');
    if ($envName === false || $envName === '') $envName = getenv('MYSQLDATABASE');
    if ($envName === false || $envName === '') $envName = getenv('MYSQL_DATABASE');
    if ($envPort === false || $envPort === '') $envPort = getenv('MYSQLPORT');

    define('DB_HOST', ($envHost !== false && $envHost !== '') ? $envHost : 'localhost');
    define('DB_USER', ($envUser !== false && $envUser !== '') ? $envUser : 'root');
    define('DB_PASS', ($envPass !== false) ? $envPass : '');
    define('DB_NAME', ($envName !== false && $envName !== '') ? $envName : 'fitness_db');
    define('DB_PORT', ($envPort !== false && $envPort !== '') ? (int)$envPort : 3306);
}

/**
 * Get database connection
 * @return mysqli|null
 */
function getDBConnection() {
    $port = defined('DB_PORT') ? (int)DB_PORT : 3306;
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, $port);
    } catch (mysqli_sql_exception $e) {
        $msg = $e->getMessage();

        if (stripos($msg, 'Unknown database') !== false) {
            try {
                $connTemp = new mysqli(DB_HOST, DB_USER, DB_PASS, '', $port);
                $connTemp->query("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $connTemp->close();
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, $port);
            } catch (mysqli_sql_exception $e2) {
                error_log("DB Connection failed: " . $e2->getMessage());
                return null;
            }
        } else {
            error_log("DB Connection failed: " . $msg);
            return null;
        }
    }

    if ($conn->connect_error) {
        error_log("DB Connection failed: " . $conn->connect_error);
        return null;
    }

    $conn->set_charset("utf8mb4");
    return $conn;
}

/**
 * Create users table if not exists
 */
function initializeUsersTable() {
    $conn = getDBConnection();
    if (!$conn) return false;
    
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        name VARCHAR(100) DEFAULT NULL,
        age INT DEFAULT NULL,
        gender ENUM('male', 'female') DEFAULT NULL,
        weight DECIMAL(5,2) DEFAULT NULL,
        height DECIMAL(5,2) DEFAULT NULL,
        fitness_level VARCHAR(20) DEFAULT NULL,
        health_condition VARCHAR(50) DEFAULT NULL,
        goal VARCHAR(30) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

/**
 * Register new user
 * @param array $data
 * @return array ['success' => bool, 'message' => string, 'user_id' => int|null]
 */
function registerUser($data) {
    $conn = getDBConnection();
    if (!$conn) {
        return ['success' => false, 'message' => 'Database connection failed', 'user_id' => null];
    }
    
    // Initialize table
    initializeUsersTable();
    
    $username = trim($data['username'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $name = trim($data['name'] ?? '');
    
    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $conn->close();
        return ['success' => false, 'message' => 'Username, email, and password are required', 'user_id' => null];
    }
    
    if (strlen($password) < 6) {
        $conn->close();
        return ['success' => false, 'message' => 'Password must be at least 6 characters', 'user_id' => null];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conn->close();
        return ['success' => false, 'message' => 'Invalid email format', 'user_id' => null];
    }
    
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, name) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        $conn->close();
        return ['success' => false, 'message' => 'Database error, please try again', 'user_id' => null];
    }
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $name);
    
    if ($stmt->execute()) {
        $userId = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        return ['success' => true, 'message' => 'Registration successful', 'user_id' => $userId];
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        
        if (strpos($error, 'Duplicate entry') !== false) {
            if (strpos($error, 'username') !== false) {
                return ['success' => false, 'message' => 'Username already exists', 'user_id' => null];
            }
            if (strpos($error, 'email') !== false) {
                return ['success' => false, 'message' => 'Email already exists', 'user_id' => null];
            }
        }
        
        return ['success' => false, 'message' => 'Registration failed: ' . $error, 'user_id' => null];
    }
}

/**
 * Login user
 * @param string $usernameOrEmail
 * @param string $password
 * @return array ['success' => bool, 'message' => string, 'user' => array|null]
 */
function loginUser($usernameOrEmail, $password) {
    $conn = getDBConnection();
    if (!$conn) {
        return ['success' => false, 'message' => 'Database connection failed', 'user' => null];
    }
    
    // Initialize table
    initializeUsersTable();
    
    $stmt = $conn->prepare("SELECT id, username, email, password, name, age, gender, weight, height, fitness_level, health_condition, goal FROM users WHERE username = ? OR email = ? LIMIT 1");
    if (!$stmt) {
        $conn->close();
        return ['success' => false, 'message' => 'Database error, please try again', 'user' => null];
    }
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => 'Invalid username/email or password', 'user' => null];
    }
    
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    
    if (!password_verify($password, $user['password'])) {
        return ['success' => false, 'message' => 'Invalid username/email or password', 'user' => null];
    }
    
    // Remove password from user data
    unset($user['password']);
    
    return ['success' => true, 'message' => 'Login successful', 'user' => $user];
}

/**
 * Get user by ID
 * @param int $userId
 * @return array|null
 */
function getUserById($userId) {
    $conn = getDBConnection();
    if (!$conn) return null;
    
    $stmt = $conn->prepare("SELECT id, username, email, name, age, gender, weight, height, fitness_level, health_condition, goal, created_at FROM users WHERE id = ? LIMIT 1");
    if (!$stmt) {
        $conn->close();
        return null;
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $stmt->close();
        $conn->close();
        return null;
    }
    
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    
    return $user;
}

/**
 * Update user profile
 * @param int $userId
 * @param array $data
 * @return array
 */
function updateUserProfile($userId, $data) {
    $conn = getDBConnection();
    if (!$conn) {
        return ['success' => false, 'message' => 'Database connection failed'];
    }
    
    $fields = [];
    $values = [];
    $types = "";
    
    if (isset($data['name'])) {
        $fields[] = "name = ?";
        $values[] = $data['name'];
        $types .= "s";
    }
    if (isset($data['age'])) {
        $fields[] = "age = ?";
        $values[] = $data['age'];
        $types .= "i";
    }
    if (isset($data['gender'])) {
        $fields[] = "gender = ?";
        $values[] = $data['gender'];
        $types .= "s";
    }
    if (isset($data['weight'])) {
        $fields[] = "weight = ?";
        $values[] = $data['weight'];
        $types .= "d";
    }
    if (isset($data['height'])) {
        $fields[] = "height = ?";
        $values[] = $data['height'];
        $types .= "d";
    }
    if (isset($data['fitness_level'])) {
        $fields[] = "fitness_level = ?";
        $values[] = $data['fitness_level'];
        $types .= "s";
    }
    if (isset($data['health_condition'])) {
        $fields[] = "health_condition = ?";
        $values[] = $data['health_condition'];
        $types .= "s";
    }
    if (isset($data['goal'])) {
        $fields[] = "goal = ?";
        $values[] = $data['goal'];
        $types .= "s";
    }
    
    if (empty($fields)) {
        $conn->close();
        return ['success' => false, 'message' => 'No fields to update'];
    }
    
    $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = ?";
    $values[] = $userId;
    $types .= "i";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$values);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ['success' => true, 'message' => 'Profile updated successfully'];
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => 'Update failed: ' . $error];
    }
}

/**
 * Check if user is logged in
 * @return array|null
 */
function getCurrentUser() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    
    return getUserById($_SESSION['user_id']);
}

/**
 * Require login
 * Redirects to login page if not logged in
 */
function requireLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Logout user
 */
function logoutUser() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    session_destroy();
}

/**
 * Save user assessment data
 * @param int $userId
 * @param array $data
 * @return bool
 */
function saveUserAssessment($userId, $data) {
    $conn = getDBConnection();
    if (!$conn) return false;
    
    $sql = "UPDATE users SET 
        age = ?,
        gender = ?,
        weight = ?,
        height = ?,
        fitness_level = ?,
        health_condition = ?,
        goal = ?
    WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $conn->close();
        return false;
    }
    
    $stmt->bind_param("isddsssi",
        $data['age'],
        $data['gender'],
        $data['weight'],
        $data['height'],
        $data['fitness_level'],
        $data['health_condition'],
        $data['goal'],
        $userId
    );
    
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    
    return $result;
}

/**
 * Check if user has completed assessment
 * @param int $userId
 * @return bool
 */
function hasUserAssessment($userId) {
    $conn = getDBConnection();
    if (!$conn) return false;
    
    $stmt = $conn->prepare("SELECT age, weight, height FROM users WHERE id = ? AND age IS NOT NULL AND weight IS NOT NULL AND height IS NOT NULL LIMIT 1");
    if (!$stmt) {
        $conn->close();
        return false;
    }
    
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $hasData = ($result->num_rows > 0);
    $stmt->close();
    $conn->close();
    
    return $hasData;
}
?>
