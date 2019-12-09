<?php include_once 'functions.php'; ?>

<?php		
	//ini_set("allow_url_fopen", 1);
	
	$json = file_get_contents( $API_URL );
	$obj = json_decode( $json );
	
	if( isset( $obj->error_name ) && $obj->error_name == "user" ) {	
		echo $obj->message;
		die;
	}else if( isset( $obj->error_name ) && $obj->error_name == "album" ) {	
		echo $obj->message;
		die;
	}
?>

<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Akash Darji">
		<meta name="generator" content="Akash 1.1">
		<title>PHP Back End Web Developer</title>

		<!-- Bootstrap core CSS -->
		<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<!-- Custom styles for this template -->
		<link href="css/style.css" rel="stylesheet">
		
	</head>

	<body>
		<div id="gradient" />

		<div class="profile">
			<div class="container">
				<div class="row">
					
					<div class="col-md-2">
						<img src="<?php echo $obj->profile_picture; ?>" width="100%" height="100%" class="img-profile img-fluid img-thumbnail rounded-circle"/>
					</div>
					
					<div class="col-md-10">
						<h2 class="heading"><?php echo $obj->name; ?></h2>
						
						<div class="row">
							<div class="col-md-8">
								<p class="text-muted bio"><?php echo $obj->bio; ?></p>
							</div>
							
							<div class="col-md-4">
								<a href="tel:<?php echo $obj->phone; ?>" class="phone"><i class="fa fa-phone-square"></i> <span><?php echo $obj->phone; ?></span></a><br/>	
								<a href="mailto:<?php echo $obj->email; ?>" class="email"><i class="fa fa-envelope-o"></i> <span><?php echo $obj->email; ?></span></a>
							</div>						
						</div>
					</div>

				</div>	
			</div>
		</div>
							
		<div class="albums">
			<div class="container">
				<div class="row">
					
					<?php foreach($obj->album as $album) { ?>
					
					<div class="col-md-4 gallery album-">
						<div class="card mb-4 shadow-sm"> 
							<img src="<?php echo $album->img; ?>" width="100%" height="225" text="landscape" class="image" /> <div class="middle"></div>

							<title><?php echo $album->title; ?></title>

							<div class="card-body">
								<p class="card-text"><?php echo $album->description; ?></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="text-featured">
										<?php if($album->featured == 1) echo "<span>#Featured</span>"; ?>
									</div>
									<small class="text-muted"><?php echo $album->date; ?></small>
								</div> 
							</div>
						</div>
					</div>					
					
					<?php } ?>
					
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.min.js"></script>
		
		<script src="js/gradient.js"  type="text/javascript" ></script>
		
	</body>

</html>
