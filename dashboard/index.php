<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include ('db.php');
// Fetch details from the tbl_task
$query = "SELECT * FROM tbl_task WHERE status=1 ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$tbl_task = [];
while ($row = mysqli_fetch_assoc($result)) {    
    $decodedData = json_decode($row['data'], true);    // Decode the JSON-encoded data from the 'data' column
    $tbl_task[] = array_merge($row, $decodedData);  // Merge the decoded data with the row data
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include ('head.php') ?>

<body>
    <!-- loader Start -->
    <?php include ('loader.php') ?>
    <!-- loader End -->
    <!-- sidenav Start -->
    <?php include ('sidenav.php') ?>
    <!-- sidenav End -->
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <?php include ('topnav.php') ?>
            <!-- Nav Header Component Start -->
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    <h1>TASK <span class="text-uppercase"></h1>
                                </div>
                                <div>
                                    <button type="button" id="addBtn" class="btn btn-link btn-soft-light text-white"
                                        data-bs-toggle="modal" data-bs-target="#Modal">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="../assets/images/dashboard/top-header.png" alt="header"
                        class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div>
            <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped" role="grid"
                                    data-bs-toggle="data-table">
                                    <thead>
                                        <tr class="ligth">
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>DOB</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='record'>
                                        <?php
                                        $serialNumber = 1;
                                        foreach ($tbl_task as $data) {
                                            $id = $data['id'];
                                            echo "<tr>";
                                            echo "<td>" . $serialNumber++ . "</td>";
                                            echo "<td>" . $data['name'] . "</td>";
                                            echo "<td>" . $data['email'] . "</td>";
                                            echo "<td>" . $data['phone'] . "</td>";
                                            echo "<td>" . $data['dob'] . "</td>";
                                            echo "<td>" . $data['gender'] . "</td>";

                                            echo "<td>                                                                                                                    
                                                    <button type='button' class='btn btn-icon btn-sm btn-warning text-white text-uppercase editData' data-id='" . $data['id'] . "'
                                                            data-bs-toggle='modal' data-bs-target='#Modal'>                                                        
                                                        <span class='btn-inner'>
                                                            <svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                                <path d='M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                                <path fill-rule='evenodd' clip-rule='evenodd' d='M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                                <path d='M15.1655 4.60254L19.7315 9.16854' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                            </svg>
                                                        </span>                                                        
                                                    </button>                                                                                      
                                                    <button type='button' class='btn btn-icon btn-sm btn-danger text-white text-uppercase deleteData' data-id='" . $data['id'] . "'>                                                                                                                                                                   
                                                        <span class='btn-inner'>
                                                            <svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='currentColor'>
                                                                <path d='M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                                <path d='M20.708 6.23975H3.75' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                                <path d='M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                            </svg>
                                                        </span>
                                                    </button>                                                                                                                                          
                                                  </td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Section Start -->
        <?php include ('footer.php') ?>
        <!-- Footer Section End -->
    </main>
    <!-- Wrapper End-->
    <!-- Modal start -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="btn-close close-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id='form'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <p id="name_error" style="color: red;"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control available" name="email" id="email" required>
                                    <p id="email_availability"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" class="form-control available" name="phone" id="phone"
                                        maxlength="10" required>
                                    <p id="phone_availability"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="dob">DOB</label>
                                    <input type="date" class="form-control" name="dob" id="dob"
                                        max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="gender">Gender</label>
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="submit-btn" class="btn btn-primary" value="submit" />
                        <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal end -->
    <!-- Scripts Start -->
    <?php include ("script.php") ?>
    <!-- Scripts End -->
    <script>
        // script start
        $(document).ready(function () {
            $('.close-btn').click(function () {
                var form = $('#form');
                var clone = form.clone(); // Clone the form
                form.replaceWith(clone);
                $('#edit_id').remove(); // Remove edit_id input field   
            });
            // add - start 
            $('#addBtn').click(function () {
                $('#modalLabel').text('Add Data'); // Form title
                $('#submit-btn').val('Submit'); // Button value                
                $('#form')[0].reset(); // Reset form                
                $('#edit_id').remove(); // Remove edit_id input field                                                
                $('#email_availability').html('');  // remove previous values
                $('#phone_availability').html('');  // remove previous values
                // email availability checking while add data - start
                $('#email').on('input', function () {
                    var email = $(this).val();
                    var isValid = /^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(email);
                    if (!isValid) {
                        $('#email_availability').html('<span style="color:red;">Invalid</span>');
                        $('#submit-btn').prop('disabled', true);
                    }
                    else {
                        $.ajax({
                            type: 'POST',
                            url: 'backend/backend-task.php',
                            data: { email: email, req_type: "email_availability" },
                            success: function (response) {
                                console.log('Response', response);
                                if (response == 'Email is Available') {
                                    $('#email_availability').html('<span style="color:green;">Email is available</span>');
                                    $('#submit-btn').prop('disabled', false);
                                }
                                else if (response == 'Email Already Taken') {
                                    $('#email_availability').html('<span style="color:red;">Email is already taken</span>');
                                    $('#submit-btn').prop('disabled', true);
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
                // email availability checking while add data - end
                // phone availability checking while add data - start            
                $('#phone').on('input', function () {
                    // numeric only
                    var phoneValidation = $(this).val().replace(/\D/g, '');
                    $(this).val(phoneValidation);
                    // value of phone
                    var phone = $(this).val();
                    // starting from 6 to 9
                    var isValid = /^[6-9]\d{9}$/.test(phone);
                    if (!isValid) {
                        $('#phone_availability').html('<span style="color:red;">Invalid Phone</span>');
                        $('#submit-btn').prop('disabled', true);
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'backend/backend-task.php',
                            data: { phone: phone, req_type: "phone_availability" },
                            success: function (response) {
                                console.log('Response', response);
                                if (response == 'Phone is Available') {
                                    $('#phone_availability').html('<span style="color:green;">Phone is available</span>');
                                    $('#submit-btn').prop('disabled', false);
                                }
                                else if (response == 'Phone Already Taken') {
                                    $('#phone_availability').html('<span style="color:red;">Phone is already taken</span>');
                                    $('#submit-btn').prop('disabled', true);
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
                // phone availability checking while add data - end
                // add data - start
                $('#form').submit(function (e) {
                    e.preventDefault();
                    var name = $('#name').val().trim() === ''
                    var phone = $('#phone').val().trim() === ''
                    if (name || phone) {
                        // Show Swal alert if any field is empty
                        Swal.fire({
                            icon: 'error',
                            title: 'All Fields are Mandatory',
                            text: 'Please Enter a Value for All Fields',
                        });
                        return;
                    }
                    // serialize form data
                    var formData = $(this).serializeArray();
                    formData.push({ name: 'req_type', value: 'add' });
                    console.log(formData);
                    // AJAX Request
                    $.ajax({
                        type: 'POST',
                        url: 'backend/backend-task.php',
                        data: formData,
                        success: function (response) {
                            console.log(response);
                            // hide the modal here
                            $('#Modal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Added!',
                                text: response,
                            }).then((response) => {
                                if (response.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
                // add data - end                    
            });
            // add - end    
            // edit - start
            $('.editData').click(function () {
                // Reset form
                $('#form')[0].reset();

                $('#modalLabel').text('Edit Data'); // Form title                
                $('#submit-btn').val('Update');
                // edit data - start                
                var id = $(this).data('id');
                console.log(id);
                $('#email_availability').html('');
                $('#phone_availability').html('');
                // email availability checking while edit data - start
                $('#email').on('input', function () {
                    var email = $(this).val();
                    var isValid = /^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(email);
                    if (!isValid) {
                        $('#email_availability').html('<span style="color:red;">Invalid</span>');
                        $('#submit-btn').prop('disabled', true);
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'backend/backend-task.php',
                            data: { id: id, email: email, req_type: "edit_email_availability" },
                            success: function (response) {
                                console.log('Response', response);
                                if (response == 'Email is Available') {
                                    $('#email_availability').html('<span style="color:green;">Email is available</span>');
                                    $('#submit-btn').prop('disabled', false);
                                }
                                else if (response == 'Email Already Taken') {
                                    $('#email_availability').html('<span style="color:red;">Email is already taken</span>');
                                    $('#submit-btn').prop('disabled', true);
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
                // email availability checking while edit data - end
                // phone availability checking while edit data - start            
                $('#phone').on('input', function () {
                    // numeric only
                    var phoneValidation = $(this).val().replace(/\D/g, '');
                    $(this).val(phoneValidation);
                    // value of phone
                    var phone = $(this).val();
                    // starting from 6 to 9
                    var isValid = /^[6-9]\d{9}$/.test(phone);
                    if (!isValid) {
                        $('#phone_availability').html('<span style="color:red;">Invalid Phone</span>');
                        $('#submit-btn').prop('disabled', true);
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'backend/backend-task.php',
                            data: { id: id, phone: phone, req_type: "edit_phone_availability" },
                            success: function (response) {
                                console.log('Response', response);
                                if (response == 'Phone is Available') {
                                    $('#phone_availability').html('<span style="color:green;">Phone is available</span>');
                                    $('#submit-btn').prop('disabled', false); // Enable submit button
                                }
                                else if (response == 'Phone Already Taken') {
                                    $('#phone_availability').html('<span style="color:red;">Phone is already taken</span>');
                                    $('#submit-btn').prop('disabled', true); // Enable submit button
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
                // phone availability checking while edit data - end                
                $('#form').append($('<input>').attr({ type: 'hidden', name: 'edit_id', id: 'edit_id' }));
                $.ajax({
                    type: 'POST',
                    url: 'backend/backend-task.php',
                    data: { id: id, req_type: "get" },
                    success: function (response) {
                        console.log(response);
                        var data = JSON.parse(response);
                        var jsonData = JSON.parse(data.data.data);
                        console.log(data.data.id);
                        $('#edit_id').val(data.data.id);
                        $('#name').val(jsonData.name);
                        $('#email').val(jsonData.email);
                        $('#phone').val(jsonData.phone);
                        $('#dob').val(jsonData.dob);
                        $('#gender').val(jsonData.gender);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                $('#form').submit(function (e) {
                    e.preventDefault();
                    // serialize form data
                    var formData = $(this).serializeArray();
                    formData.push({ name: 'req_type', value: 'update' });
                    console.log(formData);
                    // AJAX Request
                    $.ajax({
                        type: 'POST',
                        url: 'backend/backend-task.php',
                        data: formData,
                        success: function (response) {
                            console.log(response);
                            // hide the modal here
                            $('#Modal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: response,
                            }).then((response) => {
                                if (response.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
                // edit data - end
            });
            // delete data - start       
            $('.deleteData').click(function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You Want to Delete this Data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: 'backend/backend-task.php',
                            data: { id: id, req_type: "delete" },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response,
                                }).then((response) => {
                                    if (response.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
            // delete data - end                        
            // name validation - start
            // allow only letters and whitespace using Regular expression
            $('#name').on('input', function () {
                var name = $(this).val();
                var regex = /^[a-zA-Z\s]*$/;
                if (!regex.test(name)) {
                    $('#name_error').text('Only letters and spaces are allowed in the name field.');
                    $('#submit-btn').prop('disabled', true);
                } else {
                    $('#name_error').text('');
                    $('#submit-btn').prop('disabled', false);
                }
            });
            // name validation - end
        });
        // script - end
    </script>
</body>

</html>