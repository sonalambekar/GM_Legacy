<?php
// GM Legacy School - Enquiry Form Handler
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database configuration
$servername = "localhost";
$username = "root"; // Change as per your setup
$password = ""; // Change as per your setup
$dbname = "gm_legacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Set charset
$conn->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        
        // Validate required fields
        $required_fields = [
            'child_name', 'date_of_birth', 'gender', 'class_seeking', 
            'academic_year', 'father_name', 'mother_name', 'occupation',
            'contact_number', 'email_id', 'residential_address', 'signature_date'
        ];
        
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Missing required field: ' . $field]);
                exit();
            }
        }
        
        // Validate email format
        if (!filter_var($input['email_id'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit();
        }
        
        // Validate phone number (basic validation)
        if (!preg_match('/^[0-9]{10}$/', $input['contact_number'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Contact number must be 10 digits']);
            exit();
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO enquiry_form (
            child_name, date_of_birth, gender, class_seeking, academic_year,
            father_name, mother_name, occupation, contact_number, email_id,
            residential_address, source_newspaper, source_website, 
            source_friends_relatives, source_social_media, source_others,
            remarks_queries, signature, signature_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        // Bind parameters
        $stmt->bind_param(
            "sssssssssssiiiiisss",
            $input['child_name'],
            $input['date_of_birth'],
            $input['gender'],
            $input['class_seeking'],
            $input['academic_year'],
            $input['father_name'],
            $input['mother_name'],
            $input['occupation'],
            $input['contact_number'],
            $input['email_id'],
            $input['residential_address'],
            isset($input['source_newspaper']) ? 1 : 0,
            isset($input['source_website']) ? 1 : 0,
            isset($input['source_friends_relatives']) ? 1 : 0,
            isset($input['source_social_media']) ? 1 : 0,
            $input['source_others'] ?? null,
            $input['remarks_queries'] ?? null,
            $input['signature'] ?? 'Digital Signature',
            $input['signature_date']
        );
        
        // Execute statement
        if ($stmt->execute()) {
            $enquiry_id = $conn->insert_id;
            
            // Send success response
            echo json_encode([
                'success' => true, 
                'message' => 'Enquiry submitted successfully!',
                'enquiry_id' => $enquiry_id
            ]);
            
            // Optional: Send email notification (uncomment if needed)
            /*
            $to = "admissions@gmls.ac.in";
            $subject = "New Admission Enquiry - " . $input['child_name'];
            $message = "New admission enquiry received for " . $input['child_name'] . 
                      "\nClass: " . $input['class_seeking'] . 
                      "\nContact: " . $input['contact_number'] . 
                      "\nEmail: " . $input['email_id'];
            $headers = "From: noreply@gmls.ac.in";
            
            mail($to, $subject, $message, $headers);
            */
            
        } else {
            throw new Exception('Execute failed: ' . $stmt->error);
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

$conn->close();
?>