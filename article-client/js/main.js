
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
           
            const requiredInputs = form.querySelectorAll('[required]');
            let isValid = true;
            
            
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    showError(input, 'This field is required');
                } else {
                    clearError(input);
                    
                    
                    if (input.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value)) {
                            isValid = false;
                            showError(input, 'Please enter a valid email address');
                        }
                    }
                    
                    
                    if (input.name === 'password' && form.id === 'signup-form') {
                        if (input.value.length < 8) {
                            isValid = false;
                            showError(input, 'Password must be at least 8 characters');
                        }
                    }
                    
                    
                    if (input.name === 'confirm-password') {
                        const password = form.querySelector('[name="password"]');
                        if (input.value !== password.value) {
                            isValid = false;
                            showError(input, 'Passwords do not match');
                        }
                    }
                }
            });
            
           
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
    
    
    function clearError(input) {
        // Find any existing error message
        const parent = input.parentNode;
        const errorElement = parent.querySelector('.error-message');
        
        
        if (errorElement) {
            parent.removeChild(errorElement);
        }
        
        
        input.classList.remove('input-error');
    }
    
    
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
    
    
    const questionContainer = document.getElementById('question-container');
    
    if (questionContainer) {
        
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
