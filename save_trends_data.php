<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the file name from the query parameter
    $fileName = $_GET['file'] ?? 'default.json';

    // Read the raw POST data
    $jsonData = file_get_contents('php://input');

    // Define the path to save the file
    $filePath = __DIR__ . '/' . basename($fileName);

    // Save the JSON data to the file
    if (file_put_contents($filePath, $jsonData)) {
        // Respond with a success message
        echo json_encode(["status" => "success", "message" => "File saved successfully"]);
    } else {
        // Respond with an error message
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to save file"]);
    }
} else {
    // Respond with a method not allowed error
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
}
?>
