<?php
// GM Legacy School - Admission Confirmation Letter Handler
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
        
        // Generate confirmation number
        $confirmation_no = 'GMLS/ACL/' . date('Y') . '/' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        // Validate required fields
        $required_fields = [
            'issue_date', 'parent_name', 'parent_address', 'student_name', 
            'class_confirmed', 'academic_year', 'joining_date', 'contact_number'
        ];
        
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Missing required field: ' . $field]);
                exit();
            }
        }
        
        // Validate contact number (basic validation)
        if (!preg_match('/^[0-9]{10}$/', $input['contact_number'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Contact number must be 10 digits']);
            exit();
        }
        
        // Validate email format if provided
        if (!empty($input['email_id']) && !filter_var($input['email_id'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit();
        }
        
        // Validate dates
        $issue_date = new DateTime($input['issue_date']);
        $joining_date = new DateTime($input['joining_date']);
        
        if ($joining_date <= $issue_date) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Joining date must be after issue date']);
            exit();
        }
        
        // Validate fees received if provided
        $fees_received = null;
        if (!empty($input['fees_received'])) {
            $fees_received = floatval($input['fees_received']);
            if ($fees_received <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Fees amount must be greater than 0']);
                exit();
            }
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO admission_confirmation_letters (
            confirmation_no, issue_date, parent_name, parent_address, student_name,
            class_confirmed, academic_year, joining_date, contact_number,
            email_id, provisional_letter_reference, fees_received, documents_verified,
            transport_required, special_instructions, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Confirmed')";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        // Bind parameters
        $stmt->bind_param(
            "sssssssssssdiis",
            $confirmation_no,
            $input['issue_date'],
            $input['parent_name'],
            $input['parent_address'],
            $input['student_name'],
            $input['class_confirmed'],
            $input['academic_year'],
            $input['joining_date'],
            $input['contact_number'],
            $input['email_id'] ?? null,
            $input['provisional_letter_reference'] ?? null,
            $fees_received,
            isset($input['documents_verified']) ? 1 : 0,
            isset($input['transport_required']) ? 1 : 0,
            $input['special_instructions'] ?? null
        );
        
        // Execute statement
        if ($stmt->execute()) {
            $confirmation_id = $conn->insert_id;
            
            // Generate the letter content
            $letter_content = generateConfirmationLetterContent($input, $confirmation_no);
            
            // Send success response with letter content
            echo json_encode([
                'success' => true, 
                'message' => 'Admission confirmation letter generated successfully!',
                'confirmation_no' => $confirmation_no,
                'confirmation_id' => $confirmation_id,
                'letter_content' => $letter_content
            ]);
            
            // Optional: Send email notification (uncomment if needed)
            /*
            if (!empty($input['email_id'])) {
                $to = $input['email_id'];
                $subject = "Admission Confirmation - " . $input['student_name'] . " (Confirmation No: " . $confirmation_no . ")";
                $message = $letter_content;
                $headers = "From: admissions@gmls.ac.in\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
                mail($to, $subject, $message, $headers);
            }
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

function generateConfirmationLetterContent($data, $confirmation_no) {
    $issue_date = date('d/m/Y', strtotime($data['issue_date']));
    $joining_date = date('d/m/Y', strtotime($data['joining_date']));
    
    return "
    <div style='font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;'>
        <div style='text-align: center; margin-bottom: 30px;'>
            <h2 style='color: #651e21; margin: 0;'>GM LEGACY SCHOOL</h2>
            <p style='margin: 5px 0; color: #666;'>(Under Srishyla Education Trust, Davanagere)</p>
            <p style='margin: 20px 0 0 0; text-align: right;'><strong>Date:</strong> {$issue_date}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>Confirmation No:</strong> {$confirmation_no}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>To,</strong></p>
            <p>Mr./Mrs. {$data['parent_name']}</p>
            <p>Address: {$data['parent_address']}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>Subject:</strong> Admission Confirmation – Academic Year {$data['academic_year']}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>Dear Sir/Madam,</p>
            <p>We are happy to confirm that the admission of your ward <strong>{$data['student_name']}</strong> to <strong>Class {$data['class_confirmed']}</strong> at GM Legacy School for the Academic Year <strong>{$data['academic_year']}</strong> has been successfully completed.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>All required documents have been verified and the prescribed fees have been received.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>Your child is required to report to the school on <strong>{$joining_date}</strong> as per the joining instructions.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>Details regarding:</strong></p>
            <ul style='margin-left: 20px;'>
                <li>School uniform</li>
                <li>Books and stationery</li>
                <li>Timetable</li>
                <li>Orientation programme</li>
                <li>Transport facility</li>
            </ul>
            <p>will be shared separately.</p>
        </div>
        
        <div style='margin-bottom: 30px;'>
            <p>We welcome your family to the GM Legacy School community and look forward to a meaningful partnership in your child's education.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>With best wishes,</p>
            <br>
            <p><strong>Principal</strong><br>
            <strong>GM Legacy School</strong><br>
            Signature & Seal</p>
        </div>
        
        <div style='border-top: 2px solid #651e21; margin-top: 30px; padding-top: 10px; text-align: center;'>
            <p style='margin: 0; font-size: 0.9rem; color: #666;'>***************************************************************</p>
        </div>
    </div>";
}

$conn->close();
?>