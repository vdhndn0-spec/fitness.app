<?php
/**
 * API endpoint to save user assessment data
 */
require __DIR__ . '/../../includes/db.php';

session_start();

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Validate required fields
$required = ['age', 'gender', 'weight', 'height', 'fitnessLevel', 'healthCondition', 'goal'];
foreach ($required as $field) {
    if (!isset($input[$field]) || $input[$field] === '') {
        echo json_encode(['success' => false, 'message' => 'Missing field: ' . $field]);
        exit;
    }
}

// Prepare data for database
$data = [
    'age' => (int)$input['age'],
    'gender' => $input['gender'],
    'weight' => (float)$input['weight'],
    'height' => (float)$input['height'],
    'fitness_level' => $input['fitnessLevel'],
    'health_condition' => $input['healthCondition'],
    'goal' => $input['goal']
];

// Save to database
$result = saveUserAssessment($_SESSION['user_id'], $data);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Assessment saved']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save assessment']);
}
