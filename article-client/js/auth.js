const API_BASE_URL = 'http://localhost:8000/article-server/apis/v1';
// Check if we're on the login page
const isLoginPage = window.location.pathname.includes('login.html');

// Check if user is already logged in
document.addEventListener('DOMContentLoaded', () => {
    const currentUser = localStorage.getItem('currentUser');
    if (currentUser && (isLoginPage || window.location.pathname.includes('signup.html'))) {
        window.location.href = 'home.html';
    }
});

// Handle login form submission
if (isLoginPage) {
    const loginForm = document.getElementById('loginForm');
    
    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        try {
            const response = await fetch(`${API_BASE_URL}/auth.php?login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });
            
            const data = await response.json();
            
            if (response.ok) {
                // Save user info to localStorage
                localStorage.setItem('currentUser', JSON.stringify(data.user));
                // Redirect to home page
                window.location.href = 'home.html';
            } else {
                alert(data.message || 'Login failed');
            }
        } catch (error) {
            console.error('Error during login:', error);
            alert('An error occurred during login. Please try again.');
        }
    });
} else {
    // Handle signup form submission
    const signupForm = document.getElementById('signupForm');
    
    signupForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        const fullName = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        // Validate password match
        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }
        
        try {
            const response = await fetch(`${API_BASE_URL}/auth.php?register`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    FN: fullName,
                    email, 
                    password 
                })
            });
            
            const data = await response.json();
            
            if (response.ok) {
                // Save user info to localStorage
                localStorage.setItem('currentUser', JSON.stringify(data.user));
                // Redirect to home page
                window.location.href = 'home.html';
            } else {
                alert(data.message || 'Registration failed');
            }
        } catch (error) {
            console.error('Error during registration:', error);
            alert('An error occurred during registration. Please try again.');
        }
    });
}
