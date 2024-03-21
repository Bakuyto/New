document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', function () {
          var departmentName = this.getAttribute('data-department-name');
          var modalTitle = document.querySelector('#exampleModal .modal-title');
          modalTitle.textContent = departmentName;
          modalTitle.id = ""; // Clear the ID first
          modalTitle.id = this.parentNode.id; // Set the ID based on the department ID
        });
      });
      