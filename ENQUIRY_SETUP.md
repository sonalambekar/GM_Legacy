# GM Legacy School - Enquiry Form Setup Guide

## Database Setup

### 1. Create Database
Run the SQL commands from `database/setup.sql` in your MySQL/phpMyAdmin:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS `gm_legacy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE `gm_legacy`;

-- Run the table creation queries from setup.sql
```

### 2. Configure Database Connection
Update the database credentials in `config/database.php`:

```php
return [
    'host' => 'localhost',        // Your database host
    'username' => 'your_username', // Your database username
    'password' => 'your_password', // Your database password
    'database' => 'gm_legacy',     // Database name
    'charset' => 'utf8mb4'
];
```

### 3. Update PHP Handler (if needed)
If you're using the config file, update `enquiry_handler.php` to use it:

```php
// Replace the database configuration section with:
$config = require_once 'config/database.php';
$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
```

## Features

### Enquiry Form Modal
- **Responsive Design**: Works on all devices
- **Form Validation**: Client-side and server-side validation
- **Database Storage**: All enquiries are stored in the database
- **User-Friendly**: Clean, professional interface

### Form Fields
1. **Student Details**
   - Name of the Child
   - Date of Birth
   - Gender (Male/Female/Other)
   - Class Seeking Admission
   - Academic Year

2. **Parent/Guardian Details**
   - Father's Name
   - Mother's Name
   - Occupation
   - Contact Number (10 digits)
   - Email ID

3. **Address**
   - Residential Address

4. **Source Information**
   - How they learned about the school (checkboxes)
   - Other sources (text field)

5. **Additional Information**
   - Remarks/Queries
   - Digital signature acknowledgment
   - Date

### Security Features
- **Input Validation**: All inputs are validated
- **SQL Injection Protection**: Using prepared statements
- **XSS Protection**: Proper data sanitization
- **CSRF Protection**: Can be added if needed

## Usage

### Opening the Form
The enquiry form can be opened by:
1. Clicking "Enquiry Form" in the Information section
2. Clicking "Contact Details" button
3. Any link with `onclick="openEnquiryModal()"`

### Form Submission
1. Fill all required fields (marked with *)
2. Click "Submit Enquiry"
3. Success/error message will be displayed
4. Form closes automatically after successful submission

### Database Records
All enquiry submissions are stored in the `enquiry_form` table with:
- Unique ID
- All form data
- Timestamp of submission
- Indexed fields for efficient searching

## Customization

### Email Notifications (Optional)
Uncomment the email section in `enquiry_handler.php` to send notifications:

```php
$to = "admissions@gmls.ac.in";
$subject = "New Admission Enquiry - " . $input['child_name'];
// ... email code
mail($to, $subject, $message, $headers);
```

### Styling
Modify the CSS in `css/style.css` under the "ENQUIRY FORM MODAL STYLES" section.

### Form Fields
Add/modify fields by:
1. Updating the HTML form in `index.html`
2. Updating the database table structure
3. Updating the PHP handler validation and insertion

## Troubleshooting

### Common Issues
1. **Database Connection Error**: Check credentials in config
2. **Form Not Submitting**: Check browser console for JavaScript errors
3. **Modal Not Opening**: Ensure JavaScript is loaded properly
4. **Validation Errors**: Check required field validation

### Browser Compatibility
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile responsive design
- JavaScript required for modal functionality

## File Structure
```
/
├── index.html (contains the modal HTML)
├── css/style.css (contains modal styles)
├── js/main.js (contains modal functionality)
├── enquiry_handler.php (handles form submission)
├── config/database.php (database configuration)
├── database/setup.sql (database structure)
└── ENQUIRY_SETUP.md (this file)
```