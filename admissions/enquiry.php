<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Enquiry Form - GM Legacy School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #ffffff !important;
        }
        
        .enquiry-form-container {
            max-width: 800px;
            margin: 120px auto 60px;
            padding: 40px;
            background: #fdfcee;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }
        
        .school-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .school-name {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }
        
        .trust-name {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 20px;
        }
        
        .form-title {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-family: 'Playfair Display', serif;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 500;
        }
        
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: #fafafa;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(233, 198, 111, 0.1);
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        
        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .radio-item input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }
        
        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }
        
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: #fafafa;
            min-height: 100px;
            resize: vertical;
        }
        
        .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(233, 198, 111, 0.1);
        }
        
        .signature-section {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e0e0e0;
        }
        
        .signature-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        
        .submit-btn {
            background: var(--primary-color);
            color: var(--white);
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: block;
            margin: 40px auto 0;
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 40, 78, 0.2);
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            display: none;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            display: none;
        }
        
        @media (max-width: 768px) {
            .enquiry-form-container {
                margin: 100px 20px 40px;
                padding: 30px 20px;
            }
            
            .school-name {
                font-size: 1.6rem;
            }
            
            .form-title {
                font-size: 1.4rem;
            }
            
            .checkbox-group {
                grid-template-columns: 1fr;
            }
            
            .signature-row {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- ===== HEADER ===== -->
    <header class="header-modern">
        <div class="pill-nav-container">
            <nav class="pill-nav">
                <!-- Logo Area -->
                <div class="nav-logo-modern">
                    <a href="../index.html">
                        <img src="../assests/logo.jpeg" alt="GM Legacy School Logo">
                    </a>
                </div>

                <!-- Main Nav Menu -->
                <ul class="nav-menu-modern">
                    <li class="dropdown">
                        <a href="../about/vision-mission.html">About <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="../about/vision-mission.html">Vision & Mission</a>
                            <a href="../about/founders-message.html">Founder's Message</a>
                            <a href="../about/principals-message.html">Principal's Message</a>
                            <a href="../about/philosophy-values.html">Philosophy & Values</a>
                            <a href="../about/nep-alignment.html">NEP 2020 Alignment</a>
                            <a href="../about/school-history.html">Legacy</a>
                            <a href="../about/governance.html">Governance</a>
                            <a href="../about/public-disclosure.html">Public Disclosure</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="../admissions/overview.html">Admissions <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="../admissions/overview.html">Overview</a>
                            <a href="../admissions/eligibility.html">Eligibility</a>
                            <a href="../admissions/process.html">Process</a>
                            <a href="../admissions/schedule.html">Schedule</a>
                            <a href="../admissions/transfer.html">Transfer</a>
                            <a href="../admissions/faqs.html">FAQs</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="../board/affiliation.html">Board & Schools <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="../board/affiliation.html">CBSE Affiliation</a>
                            <a href="../board/nep-structure.html">NEP Structure</a>
                            <a href="../board/academic-calendar.html">Academic Calendar</a>
                            <a href="../board/examination-assessment.html">Assessments</a>
                            <a href="../board/policies-guidelines.html">Policies & Guidelines</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="../curriculum/nep-framework.html">Curriculum <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="../curriculum/nep-framework.html">Framework</a>
                            <a href="../curriculum/foundational-curriculum.html">Foundational Stage</a>
                            <a href="../curriculum/primary-curriculum.html">Primary Stage</a>
                            <a href="../curriculum/middle-curriculum.html">Middle School</a>
                            <a href="../curriculum/secondary-curriculum.html">Secondary School</a>
                            <a href="../curriculum/skill-based-education.html">Skill-Based</a>
                            <a href="../curriculum/value-education.html">Value Education</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="../teaching/methods.html">Teaching and Learning <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="../teaching/methods.html">Teaching Methods</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="../extracurricular/activities.html">Co & Extra <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="../extracurricular/activities.html">Co-Curricular Activities</a>
                        </div>
                    </li>
                    <li><a href="../facilities/index.html">Facilities</a></li>
                    <li><a href="../fee/index.html">Fee</a></li>
                    <li><a href="../faculty/index.html">Faculty</a></li>
                    <li><a href="../residential/index.html">Res. Facilities</a></li>
                    <li><a href="../campus/index.html">Campus</a></li>
                    <li><a href="../index.html#disclosures">Disclosures</a></li>
                </ul>

                <!-- Right Actions -->
                <div class="nav-actions-modern">
                    <a href="mailto:info@gmls.ac.in" class="contact-pill">info@gmls.ac.in</a>
                    <div class="modern-hamburger" id="hamburger">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- ===== ENQUIRY FORM ===== -->
    <main class="enquiry-form-container">
        <div class="school-header">
            <div class="school-name">GM LEGACY SCHOOL</div>
            <div class="trust-name">(Under Srishyla Education Trust, Davanagere)</div>
            <h1 class="form-title">Admission Enquiry Form</h1>
        </div>

        <?php
        // Include database configuration
        require_once '../database/config.php';

        // Initialize variables
        $success_message = '';
        $error_message = '';

        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Collect and sanitize form data
            $child_name = mysqli_real_escape_string($conn, $_POST['childName']);
            $date_of_birth = $_POST['dob'];
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $class_seeking = mysqli_real_escape_string($conn, $_POST['class']);
            $academic_year = mysqli_real_escape_string($conn, $_POST['academicYear']);
            $father_name = mysqli_real_escape_string($conn, $_POST['fatherName']);
            $mother_name = mysqli_real_escape_string($conn, $_POST['motherName']);
            $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
            $contact_number = mysqli_real_escape_string($conn, $_POST['contactNumber']);
            $email_id = mysqli_real_escape_string($conn, $_POST['email']);
            $residential_address = mysqli_real_escape_string($conn, $_POST['address']);
            
            // Source checkboxes
            $source_newspaper = isset($_POST['source']['newspaper']) ? 1 : 0;
            $source_website = isset($_POST['source']['website']) ? 1 : 0;
            $source_friends_relatives = isset($_POST['source']['friends']) ? 1 : 0;
            $source_social_media = isset($_POST['source']['socialMedia']) ? 1 : 0;
            $source_others = isset($_POST['others']) ? mysqli_real_escape_string($conn, $_POST['others']) : '';
            
            $remarks_queries = mysqli_real_escape_string($conn, $_POST['remarks']);
            $signature = mysqli_real_escape_string($conn, $_POST['signature']);
            $signature_date = $_POST['signatureDate'];

            // Insert data into database
            $sql = "INSERT INTO enquiry_form (
                child_name, date_of_birth, gender, class_seeking, academic_year,
                father_name, mother_name, occupation, contact_number, email_id,
                residential_address, source_newspaper, source_website, source_friends_relatives,
                source_social_media, source_others, remarks_queries, signature, signature_date
            ) VALUES (
                '$child_name', '$date_of_birth', '$gender', '$class_seeking', '$academic_year',
                '$father_name', '$mother_name', '$occupation', '$contact_number', '$email_id',
                '$residential_address', $source_newspaper, $source_website, $source_friends_relatives,
                $source_social_media, '$source_others', '$remarks_queries', '$signature', '$signature_date'
            )";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Thank you for your enquiry! We have received your information and will get back to you soon.";
                // Clear form after successful submission
                $_POST = array();
            } else {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

        <!-- Display Messages -->
        <?php if (!empty($success_message)): ?>
            <div class="success-message" style="display: block;">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="error-message" style="display: block;">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form id="enquiryForm" method="POST" action="">
            <!-- Section 1: Student Details -->
            <div class="form-section">
                <h2 class="section-title">1. Student Details</h2>
                
                <div class="form-group">
                    <label for="childName">Name of the Child:</label>
                    <input type="text" id="childName" name="childName" required value="<?php echo isset($_POST['childName']) ? htmlspecialchars($_POST['childName']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="male" name="gender" value="male" required <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : ''; ?>>
                            <label for="male">Male</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="female" name="gender" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : ''; ?>>
                            <label for="female">Female</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="other" name="gender" value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'other') ? 'checked' : ''; ?>>
                            <label for="other">Other</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="class">Class Seeking Admission To:</label>
                    <input type="text" id="class" name="class" required value="<?php echo isset($_POST['class']) ? htmlspecialchars($_POST['class']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="academicYear">Academic Year:</label>
                    <input type="text" id="academicYear" name="academicYear" required value="<?php echo isset($_POST['academicYear']) ? htmlspecialchars($_POST['academicYear']) : ''; ?>">
                </div>
            </div>

            <!-- Section 2: Parent/Guardian Details -->
            <div class="form-section">
                <h2 class="section-title">2. Parent / Guardian Details</h2>
                
                <div class="form-group">
                    <label for="fatherName">Father's Name:</label>
                    <input type="text" id="fatherName" name="fatherName" required value="<?php echo isset($_POST['fatherName']) ? htmlspecialchars($_POST['fatherName']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="motherName">Mother's Name:</label>
                    <input type="text" id="motherName" name="motherName" required value="<?php echo isset($_POST['motherName']) ? htmlspecialchars($_POST['motherName']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation" required value="<?php echo isset($_POST['occupation']) ? htmlspecialchars($_POST['occupation']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="contactNumber">Contact Number:</label>
                    <input type="tel" id="contactNumber" name="contactNumber" required value="<?php echo isset($_POST['contactNumber']) ? htmlspecialchars($_POST['contactNumber']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
            </div>

            <!-- Section 3: Address -->
            <div class="form-section">
                <h2 class="section-title">3. Address</h2>
                
                <div class="form-group">
                    <label for="address">Residential Address:</label>
                    <textarea id="address" name="address" rows="3" required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                </div>
            </div>

            <!-- Section 4: How did you come to know about the School? -->
            <div class="form-section">
                <h2 class="section-title">4. How did you come to know about the School?</h2>
                
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="newspaper" name="source[newspaper]" value="newspaper" <?php echo (isset($_POST['source']['newspaper'])) ? 'checked' : ''; ?>>
                        <label for="newspaper">Newspaper</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="website" name="source[website]" value="website" <?php echo (isset($_POST['source']['website'])) ? 'checked' : ''; ?>>
                        <label for="website">Website</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="friends" name="source[friends]" value="friends" <?php echo (isset($_POST['source']['friends'])) ? 'checked' : ''; ?>>
                        <label for="friends">Friends/Relatives</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="socialMedia" name="source[socialMedia]" value="socialMedia" <?php echo (isset($_POST['source']['socialMedia'])) ? 'checked' : ''; ?>>
                        <label for="socialMedia">Social Media</label>
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 20px;">
                    <label for="others">Others:</label>
                    <input type="text" id="others" name="others" value="<?php echo isset($_POST['others']) ? htmlspecialchars($_POST['others']) : ''; ?>">
                </div>
            </div>

            <!-- Section 5: Remarks/Queries -->
            <div class="form-section">
                <h2 class="section-title">5. Remarks / Queries (if any):</h2>
                
                <div class="form-group">
                    <textarea id="remarks" name="remarks" rows="4"><?php echo isset($_POST['remarks']) ? htmlspecialchars($_POST['remarks']) : ''; ?></textarea>
                </div>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="form-group">
                    <label for="signature">Signature of Parent/Guardian:</label>
                    <input type="text" id="signature" name="signature" placeholder="Type your name as digital signature" required value="<?php echo isset($_POST['signature']) ? htmlspecialchars($_POST['signature']) : ''; ?>">
                </div>

                <div class="signature-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="signatureDate">Date:</label>
                        <input type="date" id="signatureDate" name="signatureDate" required value="<?php echo isset($_POST['signatureDate']) ? htmlspecialchars($_POST['signatureDate']) : date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn">Submit Enquiry Form</button>
        </form>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <img src="../assests/logo.jpeg" alt="GM Legacy School Logo" class="footer-logo">
                    <p>GM Legacy School is dedicated to providing quality education and nurturing young minds to become
                        responsible citizens and future leaders.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="../index.html#about">About Us</a>
                    <a href="../index.html#admissions">Admissions</a>
                    <a href="../index.html#curriculum">Curriculum</a>
                    <a href="../index.html#facilities">Facilities</a>
                    <a href="../index.html#faculty">Faculty</a>
                    <a href="../index.html#disclosures">Mandatory Disclosures</a>
                </div>
                <div class="footer-section">
                    <green_flag>
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> P B Road, Davanagere-577 006, Karnataka</p>
                    <p><i class="fas fa-phone-alt"></i> +91 XXXXXXXXXX</p>
                    <p><i class="fas fa-envelope"></i> info@gmls.ac.in</p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <p>
                        <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                    </p>
                    <p>
                        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                    </p>
                    <p>
                        <a href="#"><i class="fab fa-youtube"></i> YouTube</a>
                    </p>
                    <p>
                        <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 GM Legacy School. All Rights Reserved. | Designed with <i class="fas fa-heart"
                        style="color: #e9c66f;"></i></p>
            </div>
        </div>
    </footer>

    <!-- Main JavaScript -->
    <script src="../js/main.js"></script>
    
    <!-- Form Validation Script -->
    <script>
        document.getElementById('enquiryForm').addEventListener('submit', function(e) {
            // Basic client-side validation
            const requiredFields = ['childName', 'dob', 'class', 'academicYear', 'fatherName', 'motherName', 'occupation', 'contactNumber', 'email', 'address', 'signature', 'signatureDate'];
            
            for (let field of requiredFields) {
                const element = document.getElementById(field) || document.getElementsByName(field)[0];
                if (!element.value.trim()) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    element.focus();
                    return false;
                }
            }
            
            // Email validation
            const email = document.getElementById('email').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                document.getElementById('email').focus();
                return false;
            }
            
            // Phone validation
            const phone = document.getElementById('contactNumber').value;
            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone.replace(/[^0-9]/g, ''))) {
                e.preventDefault();
                alert('Please enter a valid 10-digit phone number.');
                document.getElementById('contactNumber').focus();
                return false;
            }
        });
        
        // Set current date as default for signature date
        if (!document.getElementById('signatureDate').value) {
            document.getElementById('signatureDate').valueAsDate = new Date();
        }
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
