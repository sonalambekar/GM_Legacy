/* ===================================
   GM Legacy School - Main JavaScript
   =================================== */

// Initialize all components when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    initializeSite();
});

// Expose initialization function globaly
window.initializeSite = function () {
    // Initialize all components
    initMobileNav();
    initSmoothScroll();
    initScrollSpy();
    initScrollAnimations();
    initDropdowns();
    initHeaderScroll();
    initGalleryLightbox();
};

/* ===================================
   MOBILE NAVIGATION - Enhanced Responsive Support
   =================================== */
function initMobileNav() {
    // Modern Header Elements
    const hamburger = document.getElementById('hamburger') || document.querySelector('.modern-hamburger');
    const navMenu = document.querySelector('.nav-menu-modern');
    const dropdowns = document.querySelectorAll('.nav-menu-modern .dropdown');

    // Legacy Elements (in case needed)
    const legacyHamburger = document.querySelector('.hamburger');
    const navContentWrap = document.querySelector('.nav-content-wrap');

    // Modern Nav Logic
    if (hamburger && navMenu) {
        // Toggle mobile menu
        hamburger.addEventListener('click', function (e) {
            e.stopPropagation();
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (e) {
            if (navMenu.classList.contains('active')) {
                if (!navMenu.contains(e.target) && !hamburger.contains(e.target)) {
                    navMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            }
        });

        // Handle dropdowns on mobile
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('a');

            if (link) {
                link.addEventListener('click', function (e) {
                    // Check if we are in mobile view
                    if (window.innerWidth <= 1200) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Close other dropdowns 
                        dropdowns.forEach(other => {
                            if (other !== dropdown) {
                                other.classList.remove('active');
                            }
                        });

                        // Toggle current dropdown
                        dropdown.classList.toggle('active');
                    }
                });
            }
        });

        // Handle links inside dropdowns
        const subLinks = navMenu.querySelectorAll('.dropdown-content a');
        subLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                // Allow navigation, close menu
                // Don't prevent default, let it navigate
                e.stopPropagation();
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        // Handle normal links
        const directLinks = navMenu.querySelectorAll('li:not(.dropdown) > a');
        directLinks.forEach(link => {
            link.addEventListener('click', function () {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });
    }

    // Legacy Nav Logic (Simplified fallback)
    if (legacyHamburger) {
        legacyHamburger.addEventListener('click', function (e) {
            e.stopPropagation();
            this.classList.toggle('active');
            if (navContentWrap) navContentWrap.classList.toggle('active');
        });
    }

    // Handle window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1200) {
            if (hamburger) hamburger.classList.remove('active');
            if (navMenu) navMenu.classList.remove('active');
            if (dropdowns) dropdowns.forEach(d => d.classList.remove('active'));
        }
    });
}

/* ===================================
   DROPDOWN MENUS (Desktop and Mobile)
   =================================== */
function initDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.nav-link');
        const content = dropdown.querySelector('.dropdown-content');

        if (toggle && content) {
            // Desktop hover behavior
            if (window.innerWidth > 1100) {
                dropdown.addEventListener('mouseenter', function () {
                    this.classList.add('active');
                });

                dropdown.addEventListener('mouseleave', function () {
                    this.classList.remove('active');
                });
            }

            // Click behavior for both desktop and mobile
            toggle.addEventListener('click', function (e) {
                // On mobile, handle dropdown toggle
                if (window.innerWidth <= 1100) {
                    e.preventDefault();
                    e.stopPropagation();

                    const isActive = dropdown.classList.contains('active');

                    // Close all other dropdowns
                    dropdowns.forEach(other => {
                        if (other !== dropdown) {
                            other.classList.remove('active');
                        }
                    });

                    // Toggle current dropdown
                    dropdown.classList.toggle('active');
                }
                // On desktop, let the link work normally if it has a valid href
                else {
                    const href = toggle.getAttribute('href');
                    if (href && href !== '#' && !href.startsWith('#')) {
                        // Let the link navigate normally
                        return;
                    } else {
                        e.preventDefault();
                    }
                }
            });
        }
    });

    // Close dropdowns when clicking anywhere else on the document
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });

    // Handle window resize to reset dropdown behavior
    window.addEventListener('resize', function () {
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    });
}

