<?php 
    
    // $sql = "SELECT permission FROM permission WHERE role=?";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$_SESSION['role']]);
    // $permission_account = $stmt->fetch(PDO::FETCH_ASSOC);
    // $permissions = json_decode($permission_account['permission'], true);

    // echo json_encode($_SESSION);     
    

    // echo  $_SESSION["role"];
    // if()

    // $username_role = "";
    // if ($_SESSION['role'] == 'super_admin') {
    //     // Super admin role
    //     $username_role = "Super Admin";

    // } 
    // else if ($_SESSION['role'] == 'unit_admin') {
    //     // Get the category (IU, EU, MU) for this unit admin
    //     $sql = "SELECT techCategory FROM efms_technicians WHERE techBioID=?";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->execute([$_SESSION['user']]);
    //     $tech_category = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $username_role = $tech_category ? strtoupper($tech_category['techCategory']) . " Unit Admin" : "Unit Admin";

    // } 
    // else if ($_SESSION['role'] == 'unit_semi_admin') {
    //     // Get the category (IU, EU, MU) for this unit admin
    //     $sql = "SELECT techCategory FROM efms_technicians WHERE techBioID=?";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->execute([$_SESSION['user']]);
    //     $tech_category = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $username_role = $tech_category ? strtoupper($tech_category['techCategory']) . " Unit Semi Admin" : "Unit Semi Admin";

    // } 
    // else if ($_SESSION['role'] == 'tech') {
    //     // Regular technician – show their unit
    //     $sql = "SELECT techCategory FROM efms_technicians WHERE techBioID=?";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->execute([$_SESSION['user']]);
    //     $tech_category = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $username_role = $tech_category ? strtoupper($tech_category['techCategory']) . " Technician" : "Technician";

    // } else {
    //     // Default for requestors or users
    //     $username_role = "User";
    // }
?>
    <aside class="sidebar">
        <!-- Logo / System Name -->
        <div class="sidebar-header">
            <h1>HR-EXAM</h1>
            <span>Human Resources</span>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">

            <p class="nav-section">MAIN</p>
            <ul>
                <li class="nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </li>
            </ul>

            <p class="nav-section">APPLICANTS</p>
            <ul>
                <li class="nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Applicants</span>
                    <span class="badge">3</span>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Examinations</span>
                </li>
            </ul>

            <p class="nav-section">EXAM MANAGEMENT</p>
            <ul>
                <li class="nav-item has-submenu" id="examBuilderToggle">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Exam Builder</span>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </li>
                    <!-- Submenu MUST be inside LI -->
                    <ul class="submenu" id="examBuilderMenu">
                        <li class="submenu-item" data-route="question_bank.php">
                            <i class="fa-solid fa-list-check"></i>
                            <span>Question Bank</span>
                        </li>

                        <li class="submenu-item" data-route="exam_categories.php">
                            <i class="fa-solid fa-layer-group"></i>
                            <span>Categories</span>
                        </li>

                        <li class="submenu-item" data-route="exams.php">
                            <i class="fa-solid fa-file-circle-check"></i>
                            <span>Exams</span>
                        </li>
                    </ul>
                

                <li class="nav-item">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    <span>Results</span>
                </li>
            </ul>

            <p class="nav-section">ADMIN</p>
            <ul>
                <li class="nav-item">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>HR Accounts</span>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-building"></i>
                    <span>Dashboard</span>
                </li>
            </ul>
        </nav>

        <!-- User Area -->
        <div class="sidebar-footer">
            <div class="user-info">
                <img src="../source/home_css/user.png" alt="User">
                <div>
                    <p class="name">Juan Dela Cruz</p>
                    <p class="role">HR Officer</p>
                </div>
            </div>

            <button class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </div>
    </aside>


    <div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal-title-incoming" class="modal-title-incoming" id="exampleModalLabel">Are you sure you want to logout?</h5>
                </div>
                <div id="modal-body-incoming" class="modal-body-incoming ml-2">
                    
                </div>
                <div class="modal-footer">
                    <button id="yes-modal-btn-logout" type="button" type="button" data-bs-dismiss="modal">YES</button>
                    <button id="no-modal-btn-logout" type="button" type="button" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>