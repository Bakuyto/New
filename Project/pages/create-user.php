<?php include '../connection/redirect.php';?>
<?php include '../connection/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User Page</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/create-user.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <div class="conatiner_fluid">
    <nav class=" sticky-top top-0" style="background-color:white; z-index:999;">
      <ul>
        <li>
          <a href="main.php">Main</a>
        </li>
        <li>
          <a href="test.php">Test</a>
        </li>
        <li>
          <a class="active" href="#">Create</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row m-auto border text-center">
        <div class="box1 col-sm-12 col-lg-4 border">
          <div class="box-header">
            <div class="h1 mt-5">New Department</div>
            <form method="POST" action="insert-department.php">
              <input name="department_name" class="form-control m-auto mt-5 border-black" style="width:80%;" required>
              <div class="save-but d-flex justify-content-center m-auto mt-5">
                <button type="submit" name="submit_department" style="background-color: var(--blue);"
                  class="btn fw-bolder mb-5 w-50">Save</button>
              </div>
            </form>
          </div>
          <div class="container">
            <div class="table-container tbl-fixed" style="height:90vh;">
              <table class="table table-bordered">
                <thead>
                  <tr class=" sticky-top top-0" style="z-index:1;">
                    <th class="border text-center" scope="col" style="background-color: var(--blue); height:50px;">
                      Department
                    </th>
                  </tr>
                </thead>
                <tbody>

                <?php
                    include '../connection/connect.php';
                    $sql = "CALL Load_All_department"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Output data row by row
                            echo "<tr>
                                    <td class='d-flex justify-content-between border' name='" . $row["department_name"] . "' id='" . $row["department_pk"] . "'>" . $row["department_name"] . "
                                    <form method='POST'>
                                        <button 
                                            type='button'
                                            name='plus-button'
                                            data-department-name='" . $row["department_name"] . "' 
                                            data-department-pk='" . $row["department_pk"] . "' 
                                            class='btn btn-primary plus-btn fw-bolder' 
                                            data-bs-toggle='modal' 
                                            data-bs-target='#exampleModal'>
                                            +
                                        </button>
                                    </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                    }
                    $conn->close(); // Close the database connection
                ?>  

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="box2 col-sm-12 col-lg-4 border">
          <div class="box-header">
            <div class="h1 mt-5">New Transaction</div>
            <form method="POST" action="insert-column.php">
              <input name="column_name" class="form-control m-auto mt-5 border-black" style="width:80%;" required>
              <div class="save-but d-flex justify-content-center m-auto mt-5">
                <button type="submit" name="submit_transaction" style="background-color: var(--blue);"
                  class="btn fw-bolder mb-5 w-50">Save</button>
              </div>
            </form>
          </div>
          <div class="container">
            <div class="table-container tbl-fixed" style="height:90vh;">
              <table class="table table-bordered">
                <thead>
                  <tr class=" sticky-top top-0" style="z-index:1;">
                    <th class="border text-center" scope="col" style="background-color: var(--blue); height:50px;">
                      Transation
                    </th>
                  </tr>
                </thead>
                <tbody>

                <?php
                      include '../connection/connect.php';
                      $sql = "CALL Load_All_Transaction"; // SQL query to select data from the table
                      $result = $conn->query($sql); // Execute the query
                  if ($result && $result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          // Output data row by row
                          echo "<tr>
                                  <td class='d-flex justify-content-between border'>" . $row["department_name"] . " 
                                      <button type='button' class='btn btn-danger delete-btn' 
                                          onclick='setTransactionToDelete(\"" . $row["department_name"] . "\")' 
                                          data-bs-toggle='modal' data-bs-target='#deleteModal'>
                                          <i class='fa-solid fa-trash-can text-light'></i>
                                      </button>
                                  </td>
                                </tr>";
                      }
                  } else {
                      echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                  }
                  $conn->close(); // Close the database connection
              ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="box3 col-sm-12 col-lg-4 border">
          <div class="h1 mt-5">New User</div>
              <form method="POST" action="insert-user.php">
          <div class="form-group">
          <label class="d-flex mx-5 text-start">FullName</label>
          <input type="text" name="user_full_name" class="form-control m-auto mb-3 border-black" style="width:80%;" required>
          </div>
        <div class="form-group">
          <label class="d-flex mx-5 text-start">Username</label>
          <input type="text" name="user_log_name" class="form-control m-auto mb-3 border-black" style="width:80%;" required>
        </div>
        <div class="form-group">
          <label class="d-flex mx-5 text-start">Password</label>
          <input type="password" name="user_log_password" class="form-control m-auto mb-3 border-black" style="width:80%;" required>
        </div>
        <select name="user_level_fk" class="form-select m-auto mb-3"
             style="width:80%;max-height:20vh; overflow-y:scroll;" aria-label="Default select example" required>
              <option class="text-dark" value="" selected disabled>User Level</option>
              <?php
                    include '../connection/connect.php';
                    $sql = "SELECT * FROM tbluserlevel"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query
    
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $userlevel_name = $row['userlevel_name']; // Fetch department name
                          $option = $row['userlever_pk'];// Fetch userlever_pk
                          // Output data row by row
                  ?>
                          <option value="<?php echo $option; ?>"><?php echo $userlevel_name; ?> </option>
                  <?php
                      }
                  } else {
                      echo "<option value='' selected>No departments found</option>"; // Output if no results found
                  }
                    $conn->close(); // Close the database connection
                  ?>
            </select>
            <select name="user_department_fk" class="form-select m-auto mb-5"
              style="width:80%;max-height:20vh; overflow-y:scroll;"    required>
              <option class="text-dark" value="" selected disabled>Select Department</option>

              <?php 
                    include '../connection/connect.php';
                    $sql = "CALL Load_All_department"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query
    
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $department_name = $row['department_name']; // Fetch department name
                          $option = $row['department_pk'];// Fetch department pk
                          // Output data row by row
                  ?>
                          <option value="<?php echo $option; ?>"><?php echo $department_name; ?> </option>
                  <?php
                      }
                  } else {
                      echo "<option value='' selected>No departments found</option>"; // Output if no results found
                  }
                    $conn->close(); // Close the database connection
                  ?>

            </select>
            <div class="save-but d-flex justify-content-center m-auto">
              <button type="submit" name="submit_user" style="background-color: var(--blue);"
                class="btn fw-bolder mb-5 w-50">Save</button>
            </div>
              </form>
              <div class="container">
            <div class="table-responsive" style="height:40vh;">
              <table class="table table-bordered">
                <thead>
                  <tr class="sticky-top top-0" style="z-index:1;">
                    <th class="border text-center" scope="col" style="background-color: var(--blue); height:50px;">
                      User List
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  include '../connection/connect.php';
                  $sql = "CALL Load_All_User"; // SQL query to select data from the table
                  $result = $conn->query($sql); // Execute the query
                  
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          // Output data row by row
                          echo "<tr>
                                <td class='d-flex justify-content-between border'>" . $row["user_full_name"] . " 
                                <input type='hidden' name='user_pk' value='".$row["user_pk"]." '>
                                <button type='button' id='".$row["user_pk"]."' class='btn btn-primary mx-2 update-btn' data-user-fullname='".$row["user_full_name"]."' data-user-username='".$row["user_log_name"]."' data-user-password='".$row["user_log_password"]."' data-user-level='".$row["user_level_fk"]."' data-user-department='".$row["user_department_fk"]."'><i class='fa-solid fa-pen-to-square'></i></button>
                                </td>
                              </tr>";
                              
                      }
                  } else {
                      echo "<tr><td colspan='1'>0 results</td></tr>"; // Output if no results found
                  }
                  $conn->close(); // Close the database connection
              ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