/* ===================================
   SMOOTH SCROLLING
   =================================== */
/* ===================================
   SMOOTH SCROLLING
   =================================== */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href*="#"]');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            // Handle links like "index.html#about" when on index.html
            const targetId = href.split('#')[1];
            const targetPath = href.split('#')[0];

            // Get current page filename
            const currentPath = window.location.pathname.split('/').pop() || 'index.html';

            // Proceed only if target is on the same page
            if (targetId && (targetPath === '' || targetPath === currentPath || (targetPath === 'index.html' && currentPath === ''))) {
                const target = document.getElementById(targetId);

                if (target) {
                    e.preventDefault();

                    const header = document.querySelector('.header');
                    const headerHeight = header ? header.offsetHeight : 0;
                    const targetPosition = target.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
}

/* ===================================
   SCROLL ANIMATIONS
   =================================== */
function initScrollAnimations() {
    // Exclude access-card from animations to keep them visible
    const animatedElements = document.querySelectorAll('.feature-card, .about-content, .section-title, .animate-on-scroll:not(.access-card)');

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => {
        // Only apply animation styles to non-access-card elements
        if (!el.classList.contains('access-card')) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        }
    });

    // Add CSS for animated elements
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

    // Initialize hero animations on page load
    initHeroAnimations();
}

/* ===================================
   HERO ANIMATIONS
   =================================== */
function initHeroAnimations() {
    const heroContent = document.querySelector('.hero-content');

    if (heroContent) {
        // Add staggered animation classes to hero elements
        const heroTitle = heroContent.querySelector('h1');
        const heroSubtitle = heroContent.querySelector('p');
        const heroButton = heroContent.querySelector('.hero-btn');

        // Reset animations on page load/refresh
        setTimeout(() => {
            if (heroTitle) heroTitle.style.animationPlayState = 'running';
            if (heroSubtitle) heroSubtitle.style.animationPlayState = 'running';
            if (heroButton) heroButton.style.animationPlayState = 'running';
        }, 100);
    }

    // Ensure quick access cards are always visible - no animation needed
    const quickAccessCards = document.querySelectorAll('.access-card');
    const quickAccessSection = document.querySelector('.quick-access');
    const quickAccessGrid = document.querySelector('.quick-access-grid');

    // Force visibility on the entire quick access section
    if (quickAccessSection) {
        quickAccessSection.style.opacity = '1';
        quickAccessSection.style.visibility = 'visible';
        quickAccessSection.style.display = 'block';
    }

    if (quickAccessGrid) {
        quickAccessGrid.style.opacity = '1';
        quickAccessGrid.style.visibility = 'visible';
        quickAccessGrid.style.display = 'grid';
    }

    quickAccessCards.forEach((card) => {
        // Ensure cards are visible and not affected by scroll animations
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
        card.style.visibility = 'visible';
        card.style.display = 'flex';

        // Remove any animation classes that might interfere
        card.classList.remove('animate-on-scroll');
    });
}

/* ===================================
   HEADER SCROLL EFFECT
   =================================== */
function initHeaderScroll() {
    const header = document.querySelector('.header');
    let lastScroll = 0;

    window.addEventListener('scroll', function () {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.2)';
        } else {
            header.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.15)';
        }

        // Hide/show header on scroll (optional, uncomment to enable)
        /*
        if (currentScroll > lastScroll && currentScroll > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        */

        lastScroll = currentScroll;
    });
}

/* ===================================
   UTILITY FUNCTIONS
   =================================== */

// Debounce function for performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Handle window resize
window.addEventListener('resize', debounce(function () {
    // Reset mobile menu on resize to desktop
    if (window.innerWidth > 768) {
        const hamburger = document.querySelector('.hamburger');
        const navRows = document.querySelectorAll('.nav-row');

        if (hamburger) {
            hamburger.classList.remove('active');
        }

        navRows.forEach(row => {
            row.classList.remove('active');
        });

        document.body.style.overflow = '';

        // Reset dropdowns
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    }
}, 250));

/* ===================================
   GALLERY LIGHTBOX (Optional)
   =================================== */
