
const API_BASE_URL = '/api/v1';


document.addEventListener('DOMContentLoaded', () => {
    const currentUser = localStorage.getItem('currentUser');
    if (!currentUser) {
        window.location.href = 'login.html';
        return;
    }
    
   
    const user = JSON.parse(currentUser);
    const usernameElement = document.getElementById('username');
    if (usernameElement) {
        usernameElement.textContent = `Welcome, ${user.name}`;
    }
    
    
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', logout);
    }
    
    
    const faqForm = document.getElementById('faqForm');
    if (faqForm) {
        faqForm.addEventListener('submit', submitQuestion);
    }
});

// Submit new question
async function submitQuestion(event) {
    event.preventDefault();
    
    const questionInput = document.getElementById('question');
    const answerInput = document.getElementById('answer');
    const categoryInput = document.getElementById('category');
    
    const question = questionInput.value;
    const answer = answerInput.value;
    const category = categoryInput.value;
    
    // Validate inputs
    if (!question || !answer || !category) {
        alert('Please fill in all fields');
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE_URL}/questions.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ question, answer, category })
        });
        
        const data = await response.json();
        
        if (response.ok) {
            alert('Question added successfully!');
            
            questionInput.value = '';
            answerInput.value = '';
            categoryInput.value = '';
            
            window.location.href = 'home.html';
        } else {
            alert(data.message || 'Failed to add question');
        }
    } catch (error) {
        console.error('Error adding question:', error);
        alert('An error occurred while adding the question. Please try again.');
    }
}

// Logout function
async function logout() {
    try {
        await fetch(`${API_BASE_URL}/auth.php?logout`);
        localStorage.removeItem('currentUser');
        window.location.href = 'login.html';
    } catch (error) {
        console.error('Error during logout:', error);
        alert('An error occurred during logout. Please try again.');
    }
}
