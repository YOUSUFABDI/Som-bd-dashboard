<?php
include 'header.php';
?>

<div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-user-plus auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Sign up</h3>
                    <form id="regAdminForm">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="gmail" id="gmail">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="password" name="password" id="password">
                    </div>
                    <button class="btn btn-primary shadow-2 mb-4">Sign up</button>
                    <p class="mb-0 text-muted">Allready have an account? <a href="login.php"> Log in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include 'footer.php'
?>
<script src="../js/RegisterAdmin.js"></script>