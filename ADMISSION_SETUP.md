# GM Legacy School - Admission Application Form Setup Guide

## Overview
The admission application form is a comprehensive modal popup that collects detailed student and parent information for school admissions. It uses the existing `admission_applications` table from the database setup.

## Database Setup
The admission form uses the `admission_applications` table which should already be created if you ran the `database/setup.sql` file. If not, ensure this table exists:

```sql
CREATE TABLE IF NOT EXISTS `admission_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_no` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age_as_on_june` int(3) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `religion_community` varchar(100) DEFAULT NULL,
  `mother_tongue` varchar(100) NOT NULL,
  `aadhaar_number` varchar(12) DEFAULT NULL,
  `class_sought` varchar(50) NOT NULL,
  `previous_school` varchar(100) DEFAULT NULL,
  `medium_of_instruction` varchar(50) NOT NULL,
  `fathers_name` varchar(100) NOT NULL,
  `fathers_qualification` varchar(100) NOT NULL,
  `fathers_occupation` varchar(100) NOT NULL,
  `fathers_mobile` varchar(20) NOT NULL,
  `mothers_name` varchar(100) NOT NULL,
  `mothers_qualification` varchar(100) NOT NULL,
  `mothers_occupation` varchar(100) NOT NULL,
  `mothers_mobile` varchar(20) NOT NULL,
  `annual_family_income` varchar(50) DEFAULT NULL,
  `residential_address` text NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `parent_signature` varchar(100) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `declaration_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_application_no` (`application_no`),
  KEY `idx_academic_year` (`academic_year`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Files Created/Modified

### New Files:
1. **`admission_handler.php`** - Backend PHP script to handle form submissions
2. **`ADMISSION_SETUP.md`** - This setup guide

### Modified Files:
1. **`index.html`** - Added admission form modal HTML
2. **`css/style.css`** - Added admission form styling
3. **`js/main.js`** - Added admission form JavaScript functionality

## Form Structure

### A. Student Information
- Full Name of the Student *
- Date of Birth (as per Birth Certificate) *
- Age as on 1st June * (auto-calculated)
- Gender * (Male/Female/Other)
- Nationality * (defaults to "Indian")
- Religion/Community (Optional)
- Mother Tongue *
- Aadhaar Number (if available)

### B. Admission Details
- Class for which Admission is sought *
- Previous School Name (if applicable)
- Medium of Instruction *

### C. Parent/Guardian Details
#### Father's Details:
- Name *
- Qualification *
- Occupation *
- Mobile Number *

#### Mother's Details:
- Name *
- Qualification *
- Occupation *
- Mobile Number *

#### Additional:
- Annual Family Income (Optional)

### D. Address
- Residential Address *
- Emergency Contact Number *

### E. Declaration
- Declaration text with agreement checkbox *
- Parent/Guardian Name *
- Date *

## Features

### Auto-Generated Application Number
- Format: `GMLS{YEAR}{4-digit-random}`
- Example: `GMLS20240123`
- Unique for each application

### Smart Age Calculation
- Automatically calculates age as on June 1st when date of birth is entered
- Validates age range (3-18 years)

### Comprehensive Validation
- **Client-side**: Real-time validation with user-friendly messages
- **Server-side**: Complete validation in PHP
- **Mobile Numbers**: 10-digit validation for all phone fields
- **Aadhaar**: 12-digit validation if provided
- **Required Fields**: All mandatory fields must be filled

### Responsive Design
- Works seamlessly on desktop, tablet, and mobile
- Optimized form layout for different screen sizes
- Touch-friendly interface for mobile users

### User Experience
- **Modal Popup**: Clean, professional interface
- **Auto-focus**: Focuses on first field when opened
- **Keyboard Support**: ESC key to close modal
- **Loading States**: Visual feedback during submission
- **Success/Error Messages**: Clear feedback to users

## Usage

### Opening the Form
The admission form opens when:
1. Clicking "Admission Process" in the Information section
2. Calling `openAdmissionModal()` function
3. Any link with `onclick="openAdmissionModal()"`

### Form Submission Process
1. User fills all required fields
2. Client-side validation runs
3. Form data sent to `admission_handler.php`
4. Server-side validation and database insertion
5. Success response with application number
6. Form closes automatically after 5 seconds

### Database Storage
All applications are stored with:
- Unique application number
- Complete form data
- Timestamp of submission
- Indexed fields for efficient searching

## Configuration

### Database Connection
Update credentials in `admission_handler.php`:
```php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "gm_legacy";
```

### Email Notifications (Optional)
Uncomment the email section in `admission_handler.php`:
```php
$to = "admissions@gmls.ac.in";
$subject = "New Admission Application - " . $input['full_name'];
// ... email configuration
mail($to, $subject, $message, $headers);
```

### Academic Years
Update available academic years in the form:
```html
<option value="2024-25">2024-25</option>
<option value="2025-26">2025-26</option>
<option value="2026-27">2026-27</option>
```

### Class Options
Modify available classes in both forms:
```html
<option value="Pre-KG">Pre-KG</option>
<option value="LKG">LKG</option>
<!-- Add/remove classes as needed -->
```

## Security Features

### Input Validation
- All inputs sanitized and validated
- SQL injection protection using prepared statements
- XSS protection through proper data handling

### Data Integrity
- Required field validation
- Format validation (phone, Aadhaar, email)
- Age range validation
- Unique application number generation

## Troubleshooting

### Common Issues
1. **Modal not opening**: Check JavaScript console for errors
2. **Form not submitting**: Verify PHP file path and database connection
3. **Validation errors**: Check required field completion
4. **Database errors**: Verify table structure and credentials

### Browser Support
- Modern browsers (Chrome, Firefox, Safari, Edge)
- JavaScript required for modal functionality
- Mobile responsive design

## Integration with Existing System

### Enquiry to Admission Flow
Users can:
1. Start with enquiry form (basic information)
2. Proceed to admission application (detailed information)
3. Both forms store data in separate tables
4. Can be linked via email/phone for follow-up

### Data Management
- Both enquiry and admission data stored separately
- Can be exported for analysis
- Indexed for efficient searching
- Timestamped for tracking

## Customization Options

### Styling
Modify CSS variables in `css/style.css`:
```css
:root {
    --primary-color: #651e21;
    --secondary-color: #e9c66f;
    /* Customize colors as needed */
}
```

### Form Fields
Add/remove fields by:
1. Updating HTML form structure
2. Modifying database table
3. Updating PHP validation and insertion
4. Adjusting JavaScript validation

### Workflow Integration
- Add email notifications
- Integrate with payment systems
- Connect to document upload systems
- Link with interview scheduling

This admission form provides a complete solution for collecting detailed student applications with professional presentation and robust data handling.