function initGalleryLightbox() {
    const galleryItems = document.querySelectorAll('.gallery-item');

    if (galleryItems.length === 0) return;

    // Create lightbox elements
    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox';
    lightbox.innerHTML = `
        <div class="lightbox-content">
            <span class="lightbox-close">&times;</span>
            <img src="" alt="Gallery Image" class="lightbox-image">
        </div>
    `;
    document.body.appendChild(lightbox);

    const lightboxImage = lightbox.querySelector('.lightbox-image');
    const lightboxClose = lightbox.querySelector('.lightbox-close');

    // Open lightbox
    galleryItems.forEach(item => {
        item.addEventListener('click', function () {
            const imgSrc = this.querySelector('img').src;
            lightboxImage.src = imgSrc;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close lightbox
    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            closeLightbox();
        }
    });

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Add lightbox styles
    const style = document.createElement('style');
    style.textContent = `
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            z-index: 9999;
        }
        .lightbox.active {
            opacity: 1;
            visibility: visible;
        }
        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }
        .lightbox-image {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }
        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 35px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .lightbox-close:hover {
            transform: scale(1.2);
        }
    `;
    document.head.appendChild(style);
}

// Initialize gallery if exists
// Gallery initialized in window.initializeSite

/* ===================================
   SCROLL SPY (Active Link Highlight)
   =================================== */
function initScrollSpy() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-menu a');

    if (sections.length === 0 || navLinks.length === 0) return;

    window.addEventListener('scroll', function () {
        let current = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            // Adjustment for header height (approx 180px for two rows)
            if (window.scrollY >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        if (current) {
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                // Remove active class from all
                link.classList.remove('active');

                // Add active class if it matches current section
                // Handles absolute links "index.html#about" vs "#about"
                if (href && (href === '#' + current || href.endsWith('index.html#' + current))) {
                    link.classList.add('active');
                }
            });
        }
    });
}

/* ===================================
   ENQUIRY FORM MODAL FUNCTIONALITY
   =================================== */

// Initialize enquiry form when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initEnquiryForm();
});

function initEnquiryForm() {
    const modal = document.getElementById('enquiryModal');
    const form = document.getElementById('enquiryForm');
    const closeBtn = document.querySelector('.enquiry-close');
    
    if (!modal || !form) return;
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('signature_date').value = today;
    
    // Close modal events
    closeBtn.addEventListener('click', closeEnquiryModal);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeEnquiryModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeEnquiryModal();
        }
    });
    
    // Handle form submission
    form.addEventListener('submit', handleEnquirySubmission);
    
    // Add click event to enquiry form links
    const enquiryLinks = document.querySelectorAll('a[href="#contact"], a[href*="enquiry"]');
    enquiryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            openEnquiryModal();
        });
    });
}

function openEnquiryModal() {
    const modal = document.getElementById('enquiryModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = modal.querySelector('input[type="text"]');
            if (firstInput) firstInput.focus();
        }, 300);
    }
}

function closeEnquiryModal() {
    const modal = document.getElementById('enquiryModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Reset form
        const form = document.getElementById('enquiryForm');
        if (form) {
            form.reset();
            // Reset date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('signature_date').value = today;
            
            // Remove any messages
            const existingMessage = form.querySelector('.form-message');
            if (existingMessage) {
                existingMessage.remove();
            }
        }
    }
}

async function handleEnquirySubmission(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('.btn-submit');
    const formData = new FormData(form);
    
    // Convert FormData to JSON
    const data = {};
    
    // Handle regular form fields
    for (let [key, value] of formData.entries()) {
        if (key.startsWith('source_')) {
            data[key] = true; // Checkbox fields
        } else {
            data[key] = value;
        }
    }
    
    // Handle checkboxes that weren't checked
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        if (!checkbox.checked) {
            data[checkbox.name] = false;
        }
    });
    
    // Validate required fields
    const requiredFields = ['child_name', 'date_of_birth', 'gender', 'class_seeking', 
                           'academic_year', 'father_name', 'mother_name', 'occupation',
                           'contact_number', 'email_id', 'residential_address', 'signature_date'];
    
    for (let field of requiredFields) {
        if (!data[field] || data[field].trim() === '') {
            showFormMessage('Please fill in all required fields.', 'error');
            return;
        }
    }
    
    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(data.email_id)) {
        showFormMessage('Please enter a valid email address.', 'error');
        return;
    }
    
    // Validate phone number
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(data.contact_number)) {
        showFormMessage('Please enter a valid 10-digit contact number.', 'error');
        return;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';
    form.classList.add('form-loading');
    
    try {
        const response = await fetch('enquiry_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showFormMessage('Thank you! Your enquiry has been submitted successfully. We will contact you soon.', 'success');
            
            // Reset form after successful submission
            setTimeout(() => {
                closeEnquiryModal();
            }, 3000);
            
        } else {
            showFormMessage(result.message || 'An error occurred. Please try again.', 'error');
        }
        
    } catch (error) {
        console.error('Error:', error);
        showFormMessage('Network error. Please check your connection and try again.', 'error');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Enquiry';
        form.classList.remove('form-loading');
    }
}

