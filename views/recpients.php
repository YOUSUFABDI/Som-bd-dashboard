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
                                            <h5>Recpients Table</h5>
                                            <span class="d-block m-t-5">List of <code>All</code> recpients</span>
                                        </div>
                                        <div class="card-block table-border-style">
                                                                                                                    <!-- Search form -->
                                    <form id="searchBloodType">
                                    <div class="row">

                                    <div class="col-sm-8">
                                    <div class="active-cyan-3 active-cyan-4 mb-4">
                                    <input class="form-control" type="text" placeholder="Search Blood" aria-label="Search" name="search_blood_type" id="search_blood_type">
                                    </div>
                                    </div>

                                    <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    </div>

                                    </div>
                                    </form>
                                    <!-- Search form -->

                                            <div class="table-responsive" id="print_area">
                                                <table class="table" id="recpientsTable">
                                                    <thead>
                                                    <tr></thead>

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
<script src="../js/Recpients.js"></script>