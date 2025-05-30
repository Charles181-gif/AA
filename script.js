// script.js
document.addEventListener("DOMContentLoaded", function() {
  // Registration form handling
  const signupForm = document.getElementById("signup-form");
  if (signupForm) {
    signupForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const messageDiv = document.getElementById("message");
      messageDiv.textContent = "";
      messageDiv.style.color = "";

      const username = document.getElementById("username").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();

      if (username === "" || email === "" || password === "") {
        messageDiv.textContent = "Please fill in all fields.";
        messageDiv.style.color = "red";
        return;
      }

      const formData = new URLSearchParams();
      formData.append("username", username);
      formData.append("email", email);
      formData.append("password", password);

      fetch("register.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "X-Requested-With": "XMLHttpRequest"
        },
        body: formData.toString()
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          messageDiv.style.color = "green";
          messageDiv.textContent = data.message;
          signupForm.reset();
        } else {
          messageDiv.style.color = "red";
          messageDiv.textContent = "Error: " + data.message;
        }
      })
      .catch(error => {
        console.error("Error:", error);
        messageDiv.style.color = "red";
        messageDiv.textContent = "An error occurred. Please try again later.";
      });
    });
  }

  // Modal functionality
  const modals = document.querySelectorAll('.modal');
  const closeButtons = document.querySelectorAll('.close-button');
  
  // Footer links functionality
  const footerLinks = document.querySelectorAll('.footer-link');
  
  footerLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const modalId = this.getAttribute('data-modal');
      const modal = document.getElementById(modalId);
      
      if (modal) {
        modal.style.display = 'block';
      }
    });
  });
  
  // Close modals when clicking close button
  closeButtons.forEach(button => {
    button.addEventListener('click', function() {
      const modal = this.closest('.modal');
      modal.style.display = 'none';
    });
  });
  
  // Close modals when clicking outside
  window.addEventListener('click', function(e) {
    modals.forEach(modal => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
});