function showFormMessage(message, type) {
    const form = document.getElementById('enquiryForm');
    
    // Remove existing message
    const existingMessage = form.querySelector('.form-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Create new message
    const messageDiv = document.createElement('div');
    messageDiv.className = `form-message ${type}`;
    messageDiv.textContent = message;
    
    // Insert at the beginning of the form
    form.insertBefore(messageDiv, form.firstChild);
    
    // Scroll to top of form
    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    
    // Auto-remove error messages after 5 seconds
    if (type === 'error') {
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 5000);
    }
}

// Expose functions globally for onclick handlers
window.openEnquiryModal = openEnquiryModal;
window.closeEnquiryModal = closeEnquiryModal;
/* ===================================
   ADMISSION FORM MODAL FUNCTIONALITY
   =================================== */

// Initialize admission form when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initAdmissionForm();
});

function initAdmissionForm() {
    const modal = document.getElementById('admissionModal');
    const form = document.getElementById('admissionForm');
    const closeBtn = document.querySelector('.admission-close');
    
    if (!modal || !form) return;
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('declaration_date').value = today;
    
    // Close modal events
    closeBtn.addEventListener('click', closeAdmissionModal);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeAdmissionModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeAdmissionModal();
        }
    });
    
    // Handle form submission
    form.addEventListener('submit', handleAdmissionSubmission);
    
    // Add click event to admission process links
    const admissionLinks = document.querySelectorAll('a[href*="admission"], a[href*="process"]');
    admissionLinks.forEach(link => {
        // Only add event if it's the admission process card
        if (link.textContent.includes('Admission Process') || link.href.includes('process.html')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                openAdmissionModal();
            });
        }
    });
    
    // Auto-calculate age when date of birth changes
    const dobField = document.getElementById('date_of_birth_app');
    const ageField = document.getElementById('age_as_on_june');
    
    dobField.addEventListener('change', function() {
        const dob = new Date(this.value);
        const june1 = new Date(new Date().getFullYear(), 5, 1); // June 1st of current year
        
        if (dob && dob < june1) {
            const age = june1.getFullYear() - dob.getFullYear();
            const monthDiff = june1.getMonth() - dob.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && june1.getDate() < dob.getDate())) {
                ageField.value = age - 1;
            } else {
                ageField.value = age;
            }
        }
    });
}

function openAdmissionModal() {
    const modal = document.getElementById('admissionModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = modal.querySelector('select[name="academic_year"]');
            if (firstInput) firstInput.focus();
        }, 300);
    }
}

function closeAdmissionModal() {
    const modal = document.getElementById('admissionModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Reset form
        const form = document.getElementById('admissionForm');
        if (form) {
            form.reset();
            // Reset date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('declaration_date').value = today;
            
            // Reset nationality to default
            document.getElementById('nationality').value = 'Indian';
            
            // Remove any messages
            const existingMessage = form.querySelector('.form-message');
            if (existingMessage) {
                existingMessage.remove();
            }
        }
    }
}

