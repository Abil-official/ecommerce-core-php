document.addEventListener('DOMContentLoaded', function() {
    // Handle Registration Form Submission
    var registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Perform registration logic
            console.log('Registering user');
            // Add your AJAX call here for registration
        });
    }

    // Handle Login Form Submission
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Perform login logic
            console.log('Logging in user');
            // Add your AJAX call here for login
        });
    }

    // Edit Product Page Functions
    // Placeholder function for changePicture - To be replaced with actual functionality
    window.changePicture = function() {
        console.log('Change picture clicked');
        // Add logic or invoke file input for image upload
    };

    // Placeholder function for deactivateProduct - To be replaced with actual functionality
    window.deactivateProduct = function() {
        console.log('Deactivate product clicked');
        // Add logic for deactivating the product
    };

    // Placeholder function for deleteProduct - To be replaced with actual functionality
    window.deleteProduct = function() {
        console.log('Delete product clicked');
        if (confirm('Are you sure you want to delete this product?')) {
            // Add logic for deleting the product
        }
    };

    // Add event listeners for the edit product page buttons
    const saveButton = document.querySelector('.save-button');
    const deactivateButton = document.querySelector('.deactivate-button');
    const deleteButton = document.querySelector('.delete-button');

    if (saveButton) {
        saveButton.addEventListener('click', function() {
            console.log('Save changes');
            // Here you would send a request to the server to save the changes
        });
    }

    if (deactivateButton) {
        deactivateButton.addEventListener('click', function() {
            console.log('Deactivate product');
            // Send a request to the server to deactivate the product
        });
    }

    if (deleteButton) {
        deleteButton.addEventListener('click', function() {
            console.log('Delete product');
            // Send a request to the server to delete the product
        });
    }
});

