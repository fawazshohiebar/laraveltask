<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
</head>
<body>
  <h2>Login Form</h2>
  <div>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <button id="submit-btn">Login</button>
  </div>

  <script>
    document.getElementById('submit-btn').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Get form values
      var email = document.getElementById('email').value;
      var name = document.getElementById('name').value;

      // Create payload object
      var payload = {
        email: email,
        name: name
      };

      // Send AJAX request
      var xhr = new XMLHttpRequest();
      xhr.open('POST', `http://127.0.0.1:8000/api/User/checker`, true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Success response from the API
            console.log('Login successful');
            var response = JSON.parse(xhr.responseText);
            alert(response.message);
            
            // Save user ID in local storage
            localStorage.setItem('userID', response.userID);
            console.log("ananannaa", response.userID);
            
            if (response.role === 'user') {
              if (response.is_approved) {
                // Redirect to userpage.blade.php
                window.location.href = 'UserPage';
              } else {
                alert('You are not approved yet.');
              }
            } else if (response.role === 'admin') {
              window.location.href = 'AdminPage';
            }
          } else {
            // Error response from the API
            console.log('Login failed');
            var response = JSON.parse(xhr.responseText);
            alert(response.error);
          }
        }
      };
      xhr.send(JSON.stringify(payload));
    });
  </script>
</body>
</html>
