<?php
	error_reporting(0);
	session_start();
	#error_reporting(0);
    require_once '../connection/db.php';
    if (strlen($_SESSION['id'] == 0)) {
        header('location:sublogin.php');
        exit();
	}
			$error = '';
            $id = $_SESSION['id'];
            $query = "SELECT * FROM subusers WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i',$id);
			if ($stmt->execute()) {
				$process = $stmt->get_result();
				$result = $process->fetch_assoc();
				$username = $result['username'];
				$_SESSION['username'] = $username;
				$stmt->close();
			}
			
			// if post is submitted
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (isset($_POST['save'])) {
			$p_title = mysqli_real_escape_string($conn,strip_tags($_POST['post-title']));
			$p_body = $_POST['editor1'];
			$meta_tag = mysqli_real_escape_string($conn,strip_tags($_POST['meta-tag']));
			$meta_dsc = mysqli_real_escape_string($conn,strip_tags($_POST['meta-dsc']));
			$post_ctg = mysqli_real_escape_string($conn,strip_tags($_POST['post-ctg']));
			$author = mysqli_real_escape_string($conn,strip_tags($_POST['author']));
			if (!preg_match("!image!",$_FILES['post-img']['type'])) {
				$error= '<div class="alert alert-danger"> Error! check if it is image, not large size and file type is valid</div>'."<br>"; 		
			}
			else{
				//inserting to the database with prepared statement method
				$image_path = "../images/".$_FILES['post-img']['name'];
				move_uploaded_file($_FILES['post-img']['tmp_name'],$image_path);
			$query = "INSERT INTO posts(post_title,post_content,post_tag,post_desc,post_category,post_author,image_dir)
			 VALUES(?,?,?,?,?,?,?)";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('sssssss',$p_title,$p_body,$meta_tag,$meta_dsc,$post_ctg,$author,$image_path);
			if ($stmt->execute()) {
				$error= '<div class="alert alert-success">Content uploaded successfully!</div>';
			}
			else {
				$error = '<div class="alert alert-danger">Error posting content! Try again later.</div>';
			}
		}
	}
}
				    // looping posts from the database to the table
				$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 7";
				$stmt = $conn->prepare($query);
				if($stmt->execute()){
					$process = $stmt->get_result();
				}
				else{
					$error = '<div class="alert alert-danger">Error fetching contents! Try again later.</div>';
				}

				
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin | Dashboard</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
	<style type="text/css">
		td > button{
			margin-right: 5px;
		}
	</style>
</head>
		<body>					<!-- header section-->
        						<?php include '../includes/header.php'; ?>
								<!-- header section ends-->
								<!--- === error and success of the comment starts-->
								<div class="container"><?php echo $error;?></div>
								<!--- === error and success of the comment ends-->
								<section id="maincontent">
									<!-- including sidebar file-->
									<?php include '../includes/sidebar.php'; ?>	
									<!--website overview-->
									<div class="col-md-9 my-3">
											<div class="card">
												<div>
													<h5 class="list-group-item active" href="#">Website Overview</h5>
												</div>
												<div class="row p-2">
													<div class="col-md-3 my-2 card-body shadow text-center">
														
															<h2>200</h2>
															<h4>Users</h4>
														
													</div>
														<div class="col-md-3 my-2 text-center card-body shadow">
														
															<h2>200</h2>
															<h4>Pages</h4>
														
													</div>
													<div class="col-md-3 my-2 text-center card-body shadow">
														
															<h2>1000</h2>
															<h4>Posts</h4>
														
													</div>
													<div class="col-md-3 my-2 text-center card-body shadow">
														
															<h2>20000</h2>
															<h4>Visitors</h4>
														
													</div>
												</div>
											</div><br>
											<!-- latest post--->
										<div class="card shadow">
												<div>
													<h3 style="border-radius: 5px;" class="card-title bg-primary text-center text-white">Latest Post</h3>
												</div>
												<div class="card-body">
													<table class="table table-bordered table-responsive table-hover">
														<thead>
															<tr>
																<th>S/N</th>
																<th>Title</th>
																<th>Author</th>
																<th>Date</th>
																<th>Category</th>
																<th>Action</th>
															</tr>
														</thead>
														<?php
															$count = 1;
															while ($result = $process->fetch_assoc()) {?>
														<tbody>
															<tr>
																<?php $pid = $result['id'];?>
																<td><?php echo $count;?></td>
																<td><?php echo $result['post_title'];?></td>
																<td><?php echo $result['post_author'];?></td>
																<td><?php echo $result['post_date'];?></td>
																<td><?php echo $result['post_category'];?></td>
																<td style="display:flex;">
																<button type="submit" name="edit" class="btn btn-primary">
                                                                <a style="color:white;text-decoration:none;" href="editpost.php?pid=<?php echo $pid;?>">Edit</a>
                                                                </button>
                                                                <button class="btn btn-danger" name="delete">
                                                                <a style="color:white;text-decoration:none;" href="deletepost.php?pid=<?php echo $pid;?>">Delete
                                                                </a>
                                                                </button>
																</td>
															</tr>
														</tbody>
														<?php $count = $count +1; }?>
													</table>
												</div>
											</div>


										</div>
										</div>
									</div>							
					</section>
					<!-- modal section-->
					<?php include '../includes/modal.php';?>
					<!-- modal section ends-->
					<!-- footer section -->
						<?php include '../includes/footer.php'; ?>
						<!-- footer section ends-->
					<script src="../js/jquery.min.js"></script>
					<script src="../js/popper.min.js"></script>
					<script src="../js/bootstrap.min.js"></script>
					<script src="../ckeditor/ckeditor.js"></script>
</body>
</html>