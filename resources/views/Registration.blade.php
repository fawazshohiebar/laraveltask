<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
</head>
<body>
  <h2>Registration Form</h2>
  <div>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="sex">Sex:</label>
    <select id="sex" name="sex">
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select><br><br>

    <label for="blood-type">Blood Type:</label>
    <select id="blood-type" name="blood-type">
      <option value="A+">A+</option>
      <option value="A-">A-</option>
      <option value="B+">B+</option>
      <option value="B-">B-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
    </select><br><br>

    <button id="submit-btn">Submit</button>
  </div>

  <script>
    document.getElementById('submit-btn').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Get form values
      var email = document.getElementById('email').value;
      var name = document.getElementById('name').value;
      var sex = document.getElementById('sex').value;
      var bloodType = document.getElementById('blood-type').value;

      // Create payload object
      var payload = {
        email: email,
        name: name,
        sex: sex,
        blood_type: bloodType,
        role:"user"
      };

      // Send AJAX request
      var xhr = new XMLHttpRequest();
      xhr.open('POST', `http://127.0.0.1:8000/api/Userr/post`, true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Handle the response here (if needed)
          console.log('Form submitted successfully');
        }
        console.log("The Form is being googd")
      };
      xhr.send(JSON.stringify(payload));
    });
  </script>
</body>
</html>
