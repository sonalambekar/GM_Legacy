<?php
// GM Legacy School - Admission Application Form Handler
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
        
        // Generate application number
        $application_no = 'GMLS' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Validate required fields
        $required_fields = [
            'academic_year', 'full_name', 'date_of_birth', 'age_as_on_june', 
            'gender', 'nationality', 'mother_tongue', 'class_sought', 
            'medium_of_instruction', 'fathers_name', 'fathers_qualification',
            'fathers_occupation', 'fathers_mobile', 'mothers_name', 
            'mothers_qualification', 'mothers_occupation', 'mothers_mobile',
            'residential_address', 'emergency_contact', 'parent_name', 'declaration_date'
        ];
        
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Missing required field: ' . $field]);
                exit();
            }
        }
        
        // Validate mobile numbers (basic validation)
        if (!preg_match('/^[0-9]{10}$/', $input['fathers_mobile'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Father\'s mobile number must be 10 digits']);
            exit();
        }
        
        if (!preg_match('/^[0-9]{10}$/', $input['mothers_mobile'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Mother\'s mobile number must be 10 digits']);
            exit();
        }
        
        if (!preg_match('/^[0-9]{10}$/', $input['emergency_contact'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Emergency contact must be 10 digits']);
            exit();
        }
        
        // Validate Aadhaar number if provided
        if (!empty($input['aadhaar_number']) && !preg_match('/^[0-9]{12}$/', $input['aadhaar_number'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Aadhaar number must be 12 digits']);
            exit();
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO admission_applications (
            application_no, academic_year, full_name, date_of_birth, age_as_on_june,
            gender, nationality, religion_community, mother_tongue, aadhaar_number,
            class_sought, previous_school, medium_of_instruction, fathers_name,
            fathers_qualification, fathers_occupation, fathers_mobile, mothers_name,
            mothers_qualification, mothers_occupation, mothers_mobile, annual_family_income,
            residential_address, emergency_contact, parent_signature, parent_name, declaration_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        // Bind parameters
        $stmt->bind_param(
            "ssssississssssssssssssssss",
            $application_no,
            $input['academic_year'],
            $input['full_name'],
            $input['date_of_birth'],
            $input['age_as_on_june'],
            $input['gender'],
            $input['nationality'],
            $input['religion_community'] ?? null,
            $input['mother_tongue'],
            $input['aadhaar_number'] ?? null,
            $input['class_sought'],
            $input['previous_school'] ?? null,
            $input['medium_of_instruction'],
            $input['fathers_name'],
            $input['fathers_qualification'],
            $input['fathers_occupation'],
            $input['fathers_mobile'],
            $input['mothers_name'],
            $input['mothers_qualification'],
            $input['mothers_occupation'],
            $input['mothers_mobile'],
            $input['annual_family_income'] ?? null,
            $input['residential_address'],
            $input['emergency_contact'],
            $input['parent_signature'] ?? 'Digital Signature',
            $input['parent_name'],
            $input['declaration_date']
        );
        
        // Execute statement
        if ($stmt->execute()) {
            $admission_id = $conn->insert_id;
            
            // Send success response
            echo json_encode([
                'success' => true, 
                'message' => 'Admission application submitted successfully!',
                'application_no' => $application_no,
                'admission_id' => $admission_id
            ]);
            
            // Optional: Send email notification (uncomment if needed)
            /*
            $to = "admissions@gmls.ac.in";
            $subject = "New Admission Application - " . $input['full_name'] . " (App No: " . $application_no . ")";
            $message = "New admission application received:\n" .
                      "Application No: " . $application_no . "\n" .
                      "Student Name: " . $input['full_name'] . "\n" .
                      "Class: " . $input['class_sought'] . "\n" .
                      "Father's Contact: " . $input['fathers_mobile'] . "\n" .
                      "Mother's Contact: " . $input['mothers_mobile'];
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