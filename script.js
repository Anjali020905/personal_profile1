// script.js

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Mobile Menu Toggle ---
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        hamburger.classList.toggle('toggle');
    });

    // Close mobile menu when a link is clicked
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            hamburger.classList.remove('toggle');
        });
    });

    // --- Dark Mode Toggle ---
    const themeToggleBtn = document.getElementById('theme-toggle');
    // Check local storage for theme preference
    const currentTheme = localStorage.getItem('theme') || 'light';

    if (currentTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        themeToggleBtn.textContent = '☀️'; // Sun icon for dark mode
    }

    themeToggleBtn.addEventListener('click', () => {
        let theme = document.documentElement.getAttribute('data-theme');
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
            themeToggleBtn.textContent = '🌓';
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            themeToggleBtn.textContent = '☀️';
        }
    });

    // --- Scroll Animations (Fade-in) ---
    const fadeElements = document.querySelectorAll('.fade-in');

    const checkVisibility = () => {
        // Trigger point is 85% down the window height
        const triggerBottom = window.innerHeight * 0.85;

        fadeElements.forEach(el => {
            const boxTop = el.getBoundingClientRect().top;
            if (boxTop < triggerBottom) {
                el.classList.add('visible');
            }
        });
    };

    window.addEventListener('scroll', checkVisibility);
    // Run once on load to reveal elements already in viewport
    checkVisibility(); 

    // --- Contact Form Validation and AJAX Submission ---
    const contactForm = document.getElementById('contact-form');
    const formMessage = document.getElementById('form-message');

    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // Prevent standard form submission

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        // 1. Basic Validation (before PHP)
        if (!name || !email || !message) {
            showMessage('Please fill in all fields.', 'error');
            return;
        }

        if (!isValidEmail(email)) {
            showMessage('Please enter a valid email address.', 'error');
            return;
        }

        // 2. Submit via Fetch API to PHP backend
        try {
            // If the user is viewing the file locally without a server (file:// protocol)
            if (window.location.protocol === 'file:') {
                // Simulate network delay
                await new Promise(resolve => setTimeout(resolve, 1000));
                showMessage('Thank you! Your message has been sent successfully. (Simulated local submission)', 'success');
                contactForm.reset();
                return;
            }

            const formData = new FormData(contactForm);
            
            // Send POST request to contact.php
            const response = await fetch('contact.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            // 3. Show Success/Error message
            if (result.success) {
                showMessage(result.message, 'success');
                contactForm.reset(); // Clear form fields
            } else {
                showMessage(result.message, 'error');
            }
        } catch (error) {
            showMessage('An error occurred. Please try again later.', 'error');
            console.error('Form submission error:', error);
        }
    });

    // Helper function to display messages
    function showMessage(msg, type) {
        formMessage.textContent = msg;
        formMessage.className = `form-message ${type}`;
        formMessage.classList.remove('hidden');

        // Hide message after 5 seconds
        setTimeout(() => {
            formMessage.classList.add('hidden');
        }, 5000);
    }

    // Helper function for email validation using regex
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
