<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        
        <a class="navbar-brand" href="clientHome.php"><img src="assets/img/logov6.png" alt="Logo" width="32" height="32" style="border-radius: 50%;">&nbsp; InTrade Business</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse row" id="navbarTogglerDemo02" style="z-index:10;">    
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="clientPage.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" >Welcome, <?=$_SESSION['sess_fname'];?>!</a>
                </li>
            </ul>
		</div>
    </div>
</nav>