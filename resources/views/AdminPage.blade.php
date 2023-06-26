<!DOCTYPE html>
<html>
<head>
    <title>Welcome Admin</title>
</head>
<body>
    <h1>Welcome admin</h1>
    
    <h2>Add Certificates</h2>
    <label>Name of the certificate</label>
    <input type="text" id="certificate-name">
    <br>
    <br>
    <button id="submit-btn">Submit</button>
    <br>
    <br>
    <h2>Certificates and users</h2>

    <ul id="certificates-list"></ul> 
    <br>
    <h2>User List</h2>
   
    <script>
      

        document.getElementById('submit-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get certificate name from input field
            var name = document.getElementById('certificate-name').value;

            // Create payload object
            var payload = {
                name: name
            };

            // Send AJAX request to create certificate
            var xhr = new XMLHttpRequest();
            xhr.open('POST', `http://127.0.0.1:8000/api/Certificate/post`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 201) {
                        // Success response from the API
                        console.log('Certificate created successfully');
                        var response = JSON.parse(xhr.responseText);
                        alert(response);
                        console.log('Certificate:', response);
                    } else {
                        // Error response from the API
                        console.log('Certificate creation failed');
                        var response = JSON.parse(xhr.responseText);
                        alert('Certificate creation failed');
                        console.log('Error:', response.error);
                    }
                }
            };
            xhr.send(JSON.stringify(payload));
        });

        // Function to retrieve users through API
        function getUsers() {
            // Send AJAX request to retrieve users
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/api/User/read', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success response from the API
                        console.log('Users retrieved successfully');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Users:', response);
                        // Display users on the page (modify as per your requirement)
                        var usersList = document.createElement('ul');
                        response.forEach(function(user) {
                            var userItem = document.createElement('li');
                            var checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.checked = user.is_approved; // Check the checkbox if is_approved is true

                            // Disable the checkbox if it is already checked
                            if (user.is_approved) {
                                checkbox.disabled = true;
                            } else {
                                // Add event listener to checkbox
                                checkbox.addEventListener('click', function() {
                                    if (checkbox.checked) {
                                        sendApprovalRequest(user.id);
                                    }
                                });
                            }

                            userItem.appendChild(checkbox);
                            var isApproved = user.is_approved ? 'Approved' : 'Not Approved';
                            var userText = document.createTextNode(user.name + ' (' + user.role + ') - ' + isApproved);
                            userItem.appendChild(userText);
                            usersList.appendChild(userItem);
                        });
                        document.body.appendChild(usersList);
                    } else {
                        // Error response from the API
                        console.log('Failed to retrieve users');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Error:', response.error);
                    }
                }
            };
            xhr.send();
        }

        // Function to send approval request to API
        function sendApprovalRequest(userId) {
            // Send AJAX request to update user approval status
            var xhr = new XMLHttpRequest();
            xhr.open('PUT', `http://127.0.0.1:8000/api/User/isapproved/${userId}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success response from the API
                        console.log('User approval status updated successfully');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Response:', response);
                    } else {
                        // Error response from the API
                        console.log('Failed to update user approval status');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Error:', response.error);
                    }
                }
            };
            xhr.send();
        }

        // Call the function to retrieve users when the page loads
        getUsers();




        function getCertificates() {
            // Send AJAX request to retrieve certificates
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/api/Cerificate/read', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success response from the API
                        console.log('Certificates retrieved successfully');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Certificates:', response);
                        // Display certificates on the page (modify as per your requirement)
                        var certificatesList = document.getElementById('certificates-list'); // Get the ul element
                        response.forEach(function(certificate) {
                            var certificateItem = document.createElement('li');
                            var certificateName = certificate.name;
                            var certificateId = certificate.id;
                            certificateItem.innerHTML = `Certificate Name: ${certificateName}`;
                            certificatesList.appendChild(certificateItem);
                            getUserCountForCertificate(certificateId, certificateItem);
                        });
                    } else {
                        // Error response from the API
                        console.log('Failed to retrieve certificates');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Error:', response.error);
                    }
                }
            };
            xhr.send();
        }

        function getUserCountForCertificate(certificateId, certificateItem) {
            // Send AJAX request to retrieve user count for a certificate
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://127.0.0.1:8000/api/userCertificate/read`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success response from the API
                        console.log('User count retrieved successfully');
                        var response = JSON.parse(xhr.responseText);
                        console.log('User count:', response);
                        var userCount = response.filter(function(userCertificate) {
                            return userCertificate.certificate_id === certificateId;
                        }).length;
                        certificateItem.innerHTML += ` - User Count: ${userCount}`;
                    } else {
                        // Error response from the API
                        console.log('Failed to retrieve user count');
                        var response = JSON.parse(xhr.responseText);
                        console.log('Error:', response.error);
                    }
                }
            };
            xhr.send();
        }

        // Call the function to retrieve certificates when the page loads
        getCertificates();












    </script>
</body>
</html>
