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
   MOBILE NAVIGATION - Two Row Support
   =================================== */
function initMobileNav() {
    const hamburger = document.querySelector('.hamburger');
    const navRows = document.querySelectorAll('.nav-row');
    const navContainer = document.querySelector('.nav-container');

    if (!hamburger || navRows.length === 0) return;

    // Toggle mobile menu
    hamburger.addEventListener('click', function () {
        this.classList.toggle('active');

        // Toggle both nav rows
        navRows.forEach(row => {
            row.classList.toggle('active');
        });

        // Prevent body scroll when menu is open
        const isActive = navRows[0].classList.contains('active');
        document.body.style.overflow = isActive ? 'hidden' : '';
    });

    // Close menu when clicking on a link
    navRows.forEach(row => {
        const navLinks = row.querySelectorAll('a:not(.dropdown-toggle)');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                hamburger.classList.remove('active');
                navRows.forEach(r => r.classList.remove('active'));
                document.body.style.overflow = '';
            });
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (e) {
        let isClickInside = hamburger.contains(e.target);

        navRows.forEach(row => {
            if (row.contains(e.target)) {
                isClickInside = true;
            }
        });

        if (!isClickInside) {
            hamburger.classList.remove('active');
            navRows.forEach(r => r.classList.remove('active'));
            document.body.style.overflow = '';
        }
    });
}

/* ===================================
   DROPDOWN MENUS (Mobile)
   =================================== */
function initDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.nav-link');

        if (toggle) {
            toggle.addEventListener('click', function (e) {
                // Check if it's a dropdown toggle (has dropdown-content)
                const content = dropdown.querySelector('.dropdown-content');
                if (content) {
                    e.preventDefault();
                    e.stopPropagation();

                    const isActive = dropdown.classList.contains('active');

                    // Close all other dropdowns
                    dropdowns.forEach(other => {
                        other.classList.remove('active');
                    });

                    // Toggle current dropdown
                    if (!isActive) {
                        dropdown.classList.add('active');
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
