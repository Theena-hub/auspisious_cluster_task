<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include ('db.php');
// fetch the categories from tbl_category
$query = "SELECT * FROM tbl_category WHERE status = 1 ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$tbl_category = [];
while ($row = mysqli_fetch_assoc($result)) {
    $decodedData = json_decode($row['data'], true);
    $tbl_category[] = array_merge($row, $decodedData);
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
                                    <h1>Category <span class="text-uppercase"></h1>
                                </div>
                                <div>
                                    <button type="button" id="add-btn" class="btn btn-link btn-soft-light text-white"
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
                                            <th>Name</th>
                                            <th>Discount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='record'>
                                        <?php foreach ($tbl_category as $data) {
                                            $id = $data['id'];
                                            echo "<tr>";
                                            echo "<td>" . $data['name'] . "</td>";
                                            echo "<td>" . $data['discount'] . "</td>";
                                            echo "<td>
                                                    <button type='button' class='btn btn-icon btn-sm btn-warning text-white text-uppercase edit-btn' data-id='" . $data['id'] . "' data-bs-toggle='modal' data-bs-target='#Modal'>                                                                                                                                                                                                                           
                                                        <span class='btn-inner'>
                                                        <svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                            <path d='M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                            <path fill-rule='evenodd' clip-rule='evenodd' d='M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                            <path d='M15.1655 4.60254L19.7315 9.16854' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path>
                                                        </svg>
                                                    </span>
                                                    </button>
                                                    <button type='button' class='btn btn-icon btn-sm btn-danger text-white text-uppercase delete-btn' data-id='" . $data['id'] . "'>                                                                                                                                                                   
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
                                        } ?>
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
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="discount">Discount</label>
                                    <input type="text" class="form-control" name="discount" id="discount" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary submit-btn" />
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
        $(document).ready(function () {
            $('#add-btn').click(function () {
                $('.modal-title').html('Add Data');
                $('.submit-btn').val('Submit');
                // form submit
                $('#form').submit(function (e) {
                    e.preventDefault();
                    var formData = $(this).serializeArray();
                    formData.push({ name: 'req_type', value: 'add' });
                    console.log(formData);
                    $.ajax({
                        method: 'POST',
                        url: 'backend/backend-category.php',
                        data: formData,
                        success: function (response) {
                            alert(response);
                            location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });
            $('.edit-btn').click(function () {
                $('.modal-title').html('Edit Data');
                $('.submit-btn').val('Update');
                $('#form').append($('<input>').attr({ type: 'hidden', name: 'edit_id', id: 'edit_id' }));
                var id = $(this).data('id');
                $.ajax({
                    method: 'POST',
                    url: 'backend/backend-category.php',
                    data: { id: id, req_type: 'get' },
                    success: function (response) {
                        var response = JSON.parse(response);
                        var data = response.data;
                        var jsonData = JSON.parse(data.data);
                        $('#edit_id').val(data.id);
                        $('#name').val(jsonData.name);
                        $('#discount').val(jsonData.discount);

                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
                $('#form').submit(function (e) {
                    e.preventDefault();
                    var formData = $(this).serializeArray();
                    formData.push({ name: 'req_type', value: 'update' });
                    $.ajax({
                        method: 'POST',
                        url: 'backend/backend-category.php',
                        data: formData,
                        success: function (response) {
                            alert(response);
                            location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                })
            });
            $(".close-btn").click(function () {
                $("#form")[0].reset();
                console.log('form-reset');
                $("#edit_id").remove();
            });
            $('#Modal').on('shown.bs.modal', function () {
                $('.modal-backdrop').click(function () {
                    $("#form")[0].reset();
                });
            });

            $('.delete-btn').click(function () {
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this data?")) {
                    $.ajax({
                        method: 'POST',
                        url: 'backend/backend-category.php',
                        data: { id: id, req_type: "delete" },
                        success: function (response) {
                            alert(response);
                            location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>