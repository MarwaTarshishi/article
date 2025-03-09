const API_BASE_URL = 'http://localhost:8000/article-server/apis/v1';

/**
 * Makes an API request
 * @param {string} endpoint 
 * @param {string} method 
 * @param {Object} data 
 * @returns {Promise<Object>} 
 */
async function apiRequest(endpoint, method = 'GET', data = null) {
    const url = `${API_BASE_URL}/${endpoint}`;
    
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include' // Include cookies for session management
    };
    
    if (data && (method === 'POST' || method === 'PUT')) {
        options.body = JSON.stringify(data);
    }
    
    try {
        const response = await fetch(url, options);
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'API request failed');
        }
        
        return result;
    } catch (error) {
        console.error(`API Error (${endpoint}):`, error);
        throw error;
    }
}

/**
 * Validates form input
 * @param {string} email - Email to validate
 * @param {string} password - Password to validate
 * @returns {Object} - Validation result
 */
function validateInput(email, password) {
    const result = {
        valid: true,
        message: ''
    };
    
    // Simple email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        result.valid = false;
        result.message = 'Please enter a valid email address';
        return result;
    }
    
    // Password validation
    if (password.length < 6) {
        result.valid = false;
        result.message = 'Password must be at least 6 characters long';
        return result;
    }
    
    return result;
}