<!-- Modal -->
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUserForm" method="POST" action="update-user.php">
                <input type="hidden" id="user_pk" name="user_pk" value="">
                <div class="form-group">
                    <label class="d-flex mx-5 text-start">FullName</label>
                    <input type="text" id="user_full_name" name="user_full_name" class="form-control m-auto mb-3 border-black" style="width:80%;">
                </div>
                <div class="form-group">
                    <label class="d-flex mx-5 text-start">Username</label>
                    <input type="text" id="user_log_name" name="user_log_name" class="form-control m-auto mb-3 border-black" style="width:80%;">
                </div>
                <div class="form-group">
                    <label for="password" class="d-flex mx-5 text-start">Password</label>
                    <input  id="user_log_password" name="user_log_password" class="form-control m-auto mb-3 border-black" style="width:80%;">
                </div>
                <select id="user_level_fk" name="user_level_fk" class="form-select m-auto mb-3" style="width:80%;max-height:20vh; overflow-y:scroll;" aria-label="Default select example">
                    <option class="text-dark" selected disabled>User Level</option>
                    <?php
                    include '../connection/connect.php';
                    $sql = "SELECT * FROM tbluserlevel"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $userlevel_name = $row['userlevel_name']; // Fetch department name
                            $option = $row['userlever_pk'];// Fetch userlever_pk
                            // Output data row by row
                            ?>
                            <option value="<?php echo $option; ?>"><?php echo $userlevel_name; ?> </option>
                            <?php
                        }
                    } else {
                        echo "<option value='' selected>No departments found</option>"; // Output if no results found
                    }
                    $conn->close(); // Close the database connection
                    ?>
                </select>
                <select id="user_department_fk" name="user_department_fk" class="form-select m-auto mb-5" style="width:80%;max-height:20vh; overflow-y:scroll;" aria-label="Default select example">
                    <option class="text-dark" selected disabled>Select Department</option>
                    <?php
                    include '../connection/connect.php';
                    $sql = "CALL Load_All_department"; // SQL query to select data from the table
                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $department_name = $row['department_name']; // Fetch department name
                            $option = $row['department_pk'];// Fetch department pk
                            // Output data row by row
                            ?>
                            <option value="<?php echo $option; ?>"><?php echo $department_name; ?> </option>
                            <?php
                        }
                    } else {
                        echo "<option value='' selected>No departments found</option>"; // Output if no results found
                    }
                    $conn->close(); // Close the database connection
                    ?>
                </select>
                <div class="save-but d-flex justify-content-center m-auto">
                    <button type="submit" name="update-user" style="background-color: var(--blue);" class="btn fw-bolder mb-5 w-50">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action="save-multiple-checkbox.php">
                  <?php
                  include '../connection/connect.php';

                  $sql = "CALL Load_All_Transaction"; 
                  $result = $conn->query($sql); // Execute the query

                  if ($result && $result->num_rows > 0) {
                      // Output the hidden input field for department_pk
                      echo "<input type='hidden' name='department_pk' id='department_pk_input' value='department_pk'>";
                      
                      // Loop through your checkboxes and output them
                      while ($row = $result->fetch_assoc()) {
                          echo "<div class='form-group mb-3 d-flex justify-content-between'>
                                  <label>" . $row["department_name"] . "</label>
                                  <input class='form-check-input' type='checkbox' name='brands[]' value='" . $row["department_name"] . "'>
                                </div>";
                      }
                  } else {
                      echo "<label>No results found</label>"; // Output if no results found
                  }
                  ?>
                            <div class='form-group mb-3 d-flex justify-content-end'>
                                <button type='button' class='btn btn-secondary mx-2' data-bs-dismiss='modal'>Close</button>
                                <button type='submit' name='save_multiple_checkbox' class='btn btn-primary'>Submit</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Transaction Deletion</h5>
          <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this transaction?</p>
          <form id="deleteTransactionForm" action="delete-column.php" class="d-flex justify-content-center" method="POST">
            <input type="hidden" name="transactionToDelete" id="transactionToDelete">
            <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit_delete_transaction" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/create-user.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
 $(document).ready(function (){
   $('#exampleModal').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget);
     var department_pk = button.data('department-pk');
     var modal = $(this);
     modal.find('#department_pk_input').val(department_pk);
   });
 });
  </script>
