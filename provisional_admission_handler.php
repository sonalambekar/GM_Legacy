<?php
// GM Legacy School - Provisional Admission Letter Handler
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
        
        // Generate letter number
        $letter_no = 'GMLS/PAL/' . date('Y') . '/' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        // Validate required fields
        $required_fields = [
            'issue_date', 'parent_name', 'parent_address', 'student_name', 
            'class_admitted', 'academic_year', 'admission_deadline', 'contact_number'
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
        $admission_deadline = new DateTime($input['admission_deadline']);
        
        if ($admission_deadline <= $issue_date) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Admission deadline must be after issue date']);
            exit();
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO provisional_admission_letters (
            letter_no, issue_date, parent_name, parent_address, student_name,
            class_admitted, academic_year, admission_deadline, contact_number,
            email_id, application_reference, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Generated')";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        
        // Bind parameters
        $stmt->bind_param(
            "sssssssssss",
            $letter_no,
            $input['issue_date'],
            $input['parent_name'],
            $input['parent_address'],
            $input['student_name'],
            $input['class_admitted'],
            $input['academic_year'],
            $input['admission_deadline'],
            $input['contact_number'],
            $input['email_id'] ?? null,
            $input['application_reference'] ?? null
        );
        
        // Execute statement
        if ($stmt->execute()) {
            $letter_id = $conn->insert_id;
            
            // Generate the letter content
            $letter_content = generateLetterContent($input, $letter_no);
            
            // Send success response with letter content
            echo json_encode([
                'success' => true, 
                'message' => 'Provisional admission letter generated successfully!',
                'letter_no' => $letter_no,
                'letter_id' => $letter_id,
                'letter_content' => $letter_content
            ]);
            
            // Optional: Send email notification (uncomment if needed)
            /*
            if (!empty($input['email_id'])) {
                $to = $input['email_id'];
                $subject = "Provisional Admission Letter - " . $input['student_name'] . " (Letter No: " . $letter_no . ")";
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

function generateLetterContent($data, $letter_no) {
    $issue_date = date('d/m/Y', strtotime($data['issue_date']));
    $deadline_date = date('d/m/Y', strtotime($data['admission_deadline']));
    
    return "
    <div style='font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;'>
        <div style='text-align: center; margin-bottom: 30px;'>
            <h2 style='color: #651e21; margin: 0;'>GM LEGACY SCHOOL</h2>
            <p style='margin: 5px 0; color: #666;'>(Under Srishyla Education Trust, Davanagere)</p>
            <p style='margin: 20px 0 0 0; text-align: right;'><strong>Date:</strong> {$issue_date}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>Letter No:</strong> {$letter_no}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>To,</strong></p>
            <p>Mr./Mrs. {$data['parent_name']}</p>
            <p>Address: {$data['parent_address']}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>Subject:</strong> Provisional Admission Offer – Academic Year {$data['academic_year']}</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>Dear Sir/Madam,</p>
            <p>We are pleased to inform you that your ward <strong>{$data['student_name']}</strong> has been provisionally selected for admission to <strong>Class {$data['class_admitted']}</strong> at GM Legacy School for the Academic Year <strong>{$data['academic_year']}</strong>.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>This provisional admission is subject to:</strong></p>
            <ul style='margin-left: 20px;'>
                <li>Verification of original documents</li>
                <li>Payment of prescribed admission and school fees</li>
                <li>Fulfilment of eligibility criteria as per CBSE norms</li>
            </ul>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>You are requested to complete the admission formalities on or before <strong>{$deadline_date}</strong>.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p><strong>Required documents to be produced:</strong></p>
            <ul style='margin-left: 20px;'>
                <li>Birth Certificate (Original & Copy)</li>
                <li>Previous School Report Card (if applicable)</li>
                <li>Transfer Certificate (if applicable)</li>
                <li>Aadhaar Card (if available)</li>
                <li>Two Passport Size Photographs</li>
            </ul>
        </div>
        
        <div style='margin-bottom: 30px;'>
            <p>We look forward to welcoming your child to GM Legacy School.</p>
        </div>
        
        <div style='margin-bottom: 20px;'>
            <p>With regards,</p>
            <br>
            <p><strong>Principal</strong><br>
            <strong>GM Legacy School</strong><br>
            Signature & Seal</p>
        </div>
    </div>";
}

$conn->close();
?>