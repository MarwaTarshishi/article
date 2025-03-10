// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            // Get all required inputs
            const requiredInputs = form.querySelectorAll('[required]');
            let isValid = true;
            
            // Check each required field
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    showError(input, 'This field is required');
                } else {
                    clearError(input);
                    
                    // Email validation
                    if (input.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value)) {
                            isValid = false;
                            showError(input, 'Please enter a valid email address');
                        }
                    }
                    
                    // Password validation for signup form
                    if (input.name === 'password' && form.id === 'signup-form') {
                        if (input.value.length < 8) {
                            isValid = false;
                            showError(input, 'Password must be at least 8 characters');
                        }
                    }
                    
                    // Password confirmation validation
                    if (input.name === 'confirm-password') {
                        const password = form.querySelector('[name="password"]');
                        if (input.value !== password.value) {
                            isValid = false;
                            showError(input, 'Passwords do not match');
                        }
                    }
                }
            });
            
            // If validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
    
    // Function to show error messages
    function showError(input, message) {
        // Clear any existing error
        clearError(input);
        
        // Create error message element
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        
        // Insert error message after the input
        input.parentNode.insertBefore(errorElement, input.nextSibling);
        
        // Add error class to input
        input.classList.add('input-error');
    }
    
    // Function to clear error messages
    function clearError(input) {
        // Find any existing error message
        const parent = input.parentNode;
        const errorElement = parent.querySelector('.error-message');
        
        // Remove if found
        if (errorElement) {
            parent.removeChild(errorElement);
        }
        
        // Remove error class from input
        input.classList.remove('input-error');
    }
    
    // Toggle password visibility
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const passwordField = document.querySelector(this.getAttribute('data-target'));
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                this.textContent = 'Show';
            }
        });
    });
    
    // Display questions on the index page
    const questionContainer = document.getElementById('question-container');
    
    if (questionContainer) {
        // This is a simple simulation since we're not using fetch
        // In a real application, you would get this data from the server
        displayQuestions([
            {
                id: 1,
                question: 'What is a database?',
                answer: 'A database is an organized collection of structured information, or data, typically stored electronically in a computer system.'
            },
            {
                id: 2,
                question: 'What is MySQL?',
                answer: 'MySQL is an open-source relational database management system. Its name is a combination of "My", the name of co-founder Michael Widenius\'s daughter, and "SQL", the abbreviation for Structured Query Language.'
            }
        ]);
    }
    
    // Function to display questions
    function displayQuestions(questions) {
        questions.forEach(q => {
            const questionCard = document.createElement('div');
            questionCard.className = 'question-card';
            
            questionCard.innerHTML = `
                <h3 class="question-title">${q.question}</h3>
                <div class="question-answer">${q.answer}</div>
            `;
            
            questionContainer.appendChild(questionCard);
        });
    }
});
