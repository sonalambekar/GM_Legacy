<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Application Form - GM Legacy School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #ffffff !important;
        }
        
        .admission-form-container {
            max-width: 900px;
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
        
        .form-title {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-family: 'Playfair Display', serif;
        }
        
        .application-no {
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .academic-year {
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 40px;
            text-align: center;
        }
        
        .form-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            font-weight: 600;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
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
        
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: #fafafa;
            min-height: 80px;
            resize: vertical;
        }
        
        .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(233, 198, 111, 0.1);
        }
        
        .declaration-section {
            margin-top: 40px;
            padding: 30px;
            background: #f9f5ff;
            border-radius: 15px;
            border-left: 4px solid var(--primary-color);
        }
        
        .declaration-text {
            font-style: italic;
            margin-bottom: 20px;
            color: var(--text-dark);
        }
        
        .signature-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            gap: 30px;
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
            .admission-form-container {
                margin: 100px 20px 40px;
                padding: 30px 20px;
            }
            
            .school-name {
                font-size: 1.6rem;
            }
            
            .form-title {
                font-size: 1.4rem;
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
                            <a href="../admissions/admission.php">Application</a>
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

    <!-- ===== ADMISSION APPLICATION FORM ===== -->
    <main class="admission-form-container">
        <div class="school-header">
            <div class="school-name">GM LEGACY SCHOOL</div>
            <h1 class="form-title">Admission Application Form – Academic Year ___________</h1>
            <div class="application-no">Application No. …………………………………….</div>
        </div>

        <?php
        // Include database configuration
        require_once '../database/config.php';

        // Initialize variables
        $success_message = '';
        $error_message = '';
        $application_no = '';

        // Generate application number
        $result = $conn->query("SELECT MAX(CAST(SUBSTRING(application_no, 4) AS UNSIGNED)) as max_num FROM admission_applications");
        $row = $result->fetch_assoc();
        $next_num = $row['max_num'] + 1;
        $application_no = 'GMLA' . str_pad($next_num, 4, '0', STR_PAD_LEFT) . '/' . date('Y');

        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Collect and sanitize form data
            $application_no = mysqli_real_escape_string($conn, $_POST['application_no']);
            $academic_year = mysqli_real_escape_string($conn, $_POST['academic_year']);
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $date_of_birth = $_POST['date_of_birth'];
            $age_as_on_june = mysqli_real_escape_string($conn, $_POST['age_as_on_june']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
            $religion_community = mysqli_real_escape_string($conn, $_POST['religion_community']);
            $mother_tongue = mysqli_real_escape_string($conn, $_POST['mother_tongue']);
            $aadhaar_number = mysqli_real_escape_string($conn, $_POST['aadhaar_number']);
            $class_sought = mysqli_real_escape_string($conn, $_POST['class_sought']);
            $previous_school = mysqli_real_escape_string($conn, $_POST['previous_school']);
            $medium_of_instruction = mysqli_real_escape_string($conn, $_POST['medium_of_instruction']);
            $fathers_name = mysqli_real_escape_string($conn, $_POST['fathers_name']);
            $fathers_qualification = mysqli_real_escape_string($conn, $_POST['fathers_qualification']);
            $fathers_occupation = mysqli_real_escape_string($conn, $_POST['fathers_occupation']);
            $fathers_mobile = mysqli_real_escape_string($conn, $_POST['fathers_mobile']);
            $mothers_name = mysqli_real_escape_string($conn, $_POST['mothers_name']);
            $mothers_qualification = mysqli_real_escape_string($conn, $_POST['mothers_qualification']);
            $mothers_occupation = mysqli_real_escape_string($conn, $_POST['mothers_occupation']);
            $mothers_mobile = mysqli_real_escape_string($conn, $_POST['mothers_mobile']);
            $annual_family_income = mysqli_real_escape_string($conn, $_POST['annual_family_income']);
            $residential_address = mysqli_real_escape_string($conn, $_POST['residential_address']);
            $emergency_contact = mysqli_real_escape_string($conn, $_POST['emergency_contact']);
            $parent_signature = mysqli_real_escape_string($conn, $_POST['parent_signature']);
            $parent_name = mysqli_real_escape_string($conn, $_POST['parent_name']);
            $declaration_date = $_POST['declaration_date'];

            // Insert data into database
            $sql = "INSERT INTO admission_applications (
                application_no, academic_year, full_name, date_of_birth, age_as_on_june, gender,
                nationality, religion_community, mother_tongue, aadhaar_number, class_sought, previous_school,
                medium_of_instruction, fathers_name, fathers_qualification, fathers_occupation, fathers_mobile,
                mothers_name, mothers_qualification, mothers_occupation, mothers_mobile, annual_family_income,
                residential_address, emergency_contact, parent_signature, parent_name, declaration_date
            ) VALUES (
                '$application_no', '$academic_year', '$full_name', '$date_of_birth', '$age_as_on_june', '$gender',
                '$nationality', '$religion_community', '$mother_tongue', '$aadhaar_number', '$class_sought', '$previous_school',
                '$medium_of_instruction', '$fathers_name', '$fathers_qualification', '$fathers_occupation', '$fathers_mobile',
                '$mothers_name', '$mothers_qualification', '$mothers_occupation', '$mothers_mobile', '$annual_family_income',
                '$residential_address', '$emergency_contact', '$parent_signature', '$parent_name', '$declaration_date'
            )";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Thank you for your application! Your application has been submitted successfully. Application No: $application_no";
                // Clear form after successful submission
                $_POST = array();
                // Generate new application number for next submission
                $result = $conn->query("SELECT MAX(CAST(SUBSTRING(application_no, 4) AS UNSIGNED)) as max_num FROM admission_applications");
                $row = $result->fetch_assoc();
                $next_num = $row['max_num'] + 1;
                $application_no = 'GMLA' . str_pad($next_num, 4, '0', STR_PAD_LEFT) . '/' . date('Y');
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

        <form id="admissionForm" method="POST" action="">
            <div class="application-no">
                <label for="application_no">Application No.:</label>
                <input type="text" id="application_no" name="application_no" value="<?php echo $application_no; ?>" readonly>
            </div>

            <div class="academic-year">
                <label for="academic_year">Academic Year:</label>
                <input type="text" id="academic_year" name="academic_year" placeholder="2024-2025" value="<?php echo isset($_POST['academic_year']) ? htmlspecialchars($_POST['academic_year']) : date('Y') . '-' . (date('Y') + 1); ?>" required>
            </div>

            <!-- Section A: Student Information -->
            <div class="form-section">
                <h2 class="section-title">A. Student Information</h2>
                
                <div class="form-group">
                    <label for="full_name">1. Full Name of the Student:</label>
                    <input type="text" id="full_name" name="full_name" required value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="date_of_birth">2. Date of Birth (as per Birth Certificate):</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required value="<?php echo isset($_POST['date_of_birth']) ? htmlspecialchars($_POST['date_of_birth']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="age_as_on_june">3. Age as on 1st June:</label>
                    <input type="text" id="age_as_on_june" name="age_as_on_june" required value="<?php echo isset($_POST['age_as_on_june']) ? htmlspecialchars($_POST['age_as_on_june']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>4. Gender:</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="male" name="gender" value="Male" required <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'checked' : ''; ?>>
                            <label for="male">Male</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="female" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'checked' : ''; ?>>
                            <label for="female">Female</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="other" name="gender" value="Other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Other') ? 'checked' : ''; ?>>
                            <label for="other">Other</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nationality">5. Nationality:</label>
                    <input type="text" id="nationality" name="nationality" required value="<?php echo isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="religion_community">6. Religion / Community (Optional):</label>
                    <input type="text" id="religion_community" name="religion_community" value="<?php echo isset($_POST['religion_community']) ? htmlspecialchars($_POST['religion_community']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="mother_tongue">7. Mother Tongue:</label>
                    <input type="text" id="mother_tongue" name="mother_tongue" required value="<?php echo isset($_POST['mother_tongue']) ? htmlspecialchars($_POST['mother_tongue']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="aadhaar_number">8. Aadhaar Number (if available):</label>
                    <input type="text" id="aadhaar_number" name="aadhaar_number" maxlength="12" value="<?php echo isset($_POST['aadhaar_number']) ? htmlspecialchars($_POST['aadhaar_number']) : ''; ?>">
                </div>
            </div>

            <!-- Section B: Admission Details -->
            <div class="form-section">
                <h2 class="section-title">B. Admission Details</h2>
                
                <div class="form-group">
                    <label for="class_sought">9. Class for which Admission is sought:</label>
                    <input type="text" id="class_sought" name="class_sought" required value="<?php echo isset($_POST['class_sought']) ? htmlspecialchars($_POST['class_sought']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="previous_school">10. Previous School Name (if applicable):</label>
                    <input type="text" id="previous_school" name="previous_school" value="<?php echo isset($_POST['previous_school']) ? htmlspecialchars($_POST['previous_school']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="medium_of_instruction">11. Medium of Instruction:</label>
                    <input type="text" id="medium_of_instruction" name="medium_of_instruction" required value="<?php echo isset($_POST['medium_of_instruction']) ? htmlspecialchars($_POST['medium_of_instruction']) : ''; ?>">
                </div>
            </div>

            <!-- Section C: Parent / Guardian Details -->
            <div class="form-section">
                <h2 class="section-title">C. Parent / Guardian Details</h2>
                
                <div class="form-group">
                    <label for="fathers_name">12. Father's Name:</label>
                    <input type="text" id="fathers_name" name="fathers_name" required value="<?php echo isset($_POST['fathers_name']) ? htmlspecialchars($_POST['fathers_name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="fathers_qualification">13. Qualification & Occupation:</label>
                    <input type="text" id="fathers_qualification" name="fathers_qualification" required value="<?php echo isset($_POST['fathers_qualification']) ? htmlspecialchars($_POST['fathers_qualification']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="fathers_mobile">14. Mobile Number:</label>
                    <input type="tel" id="fathers_mobile" name="fathers_mobile" required value="<?php echo isset($_POST['fathers_mobile']) ? htmlspecialchars($_POST['fathers_mobile']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="mothers_name">15. Mother's Name:</label>
                    <input type="text" id="mothers_name" name="mothers_name" required value="<?php echo isset($_POST['mothers_name']) ? htmlspecialchars($_POST['mothers_name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="mothers_qualification">16. Qualification & Occupation:</label>
                    <input type="text" id="mothers_qualification" name="mothers_qualification" required value="<?php echo isset($_POST['mothers_qualification']) ? htmlspecialchars($_POST['mothers_qualification']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="mothers_mobile">17. Mobile Number:</label>
                    <input type="tel" id="mothers_mobile" name="mothers_mobile" required value="<?php echo isset($_POST['mothers_mobile']) ? htmlspecialchars($_POST['mothers_mobile']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="annual_family_income">18. Annual Family Income (Optional):</label>
                    <input type="text" id="annual_family_income" name="annual_family_income" value="<?php echo isset($_POST['annual_family_income']) ? htmlspecialchars($_POST['annual_family_income']) : ''; ?>">
                </div>
            </div>

            <!-- Section D: Address -->
            <div class="form-section">
                <h2 class="section-title">D. Address</h2>
                
                <div class="form-group">
                    <label for="residential_address">19. Residential Address:</label>
                    <textarea id="residential_address" name="residential_address" rows="4" required><?php echo isset($_POST['residential_address']) ? htmlspecialchars($_POST['residential_address']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="emergency_contact">20. Emergency Contact Number:</label>
                    <input type="tel" id="emergency_contact" name="emergency_contact" required value="<?php echo isset($_POST['emergency_contact']) ? htmlspecialchars($_POST['emergency_contact']) : ''; ?>">
                </div>
            </div>

            <!-- Section E: Declaration -->
            <div class="declaration-section">
                <h2 class="section-title">E. Declaration by Parent / Guardian</h2>
                <p class="declaration-text">
                    I hereby declare that the information given above is true and correct to the best of my knowledge. I agree to abide by the rules and regulations of GM Legacy School.
                </p>
                
                <div class="signature-row">
                    <div class="form-group">
                        <label for="parent_signature">Signature of Parent/Guardian:</label>
                        <input type="text" id="parent_signature" name="parent_signature" placeholder="Type your name as digital signature" required value="<?php echo isset($_POST['parent_signature']) ? htmlspecialchars($_POST['parent_signature']) : ''; ?>">
                    </div>
                </div>
                
                <div class="signature-row">
                    <div class="form-group">
                        <label for="parent_name">Name:</label>
                        <input type="text" id="parent_name" name="parent_name" required value="<?php echo isset($_POST['parent_name']) ? htmlspecialchars($_POST['parent_name']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="declaration_date">Date:</label>
                        <input type="date" id="declaration_date" name="declaration_date" required value="<?php echo isset($_POST['declaration_date']) ? htmlspecialchars($_POST['declaration_date']) : date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn">Submit Application</button>
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
        document.getElementById('admissionForm').addEventListener('submit', function(e) {
            // Basic client-side validation
            const requiredFields = ['full_name', 'date_of_birth', 'age_as_on_june', 'nationality', 'mother_tongue', 'class_sought', 'medium_of_instruction', 'fathers_name', 'fathers_qualification', 'fathers_mobile', 'mothers_name', 'mothers_qualification', 'mothers_mobile', 'residential_address', 'emergency_contact', 'parent_signature', 'parent_name', 'declaration_date'];
            
            for (let field of requiredFields) {
                const element = document.getElementById(field) || document.getElementsByName(field)[0];
                if (!element.value.trim()) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    element.focus();
                    return false;
                }
            }
            
            // Mobile number validation
            const fathersMobile = document.getElementById('fathers_mobile').value.replace(/[^0-9]/g, '');
            const mothersMobile = document.getElementById('mothers_mobile').value.replace(/[^0-9]/g, '');
            const emergencyContact = document.getElementById('emergency_contact').value.replace(/[^0-9]/g, '');
            
            if (fathersMobile.length !== 10) {
                e.preventDefault();
                alert('Please enter a valid 10-digit mobile number for Father.');
                document.getElementById('fathers_mobile').focus();
                return false;
            }
            
            if (mothersMobile.length !== 10) {
                e.preventDefault();
                alert('Please enter a valid 10-digit mobile number for Mother.');
                document.getElementById('mothers_mobile').focus();
                return false;
            }
            
            if (emergencyContact.length !== 10) {
                e.preventDefault();
                alert('Please enter a valid 10-digit emergency contact number.');
                document.getElementById('emergency_contact').focus();
                return false;
            }
            
            // Aadhaar number validation (if provided)
            const aadhaar = document.getElementById('aadhaar_number').value.replace(/[^0-9]/g, '');
            if (aadhaar && aadhaar.length !== 12) {
                e.preventDefault();
                alert('Aadhaar number must be exactly 12 digits if provided.');
                document.getElementById('aadhaar_number').focus();
                return false;
            }
        });
        
        // Calculate age as on 1st June when date of birth changes
        document.getElementById('date_of_birth').addEventListener('change', function() {
            const dob = new Date(this.value);
            const june1 = new Date(new Date().getFullYear(), 5, 1);
            const age = june1.getFullYear() - dob.getFullYear();
            document.getElementById('age_as_on_june').value = age;
        });
        
        // Set current date as default for declaration date
        if (!document.getElementById('declaration_date').value) {
            document.getElementById('declaration_date').valueAsDate = new Date();
        }
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
