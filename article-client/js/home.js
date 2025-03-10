const API_BASE_URL = 'http://localhost:8000/article-server/apis/v1';

// Check if user is logged in
document.addEventListener('DOMContentLoaded', () => {
    const currentUser = localStorage.getItem('currentUser');
    if (!currentUser) {
        window.location.href = 'login.html';
        return;
    }
    
    // Display username
    const user = JSON.parse(currentUser);
    const usernameElement = document.getElementById('username');
    if (usernameElement) {
        usernameElement.textContent = `Welcome, ${user.name}`;
    }
    
    // Load questions
    loadQuestions('all');
    
    // Add logout functionality
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', logout);
    }
    
    // Add filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            e.target.classList.add('active');
            // Get filter value
            const filter = e.target.getAttribute('data-filter');
            // Load questions with filter
            loadQuestions(filter);
        });
    });
});

// Load questions from API
async function loadQuestions(category) {
    try {
        const cardsContainer = document.getElementById('cardsContainer');
        cardsContainer.innerHTML = '<p>Loading questions...</p>';
        
        let url;
        if (category === 'all') {
            url = `${API_BASE_URL}/questions.php`;
        } else {
            url = `${API_BASE_URL}/questions.php?category=${category}`;
        }
        
        const response = await fetch(url);
        const questions = await response.json();
        
        if (questions.length === 0) {
            cardsContainer.innerHTML = '<p>No questions found in this category.</p>';
            return;
        }
        
        cardsContainer.innerHTML = '';
        
        questions.forEach(question => {
            const card = document.createElement('div');
            card.className = 'card';
            card.innerHTML = `
                <div class="card-header">
                    <h2>${question.question}</h2>
                    <span class="category-tag">${question.category || 'Uncategorized'}</span>
                </div>
                <div class="card-body">
                    <p>${question.answer}</p>
                </div>
            `;
            cardsContainer.appendChild(card);
        });
    } catch (error) {
        console.error('Error loading questions:', error);
        document.getElementById('cardsContainer').innerHTML = 
            '<p>Error loading questions. Please try again later.</p>';
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
