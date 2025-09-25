<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/d3274a5627.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="sidebar">
        <!-- <h3 class="text-start px-3 sidebar-header">Dashboard</h3> -->
        <!-- <a class="<?php echo ($page == 'initialize-msa') ? 'active' : ''; ?>" href="initialize-msa.php">Initialize MSA</a> -->
        <a class="menu-item <?php echo ($page == 'user-master') ? 'active' : ''; ?>" href="user_master.php"> <i class="fa-regular fa-circle-user"></i> User Master</a>
        <a class="menu-item <?php echo ($page == 'msa-record') ? 'active' : ''; ?>" href="msa-record.php"><i class="fa-regular fa-file"></i>MSA Record</a>
        <span class="micon bi bi-file-earmark-text"></span><a class="menu-item <?php echo ($page == 'msa-view') ? 'active' : ''; ?>" href="msa_view.php"><i class="fa-regular fa-file-word"></i>MSA Report</a>
    </div>
</body>
    </html>