<script>
  $(document).ready(function() {
    $('.update-btn').click(function() {
      var userId = $(this).attr('id'); // Get the user ID from the button

      // Assuming you have hidden input fields in your modal to hold the user's data
      // Populate these fields with the user's information
      var fullName = $(this).closest('tr').find('.user-full-name').text().trim();
      var username = $(this).closest('tr').find('.username').text().trim();
      var password = $(this).closest('tr').find('.password').text().trim();

      // Retrieve data from the button attributes or from another source
      var userFullName = $(this).data('user-fullname');
      var userUsername = $(this).data('user-username');
      var userPassword = $(this).data('user-password');
      var userLevel = $(this).data('user-level');
      var userDepartment = $(this).data('user-department');

      $('#user_pk').val(userId); // Set the user_pk value
      $('#user_full_name').val(fullName || userFullName);
      $('#user_log_name').val(username || userUsername);
      $('#user_log_password').val(password || userPassword);
      $('#user_level_fk').val(userLevel);
      $('#user_department_fk').val(userDepartment);

      $('#updateModal').modal('show'); // Show the modal
    });
  });
</script>
<script>
  function setTransactionToDelete(transactionName) {
    console.log("Transaction Name:", transactionName);
    document.getElementById('transactionToDelete').value = transactionName;
  }
</script>

</html>