async function handleAdmissionSubmission(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('.btn-submit');
    const formData = new FormData(form);
    
    // Convert FormData to JSON
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    // Check declaration agreement
    const declarationCheckbox = document.getElementById('declaration_agreement');
    if (!declarationCheckbox.checked) {
        showAdmissionMessage('Please agree to the declaration and terms & conditions.', 'error');
        return;
    }
    
    // Validate required fields
    const requiredFields = [
        'academic_year', 'full_name', 'date_of_birth', 'age_as_on_june', 
        'gender', 'nationality', 'mother_tongue', 'class_sought', 
        'medium_of_instruction', 'fathers_name', 'fathers_qualification',
        'fathers_occupation', 'fathers_mobile', 'mothers_name', 
        'mothers_qualification', 'mothers_occupation', 'mothers_mobile',
        'residential_address', 'emergency_contact', 'parent_name', 'declaration_date'
    ];
    
    for (let field of requiredFields) {
        if (!data[field] || data[field].trim() === '') {
            showAdmissionMessage('Please fill in all required fields.', 'error');
            return;
        }
    }
    
    // Validate mobile numbers
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(data.fathers_mobile)) {
        showAdmissionMessage('Please enter a valid 10-digit father\'s mobile number.', 'error');
        return;
    }
    
    if (!phoneRegex.test(data.mothers_mobile)) {
        showAdmissionMessage('Please enter a valid 10-digit mother\'s mobile number.', 'error');
        return;
    }
    
    if (!phoneRegex.test(data.emergency_contact)) {
        showAdmissionMessage('Please enter a valid 10-digit emergency contact number.', 'error');
        return;
    }
    
    // Validate Aadhaar number if provided
    if (data.aadhaar_number && !/^[0-9]{12}$/.test(data.aadhaar_number)) {
        showAdmissionMessage('Aadhaar number must be 12 digits.', 'error');
        return;
    }
    
    // Validate age
    const age = parseInt(data.age_as_on_june);
    if (age < 3 || age > 18) {
        showAdmissionMessage('Age must be between 3 and 18 years.', 'error');
        return;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting Application...';
    form.classList.add('form-loading');
    
    try {
        const response = await fetch('admission_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAdmissionMessage(
                `Application submitted successfully! Your Application Number is: ${result.application_no}. Please note this number for future reference.`, 
                'success'
            );
            
            // Reset form after successful submission
            setTimeout(() => {
                closeAdmissionModal();
            }, 5000);
            
        } else {
            showAdmissionMessage(result.message || 'An error occurred. Please try again.', 'error');
        }
        
    } catch (error) {
        console.error('Error:', error);
        showAdmissionMessage('Network error. Please check your connection and try again.', 'error');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Application';
        form.classList.remove('form-loading');
    }
}

function showAdmissionMessage(message, type) {
    const form = document.getElementById('admissionForm');
    
    // Remove existing message
    const existingMessage = form.querySelector('.form-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Create new message
    const messageDiv = document.createElement('div');
    messageDiv.className = `form-message ${type}`;
    messageDiv.textContent = message;
    
    // Insert at the beginning of the form
    form.insertBefore(messageDiv, form.firstChild);
    
    // Scroll to top of form
    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    
    // Auto-remove error messages after 7 seconds
    if (type === 'error') {
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 7000);
    }
}

// Expose functions globally for onclick handlers
window.openAdmissionModal = openAdmissionModal;
window.closeAdmissionModal = closeAdmissionModal;
/* ===================================
   PROVISIONAL ADMISSION LETTER MODAL FUNCTIONALITY
   =================================== */

// Initialize provisional admission form when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initProvisionalAdmissionForm();
});

function initProvisionalAdmissionForm() {
    const modal = document.getElementById('provisionalAdmissionModal');
    const form = document.getElementById('provisionalAdmissionForm');
    const closeBtn = document.querySelector('.provisional-admission-close');
    const previewModal = document.getElementById('letterPreviewModal');
    const previewCloseBtn = document.querySelector('.letter-preview-close');
    
    if (!modal || !form) return;
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('issue_date').value = today;
    
    // Set default deadline to 15 days from today
    const deadline = new Date();
    deadline.setDate(deadline.getDate() + 15);
    document.getElementById('admission_deadline').value = deadline.toISOString().split('T')[0];
    
    // Close modal events
    closeBtn.addEventListener('click', closeProvisionalAdmissionModal);
    previewCloseBtn.addEventListener('click', closeLetterPreview);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeProvisionalAdmissionModal();
        }
    });
    
    previewModal.addEventListener('click', function(e) {
        if (e.target === previewModal) {
            closeLetterPreview();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (previewModal.style.display === 'block') {
                closeLetterPreview();
            } else if (modal.style.display === 'block') {
                closeProvisionalAdmissionModal();
            }
        }
    });
    
    // Handle form submission
    form.addEventListener('submit', handleProvisionalAdmissionSubmission);
    
    // Validate deadline when issue date changes
    const issueDateField = document.getElementById('issue_date');
    const deadlineField = document.getElementById('admission_deadline');
    
    issueDateField.addEventListener('change', function() {
        const issueDate = new Date(this.value);
        const minDeadline = new Date(issueDate);
        minDeadline.setDate(minDeadline.getDate() + 7); // Minimum 7 days
        
        deadlineField.min = minDeadline.toISOString().split('T')[0];
        
        // If current deadline is before minimum, update it
        const currentDeadline = new Date(deadlineField.value);
        if (currentDeadline <= issueDate) {
            minDeadline.setDate(minDeadline.getDate() + 8); // Set to 15 days
            deadlineField.value = minDeadline.toISOString().split('T')[0];
        }
    });
}

