	<section id="navbar">	
		<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow">
		<div class="container">
			<a class="navbar-brand" href="subdashboard.php">Admin Dashboard</a>
				<button type="button" class="navbar-toggler" arial-expanded="false" arial-label="Toggle navigation" data-toggle="collapse" data-target="#navbarNav" arial-controls="navbarNav">
					<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="post.php"><i class="fab fa-blogger-b mr-1 text-primary"></i>Posts</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-file-word text-primary mr-1"></i>Pages</a></li>
				<li class="nav-item"><a class="nav-link" href="profile.php?prid=<?=$id;?>"><i class="fas fa-user-circle mr-1 text-primary"></i>Profile</a></li>
         	</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link text-warning" href="../index.php">Visit Blog</a></li>
				<li class="nav-item"><a class="nav-link text-secondary" href="#"><?= 'welcome, '.$username; ?></a></li>
				<li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fa fa-sign-out" arial-hidden="true"></i>Logout</a></li>
         	</ul>
		</div>
	</div>
</nav>
</section>
    							    <!-- breadcrum section---->
									<div class="container">
										<ol class="breadcrumb">
											<li class="active">Dashboard</li>
										</ol>
									</div>
					
							<!-- header section--->
							<header id="header">
								<div class="container">
									<div class="row bg-light py-2">
										<div class="col-md-10">
											<h4 class="card-title my-2">Dashboard <small class="card-text">Manage Your Blog</small></h4>
										</div>
										<div class="col-md-2">
											<div class="dropdown">
											    	<button type="button" class="dropdown-toggle btn-primary" href="#" data-toggle="dropdown" arial-haspopup="true" arial-expanded="false" id="dropdownMenuButton">
													Add Content
												</button>
												<ul class="dropdown-menu" arial-labelledby="dropdownMenuButton">
													<li><a class="dropdown-item" style="cursor: pointer;" type="button" data-toggle="modal" data-target="#addpage">Add post</a></li>
													<li><a class="dropdown-item" href="#">Add Pages</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</header>
							
								
	