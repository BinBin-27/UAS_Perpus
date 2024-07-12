<?php
session_destroy();

echo '
<div class="alert">
    <div class="card text-bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Sampai Jumpa</div>
        <div class="card-body">
            <h5 class="card-title">Kembali Ke Halaman Login</h5>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function() {
        window.location.href = "login.php";
    }, 1000);
</script>
';
exit;
?>