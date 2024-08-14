 <?php if(isset($_SESSION['username'])): ?>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="editprofile.php">Edit</a></li>
        <li><a href="logout.php"><i class="material-icons">settings_power</i>LogOut</a></li>
    </ul>
    <?php endif; ?>
	
	   <ul id="dropdown1" class="dropdown-content">
        <li><a href="editprofile.php">Edit</a></li>
        <li><a href="logout.php"><i class="material-icons">settings_power</i>LogOut</a></li>
    </ul>

    <nav>
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">
                <img src="images/logo_header.png" alt="Logo" style="max-width: 110px; margin-left:6px">
            </a>
            <ul class="right hide-on-med-and-down">
                <li><a href="sass.html">Sass</a></li>
                <!-- Dropdown Trigger -->
                <?php if(isset($_SESSION['username'])): ?>
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="dropdown1">
					
                        <?php echo $_SESSION['username']; ?>
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="login.php">
                        <i class="material-icons">person_outline</i>LogIn
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>