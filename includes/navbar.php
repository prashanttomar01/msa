<div class="topbar">
        <h3>Dashboard</h3>
        <div class="top-right">
                <?php 
                $user_id = htmlspecialchars($_SESSION['user_id']);

                $query = "SELECT * FROM users WHERE id = $user_id";
                $userDts = $obj->fetchone($query);
                ?>
                <p class="welcome-text text-center"><?php  echo ucfirst($userDts['first_name']) . " " . ucfirst($userDts['last_name']); ?></p>
                <div class="profile-container">
                        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="User Avatar" class="profile-pic" onclick="toggleMenu()" />
                        <div class="dropdown-menu" id="dropdownMenu">
                                <a href="#">👤 Profile</a>
                                <a href="api/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                        </div>
                </div>
        </div>
</div>

<script>
        function toggleMenu() {
                document.getElementById("dropdownMenu").classList.toggle("show");
        }

        window.onclick = function(event) {
                if (!event.target.matches('.profile-pic')) {
                        let dropdown = document.getElementById("dropdownMenu");
                        if (dropdown.classList.contains('show')) {
                                dropdown.classList.remove('show');
                        }
                }
        }
</script>


<!-- <a href="api/logout.php" class="btn" type="submit" name="logoutbtn">Logout</a>  -->