function openProvisionalAdmissionModal() {
    const modal = document.getElementById('provisionalAdmissionModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = modal.querySelector('input[type="date"]');
            if (firstInput) firstInput.focus();
        }, 300);
    }
}

function closeProvisionalAdmissionModal() {
    const modal = document.getElementById('provisionalAdmissionModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Reset form
        const form = document.getElementById('provisionalAdmissionForm');
        if (form) {
            form.reset();
            // Reset dates to defaults
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('issue_date').value = today;
            
            const deadline = new Date();
            deadline.setDate(deadline.getDate() + 15);
            document.getElementById('admission_deadline').value = deadline.toISOString().split('T')[0];
            
            // Remove any messages
            const existingMessage = form.querySelector('.form-message');
            if (existingMessage) {
                existingMessage.remove();
            }
        }
    }
}

function closeLetterPreview() {
    const modal = document.getElementById('letterPreviewModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

async function handleProvisionalAdmissionSubmission(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('.btn-submit');
    const formData = new FormData(form);
    
    // Convert FormData to JSON
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    // Validate required fields
    const requiredFields = [
        'issue_date', 'academic_year', 'parent_name', 'contact_number',
        'parent_address', 'student_name', 'class_admitted', 'admission_deadline'
    ];
    
    for (let field of requiredFields) {
        if (!data[field] || data[field].trim() === '') {
            showProvisionalAdmissionMessage('Please fill in all required fields.', 'error');
            return;
        }
    }
    
    // Validate phone number
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(data.contact_number)) {
        showProvisionalAdmissionMessage('Please enter a valid 10-digit contact number.', 'error');
        return;
    }
    
    // Validate email if provided
    if (data.email_id && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email_id)) {
        showProvisionalAdmissionMessage('Please enter a valid email address.', 'error');
        return;
    }
    
    // Validate dates
    const issueDate = new Date(data.issue_date);
    const deadlineDate = new Date(data.admission_deadline);
    
    if (deadlineDate <= issueDate) {
        showProvisionalAdmissionMessage('Admission deadline must be after the issue date.', 'error');
        return;
    }
    
    const daysDiff = (deadlineDate - issueDate) / (1000 * 60 * 60 * 24);
    if (daysDiff < 7) {
        showProvisionalAdmissionMessage('Admission deadline should be at least 7 days from issue date.', 'error');
        return;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Generating Letter...';
    form.classList.add('form-loading');
    
    try {
        const response = await fetch('provisional_admission_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showProvisionalAdmissionMessage(
                `Letter generated successfully! Letter No: ${result.letter_no}`, 
                'success'
            );
            
            // Show letter preview
            setTimeout(() => {
                showLetterPreview(result.letter_content, result.letter_no);
                closeProvisionalAdmissionModal();
            }, 2000);
            
        } else {
            showProvisionalAdmissionMessage(result.message || 'An error occurred. Please try again.', 'error');
        }
        
    } catch (error) {
        console.error('Error:', error);
        showProvisionalAdmissionMessage('Network error. Please check your connection and try again.', 'error');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.textContent = 'Generate Letter';
        form.classList.remove('form-loading');
    }
}

