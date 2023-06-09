<?php
include 'header.php';
include 'sidebar.php';
?>

<!-- [ Main Content ] start -->
<?php if(isset($_SESSION['username']) &&  !empty($_SESSION['username'])){ 
?>
<div class="pcoded-main-container">
      <div class="pcoded-wrapper">
        <div class="pcoded-content">
          <div class="pcoded-inner-content">
            <!-- [ breadcrumb ] start -->

            <!-- [ breadcrumb ] end -->
            <div class="main-body">
              <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                          <!-- [ basic-table ] start -->
                          <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Manage Users</h5>
                                            <span class="d-block m-t-5">List of <code>All</code> users table</span>
                                        </div>
                                        <div class="card-block table-border-style">
                                                                                                                <!-- Search form -->
                                <form id="searchBloodType">
                                <div class="row">

                                <div class="col-sm-8">
                                <div class="active-cyan-3 active-cyan-4 mb-4">
                                <input class="form-control" type="text" placeholder="Search By Name" aria-label="Search" name="search_name" id="search_name">
                                </div>
                                </div>

                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    </div>

                                </div>
                                </form>
                                <!-- Search form -->
                                            <div class="table-responsive">
                                                <button id="addNewUser" class="btn btn-info float-right mb-2">Add New User</button>
                                                
                                                <table class="table" id="UsersTable">
                                                    <thead></thead>

                                                    <tbody></tbody>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ basic-table ] end -->
                </div>
    <!-- modal -->
    <div class="modal" tabindex="-1" role="dialog" id="usersModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="usersForm">
            <!-- hidden input for id -->
            <input type="hidden" name="update_id" id="update_id">

            <div class="row">
            <!-- alert -->
            <div class="col-sm-12">
                <div class="alert alert-success d-none" role="alert">
                This is a success alert—check it out!
                </div>
                <div class="alert alert-danger d-none" role="alert">
                This is a danger alert—check it out!
               </div>
            </div>
            <!-- alert -->

                  <!-- name -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Full Name</label>
                          <input type="text" name="full_name" id="full_name" class="form-control">
                          <p class="err_name" style="color: red"></p>
                      </div>
                  </div>
                  <!-- name -->

                  <!-- gender -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Gender</label>
                          <select name="gender" id="gender" class="form-control">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                          <p class="err_gender" style="color: red"></p>
                      </div>
                  </div>
                  <!-- gender -->

                  <!-- user type -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">User Type</label>
                          <select name="userType" id="userType"     class="form-control">
                              <option value="Donor">Donor</option>
                              <option value="Recpient">Recpient</option>
                          </select>
                          <p class="err_usertype" style="color: red"></p>
                      </div>
                  </div>
                  <!-- user type -->

                  <!-- blood type -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Blood Type</label>
                          <select name="bloodType" id="bloodType"     class="form-control">
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="AB">AB</option>
                              <option value="O">O</option>
                          </select>
                          <p class="err_bdtype" style="color: red"></p>
                      </div>
                  </div>
                  <!-- blood type -->

                  <!-- phone -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Phone</label>
                          <input class="form-control" type="text" name="phonenumber" id="phonenumber">
                          <p class="err_phone" style="color: red"></p>
                      </div>
                  </div>
                  <!-- phone -->

                  <!-- gmail -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Gmail</label>
                          <input class="form-control" type="text" name="email" id="email">
                          <p class="err_gmail" style="color: red"></p>
                      </div>
                  </div>
                  <!-- gmail -->

                  <!-- username -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Username</label>
                          <input class="form-control" type="text" name="username" id="username">
                          <p class="err_username" style="color: red"></p>
                      </div>
                  </div>
                  <!-- username -->

                  <!-- password -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Password</label>
                          <input class="form-control" type="text" name="password" id="password">
                          <p class="err_pass" style="color: red"></p>
                      </div>
                  </div>
                  <!-- password -->

                  <!-- address -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Address</label>
                          <input class="form-control" type="text" name="address" id="address">
                          <p class="err_address" style="color: red"></p>
                      </div>
                  </div>
                  <!-- address -->

              </div>
      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
 <!-- modal -->


 <!-- Update MOdal -->
 <div class="modal" tabindex="-1" role="dialog" id="updateModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update User Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="updateForm">
            <!-- hidden input for id -->
            <input type="hidden" name="update_id" id="update_id">

            <div class="row">
            <!-- alert -->
            <div class="col-sm-12">
                <div class="alert alert-success d-none" role="alert">
                This is a success alert—check it out!
                </div>
                <div class="alert alert-danger d-none" role="alert">
                This is a danger alert—check it out!
               </div>
            </div>
            <!-- alert -->

                  <!-- name -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Full Name</label>
                          <input type="text" name="update_full_name" id="update_full_name" class="form-control">
                          <p class="err_update_name" style="color: red"></p>
                      </div>
                  </div>
                  <!-- name -->

                  <!-- gender -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Gender</label>
                          <select name="update_gender" id="update_gender" class="form-control">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                          <p class="err_update_gender" style="color: red"></p>
                      </div>
                  </div>
                  <!-- gender -->

                  <!-- user type -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">User Type</label>
                          <select name="update_userType" id="update_userType"     class="form-control">
                              <option value="Donor">Donor</option>
                              <option value="Recpient">Recpient</option>
                          </select>
                          <p class="err_update_usertype" style="color: red"></p>
                      </div>
                  </div>
                  <!-- user type -->

                  <!-- blood type -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Blood Type</label>
                          <select name="update_bloodType" id="update_bloodType"     class="form-control">
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="AB">AB</option>
                              <option value="O">O</option>
                          </select>
                          <p class="err_update_bdtype" style="color: red"></p>
                      </div>
                  </div>
                  <!-- blood type -->


                  <!-- address -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Address</label>
                          <input class="form-control" type="text" name="update_address" id="update_address">
                          <p class="err_update_address" style="color: red"></p>
                      </div>
                  </div>
                  <!-- address -->

              </div>
      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
 <!-- Update MOdal -->
                <!-- [ Main Content ] end -->
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<?php } else { ?>
<!-- header('Location: login.php'); -->
<script>
    window.location.href = "../views/login.php";
</script>
<?php } ?>

<!-- [ Main Content ] end -->

<?php
include 'footer.php';
?>
<script src="../js/Users.js"></script>
