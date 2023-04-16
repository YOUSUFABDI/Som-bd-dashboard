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
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login</h3>
                    <form id="logAdminForm">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="password" name="password" id="password">
                    </div>
     
                    <button class="btn btn-primary shadow-2 mb-4">Login</button>
                    <p class="mb-0 text-muted">Don't have an account? <a href="register.php">Signup</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include 'footer.php'
?>
<script src="../js/LoginAdmin.js"></script>