<html>
  <body>
    <h1>Welcome user</h1>

    <div>
      <h2>edit user info</h2>
      <label for="name">Name</label>
      <input type="text" id="name" placeholder="">

      <label for="sex">Sex</label>
      <input type="text" id="sex" placeholder="">

      <label for="blood_type">Blood Type</label>
      <input type="text" id="blood_type" placeholder="">

      <button onclick="updateUser()">Edit</button>
    </div>

    <br>

    <h2>Add certificate to yourself</h2>

    <div id="certificates">
      <!-- Certificates will be displayed here -->
    </div>

    <script>
      // Retrieve the user ID from local storage
      var userId = localStorage.getItem('userID');

      function updateUser() {
        // Get the values from the input fields
        var name = document.getElementById('name').value;
        var sex = document.getElementById('sex').value;
        var blood_type = document.getElementById('blood_type').value;

        // Create an object with the updated user data
        var userData = {};

        // Add properties to the userData object if the corresponding input fields have values
        if (name.trim() !== '') {
          userData.name = name;
        }
        if (sex.trim() !== '') {
          userData.sex = sex;
        }
        if (blood_type.trim() !== '') {
          userData.blood_type = blood_type;
        }

        // Make a PUT request to update the user data
        fetch(`http://127.0.0.1:8000/api/User/put/` + userId, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(userData)
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Update request failed');
            }
            return response.json();
          })
          .then(data => {
            // Handle the response data here
            console.log(data);
            console.log("The data has been edited");
            location.reload();

            // Clear the input fields
            document.getElementById('name').value = '';
            document.getElementById('sex').value = '';
            document.getElementById('blood_type').value = '';
          })
          .catch(error => {
            // Handle any errors here
            console.error(error);
          });
      }

      function handleCheckboxChange(checkbox) {
        var certificateId = checkbox.value;

        if (checkbox.checked) {
          // Checkbox is checked, so post the certificate_id and user_id
          var data = {
            certificate_id: certificateId,
            user_id: userId
          };

          fetch('http://127.0.0.1:8000/api/userCertificate/post', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('User certificate post request failed');
              } alert("You have added the certificate for your dataset");   
              return response.json();
            })
            .then(result => {
              // Handle the post request result here
              console.log(result);
              // Store the user certificate ID in the checkbox dataset
              checkbox.dataset.userCertificateId = result.data.id;
            })
            .catch(error => {
              // Handle any errors here
              console.error(error);
            });
        } else {
          // Checkbox is unchecked, so you can implement logic to delete the user certificate if desired
          var userCertificateId = checkbox.dataset.userCertificateId;

          fetch(`http://127.0.0.1:8000/api/userCertificate/delete/` + userCertificateId, {
            method: 'DELETE'
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('User certificate delete request failed');
              }    alert("You have deleted the certificate from your dataset");   
              return response.json();
            })
            .then(result => {
              // Handle the delete request result here
              console.log(result);
                     // Remove the user certificate ID from the checkbox dataset
              delete checkbox.dataset.userCertificateId;
            })
            .catch(error => {
              // Handle any errors here
              console.error(error);
            });
        }
      }

      // Make an API call to fetch user data by the ID
      fetch(`http://127.0.0.1:8000/api/User/read/` + userId)
        .then(response => {
          if (!response.ok) {
            throw new Error('User data fetch request failed');
          }
          return response.json();
        })
        .then(data => {
          // Handle the user data here
          console.log(data);

          // Set the placeholder values based on the retrieved data
          document.getElementById('name').placeholder = data.data.name;
          document.getElementById('sex').placeholder = data.data.sex;
          document.getElementById('blood_type').placeholder = data.data.blood_type;
        })
        .catch(error => {
          // Handle any errors here
          console.error(error);
        });

      // Make an API call to fetch certificates
      fetch(`http://127.0.0.1:8000/api/Cerificate/read`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Certificates fetch request failed');
          }
          return response.json();
        })
        .then(certificatesData => {
          // Handle the certificates data here
          console.log(certificatesData);

          // Make an API call to fetch user certificate data by the user ID
          fetch(`http://127.0.0.1:8000/api/userCertificate/read/` + userId)
            .then(response => {
              if (!response.ok) {
                throw new Error('User certificate data fetch request failed');
              }
              return response.json();
            })
            .then(userCertificateData => {
              // Handle the user certificate data here
              console.log(userCertificateData);

              // Get the certificates div element
              var certificatesDiv = document.getElementById('certificates');

              // Loop through the certificates and create HTML elements to display them
              certificatesData.forEach(certificate => {
                var certificateElement = document.createElement('div');

                // Create checkbox element
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'certificate';
                checkbox.value = certificate.id;

                // Check if the certificate ID is in the user's certificate data
                var matchingUserCertificate = userCertificateData.find(userCertificate => userCertificate.certificate_id === certificate.id);
                if (matchingUserCertificate) {
                  checkbox.checked = true;
                  // Store the user certificate ID in the checkbox dataset
                  checkbox.dataset.userCertificateId = matchingUserCertificate.id;
                }

                // Attach an event listener to the checkbox
                checkbox.addEventListener('change', function() {
                  handleCheckboxChange(this);
                });

                certificateElement.appendChild(checkbox);

                // Create label for the checkbox
                var label = document.createElement('label');
                label.htmlFor = 'certificate';
                label.textContent = certificate.name;
                certificateElement.appendChild(label);

                certificatesDiv.appendChild(certificateElement);
              });
            })
            .catch(error => {
              // Handle any errors here
              console.error(error);
            });
        })
        .catch(error => {
          // Handle any errors here
          console.error(error);
        });
    </script>
  </body>
</html>
