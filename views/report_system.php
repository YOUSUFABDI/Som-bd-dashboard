<?php
include 'header.php';
include 'sidebar.php';
?>


    <!-- [ Main Content ] start -->
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
                                            <h5>Report Of the system</h5>
                                            <span class="d-block m-t-5" id='report_system'></span>
                                            
                                            <span class="d-block m-t-10" id='report_donors'></span>

                                            <span class="d-block m-t-10" id='report_recpient'></span>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive" id="print_area">
                                                <table class="table" id="reportTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Name</th>
                                                            <th>Gender</th>
                                                            <th>User Type</th>
                                                            <th>Blood Type</th>
                                                            <th>Phone</th>
                                                            <th>Gmail</th>
                                                            <th>Address</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody></tbody>
                                                    
                                                </table>
                                            </div>
                                            <button class="btn btn-success" id="print_statement"> <i class="fa fa-print"></i> Print</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ basic-table ] end -->
                </div>


<?php 
include 'footer.php';
?>
<script src="../js/ReportSystem.js"></script>