function showProvisionalAdmissionMessage(message, type) {
    const form = document.getElementById('provisionalAdmissionForm');
    
    // Remove existing message
    const existingMessage = form.querySelector('.form-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Create new message
    const messageDiv = document.createElement('div');
    messageDiv.className = `form-message ${type}`;
    messageDiv.textContent = message;
    
    // Insert at the beginning of the form
    form.insertBefore(messageDiv, form.firstChild);
    
    // Scroll to top of form
    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    
    // Auto-remove error messages after 5 seconds
    if (type === 'error') {
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 5000);
    }
}

function showLetterPreview(letterContent, letterNo) {
    const modal = document.getElementById('letterPreviewModal');
    const contentDiv = document.getElementById('letterPreviewContent');
    
    if (modal && contentDiv) {
        contentDiv.innerHTML = letterContent;
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Store letter data for printing/downloading
        window.currentLetter = {
            content: letterContent,
            letterNo: letterNo
        };
    }
}

function printLetter() {
    if (window.currentLetter) {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Provisional Admission Letter - ${window.currentLetter.letterNo}</title>
                <style>
                    body { font-family: 'Times New Roman', serif; margin: 20px; line-height: 1.6; }
                    @media print { body { margin: 0; } }
                </style>
            </head>
            <body>
                ${window.currentLetter.content}
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
}

function downloadLetter() {
    if (window.currentLetter) {
        // Create a simple HTML file for download
        const htmlContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Provisional Admission Letter - ${window.currentLetter.letterNo}</title>
                <style>
                    body { font-family: 'Times New Roman', serif; margin: 20px; line-height: 1.6; }
                </style>
            </head>
            <body>
                ${window.currentLetter.content}
            </body>
            </html>
        `;
        
        const blob = new Blob([htmlContent], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `Provisional_Admission_Letter_${window.currentLetter.letterNo}.html`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }
}

// Expose functions globally for onclick handlers
window.openProvisionalAdmissionModal = openProvisionalAdmissionModal;
window.closeProvisionalAdmissionModal = closeProvisionalAdmissionModal;
window.closeLetterPreview = closeLetterPreview;
window.printLetter = printLetter;
window.downloadLetter = downloadLetter;
/* ===================================
   ADMISSION CONFIRMATION LETTER MODAL FUNCTIONALITY
   =================================== */

// Initialize admission confirmation form when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initAdmissionConfirmationForm();
});

function initAdmissionConfirmationForm() {
    const modal = document.getElementById('admissionConfirmationModal');
    const form = document.getElementById('admissionConfirmationForm');
    const closeBtn = document.querySelector('.admission-confirmation-close');
    
    if (!modal || !form) return;
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('issue_date_acl').value = today;
    
    // Set default joining date to next Monday or a reasonable future date
    const joiningDate = getNextSchoolStartDate();
    document.getElementById('joining_date').value = joiningDate.toISOString().split('T')[0];
    
    // Close modal events
    closeBtn.addEventListener('click', closeAdmissionConfirmationModal);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeAdmissionConfirmationModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeAdmissionConfirmationModal();
        }
    });
    
    // Handle form submission
    form.addEventListener('submit', handleAdmissionConfirmationSubmission);
    
    // Validate joining date when issue date changes
    const issueDateField = document.getElementById('issue_date_acl');
    const joiningDateField = document.getElementById('joining_date');
    
    issueDateField.addEventListener('change', function() {
        const issueDate = new Date(this.value);
        const minJoiningDate = new Date(issueDate);
        minJoiningDate.setDate(minJoiningDate.getDate() + 1); // Minimum next day
        
        joiningDateField.min = minJoiningDate.toISOString().split('T')[0];
        
        // If current joining date is before minimum, update it
        const currentJoiningDate = new Date(joiningDateField.value);
        if (currentJoiningDate <= issueDate) {
            const newJoiningDate = getNextSchoolStartDate(issueDate);
            joiningDateField.value = newJoiningDate.toISOString().split('T')[0];
        }
    });
}

function getNextSchoolStartDate(fromDate = new Date()) {
    const date = new Date(fromDate);
    date.setDate(date.getDate() + 7); // Default to next week
    
    // If it's weekend, move to next Monday
    const dayOfWeek = date.getDay();
    if (dayOfWeek === 0) { // Sunday
        date.setDate(date.getDate() + 1);
    } else if (dayOfWeek === 6) { // Saturday
        date.setDate(date.getDate() + 2);
    }
    
    return date;
}

function openAdmissionConfirmationModal() {
    const modal = document.getElementById('admissionConfirmationModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = modal.querySelector('input[type="date"]');
            if (firstInput) firstInput.focus();
        }, 300);
    }
}

function closeAdmissionConfirmationModal() {
    const modal = document.getElementById('admissionConfirmationModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Reset form
        const form = document.getElementById('admissionConfirmationForm');
        if (form) {
            form.reset();
            // Reset dates to defaults
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('issue_date_acl').value = today;
            
            const joiningDate = getNextSchoolStartDate();
            document.getElementById('joining_date').value = joiningDate.toISOString().split('T')[0];
            
            // Reset checkboxes to default
            document.getElementById('documents_verified').checked = true;
            document.getElementById('transport_required').checked = false;
            
            // Remove any messages
            const existingMessage = form.querySelector('.form-message');
            if (existingMessage) {
                existingMessage.remove();
            }
        }
    }
}

async function handleAdmissionConfirmationSubmission(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('.btn-submit');
    const formData = new FormData(form);
    
    // Convert FormData to JSON
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    // Handle checkboxes
    data.documents_verified = document.getElementById('documents_verified').checked;
    data.transport_required = document.getElementById('transport_required').checked;
    
    // Validate required fields
    const requiredFields = [
        'issue_date', 'academic_year', 'parent_name', 'contact_number',
        'parent_address', 'student_name', 'class_confirmed', 'joining_date'
    ];
    
    for (let field of requiredFields) {
        if (!data[field] || data[field].trim() === '') {
            showAdmissionConfirmationMessage('Please fill in all required fields.', 'error');
            return;
        }
    }
    
    // Validate phone number
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(data.contact_number)) {
        showAdmissionConfirmationMessage('Please enter a valid 10-digit contact number.', 'error');
        return;
    }
    
    // Validate email if provided
    if (data.email_id && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email_id)) {
        showAdmissionConfirmationMessage('Please enter a valid email address.', 'error');
        return;
    }
    
    // Validate dates
    const issueDate = new Date(data.issue_date);
    const joiningDate = new Date(data.joining_date);
    
    if (joiningDate <= issueDate) {
        showAdmissionConfirmationMessage('Joining date must be after the issue date.', 'error');
        return;
    }
    
    // Validate fees if provided
    if (data.fees_received && (isNaN(data.fees_received) || parseFloat(data.fees_received) <= 0)) {
        showAdmissionConfirmationMessage('Fees amount must be a valid positive number.', 'error');
        return;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Generating Confirmation Letter...';
    form.classList.add('form-loading');
    
    try {
        const response = await fetch('admission_confirmation_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAdmissionConfirmationMessage(
                `Confirmation letter generated successfully! Confirmation No: ${result.confirmation_no}`, 
                'success'
            );
            
            // Show letter preview
            setTimeout(() => {
                showLetterPreview(result.letter_content, result.confirmation_no);
                closeAdmissionConfirmationModal();
            }, 2000);
            
        } else {
            showAdmissionConfirmationMessage(result.message || 'An error occurred. Please try again.', 'error');
        }
        
    } catch (error) {
        console.error('Error:', error);
        showAdmissionConfirmationMessage('Network error. Please check your connection and try again.', 'error');
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.textContent = 'Generate Confirmation Letter';
        form.classList.remove('form-loading');
    }
}

function showAdmissionConfirmationMessage(message, type) {
    const form = document.getElementById('admissionConfirmationForm');
    
    // Remove existing message
    const existingMessage = form.querySelector('.form-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Create new message
    const messageDiv = document.createElement('div');
    messageDiv.className = `form-message ${type}`;
    messageDiv.textContent = message;
    
    // Insert at the beginning of the form
    form.insertBefore(messageDiv, form.firstChild);
    
    // Scroll to top of form
    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    
    // Auto-remove error messages after 5 seconds
    if (type === 'error') {
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 5000);
    }
}

// Expose functions globally for onclick handlers
window.openAdmissionConfirmationModal = openAdmissionConfirmationModal;
window.closeAdmissionConfirmationModal = closeAdmissionConfirmationModal;