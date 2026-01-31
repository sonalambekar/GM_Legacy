# GM Legacy School - Provisional Admission Letter Setup Guide

## Overview
The Provisional Admission Letter system allows school administrators to generate official provisional admission letters for selected students. The system includes a form to collect necessary details and generates a professional letter that can be printed or downloaded.

## Database Setup

### New Table Required
Add this table to your database by running the SQL from `database/setup.sql`:

```sql
CREATE TABLE IF NOT EXISTS `provisional_admission_letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter_no` varchar(50) NOT NULL,
  `issue_date` date NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `parent_address` text NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `class_admitted` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `admission_deadline` date NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `application_reference` varchar(50) DEFAULT NULL,
  `status` enum('Generated','Sent','Acknowledged') DEFAULT 'Generated',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_letter_no` (`letter_no`),
  KEY `idx_student_name` (`student_name`),
  KEY `idx_academic_year` (`academic_year`),
  KEY `idx_status` (`status`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Files Created/Modified

### New Files:
1. **`provisional_admission_handler.php`** - Backend PHP script to handle letter generation
2. **`PROVISIONAL_ADMISSION_SETUP.md`** - This setup guide

### Modified Files:
1. **`index.html`** - Added provisional admission letter modal HTML and new card
2. **`css/style.css`** - Added provisional admission letter styling
3. **`js/main.js`** - Added provisional admission letter JavaScript functionality
4. **`database/setup.sql`** - Added new table structure

## Form Structure

### Letter Details
- **Issue Date** * (defaults to today)
- **Academic Year** * (dropdown selection)

### Parent/Guardian Information
- **Parent/Guardian Name** * (Mr./Mrs. format)
- **Contact Number** * (10-digit validation)
- **Parent Address** * (complete residential address)
- **Email ID** (optional, for notifications)
- **Application Reference** (optional, existing application number)

### Student Information
- **Student Name** * (full name of the student)
- **Class for Admission** * (dropdown from Pre-KG to Class 10)

### Admission Timeline
- **Admission Formalities Deadline** * (auto-set to 15 days from issue date)

## Features

### Auto-Generated Letter Number
- **Format**: `GMLS/PAL/{YEAR}/{3-digit-random}`
- **Example**: `GMLS/PAL/2024/123`
- **Unique**: Each letter gets a unique number for tracking

### Smart Date Validation
- **Issue Date**: Defaults to current date
- **Deadline Validation**: Ensures deadline is at least 7 days after issue date
- **Auto-Suggestion**: Suggests 15-day deadline from issue date

### Professional Letter Format
The generated letter includes:
- **Official Letterhead**: School name and trust details
- **Letter Number**: Unique tracking number
- **Recipient Details**: Parent name and address
- **Subject Line**: Clear provisional admission subject
- **Body Content**: 
  - Congratulatory message
  - Provisional admission confirmation
  - Conditions for final admission
  - Required documents list
  - Deadline for formalities
- **Official Signature**: Principal signature and school seal

### Letter Preview & Actions
- **Preview Modal**: Shows formatted letter before printing
- **Print Function**: Opens print dialog for immediate printing
- **Download Function**: Downloads letter as HTML file
- **Professional Layout**: Print-optimized formatting

## Letter Content Structure

### Standard Letter Format:
```
GM LEGACY SCHOOL
(Under Srishyla Education Trust, Davanagere)
Date: [Issue Date]

Letter No: [Auto-generated]

To,
Mr./Mrs. [Parent Name]
Address: [Parent Address]

Subject: Provisional Admission Offer – Academic Year [Year]

Dear Sir/Madam,

We are pleased to inform you that your ward [Student Name] has been 
provisionally selected for admission to Class [Class] at GM Legacy School 
for the Academic Year [Year].

This provisional admission is subject to:
• Verification of original documents
• Payment of prescribed admission and school fees
• Fulfilment of eligibility criteria as per CBSE norms

You are requested to complete the admission formalities on or before [Deadline].

Required documents to be produced:
• Birth Certificate (Original & Copy)
• Previous School Report Card (if applicable)
• Transfer Certificate (if applicable)
• Aadhaar Card (if available)
• Two Passport Size Photographs

We look forward to welcoming your child to GM Legacy School.

With regards,

Principal
GM Legacy School
Signature & Seal
```

## Usage Workflow

### 1. Opening the Form
- Click "Provisional Admission Letter" in the Information section
- Form opens with pre-filled dates and default values

### 2. Filling the Form
- Enter parent/guardian details
- Enter student information
- Verify admission timeline
- Optional: Add application reference

### 3. Letter Generation
- Form validates all required fields
- Generates unique letter number
- Stores data in database
- Creates formatted letter content

### 4. Letter Preview
- Shows professional letter layout
- Provides print and download options
- Allows review before final action

### 5. Letter Actions
- **Print**: Opens browser print dialog
- **Download**: Saves as HTML file
- **Close**: Returns to main interface

## Configuration

### Database Connection
Update credentials in `provisional_admission_handler.php`:
```php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "gm_legacy";
```

### Email Notifications (Optional)
Uncomment the email section in `provisional_admission_handler.php`:
```php
if (!empty($input['email_id'])) {
    $to = $input['email_id'];
    $subject = "Provisional Admission Letter - " . $input['student_name'];
    // ... email configuration
    mail($to, $subject, $message, $headers);
}
```

### Academic Years
Update available academic years:
```html
<option value="2024-25">2024-25</option>
<option value="2025-26">2025-26</option>
<option value="2026-27">2026-27</option>
```

### Class Options
Modify available classes:
```html
<option value="Pre-KG">Pre-KG</option>
<option value="LKG">LKG</option>
<!-- Add/remove classes as needed -->
```

## Security Features

### Input Validation
- **Required Field Validation**: All mandatory fields must be filled
- **Phone Number Validation**: 10-digit format validation
- **Email Validation**: Proper email format if provided
- **Date Validation**: Logical date relationships

### Data Security
- **SQL Injection Protection**: Prepared statements
- **XSS Protection**: Proper data sanitization
- **Unique Letter Numbers**: Prevents duplicate letters
- **Audit Trail**: Timestamps for all letters

## Integration with Existing System

### Workflow Integration
1. **Enquiry Form** → Basic interest capture
2. **Admission Application** → Detailed application
3. **Provisional Admission Letter** → Admission offer
4. **Final Admission** → Document verification & fee payment

### Data Relationships
- Can reference existing application numbers
- Links to parent contact information
- Tracks admission pipeline progress

## Customization Options

### Letter Template
Modify the `generateLetterContent()` function in `provisional_admission_handler.php`:
- Change letterhead design
- Modify content structure
- Add/remove required documents
- Customize signature section

### Styling
Update CSS for letter preview:
```css
.letter-preview-body {
    /* Customize letter appearance */
    font-family: 'Times New Roman', serif;
    line-height: 1.6;
    color: #000;
}
```

### Validation Rules
Adjust validation in JavaScript:
- Modify deadline minimum days
- Change phone number format
- Add additional field validations

## Troubleshooting

### Common Issues
1. **Letter not generating**: Check database connection and table structure
2. **Print not working**: Ensure popup blockers are disabled
3. **Download failing**: Check browser download permissions
4. **Date validation errors**: Verify date format and logic

### Browser Compatibility
- **Modern Browsers**: Chrome, Firefox, Safari, Edge
- **Print Support**: All major browsers
- **Download Support**: HTML5 compatible browsers
- **Mobile Responsive**: Touch-friendly interface

## Administrative Features

### Letter Tracking
- **Unique Numbers**: Each letter has trackable number
- **Status Tracking**: Generated, Sent, Acknowledged
- **Database Records**: Complete audit trail
- **Search Capability**: Find letters by student name, date, etc.

### Reporting Capabilities
Query examples for administrative reports:
```sql
-- Letters generated today
SELECT * FROM provisional_admission_letters WHERE DATE(created_at) = CURDATE();

-- Letters by academic year
SELECT * FROM provisional_admission_letters WHERE academic_year = '2024-25';

-- Pending acknowledgments
SELECT * FROM provisional_admission_letters WHERE status = 'Generated';
```

This provisional admission letter system provides a complete solution for generating professional admission offers with proper tracking and administrative oversight.