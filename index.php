<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Soundboard for the Mumble chat client.">
	<meta name="keywords" content="HTML, CSS, JS, SASS, JavaScript, jQuery, PHP, framework, bootstrap, front-end, frontend, web development, Mumble, chat, client">
	<meta name="author" content="Michael Nugent and Steven Klickermann">
	<title>Mumble Soundboard</title>
	<link rel="shortcut icon" href="favicon.ico">

	<!-- build:css -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- endbuild -->
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href=".">Mumble Soundboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div id="sound-clips" class="col-md-9">
				<h1 class="text-center">Mumble Soundboard</h1>

				<form id="audio-upload" class="my-5" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="audio-file-upload">Browse soundboard clips</label>
						<input type="file" id="audio-file-upload" class="d-block audio-control-file" name="files[]" multiple />
						<input type="submit" value="Upload File" name="submit" />
					</div>
				</form>

				<?php
				$path  = 'assets/wav';
				$target_file = $path . basename( $_FILES[ "fileToUpload" ][ "name" ] );
				$upload = 1;
				$audio_file_type = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION) );
				$files = scandir( $path );
				$files = array_diff( scandir( $path ), array( '.', '..' ) );

				// Check if the file already exists
				if ( file_exists( $target_file ) ) :
					$upload = 0;
				endif;

				// Check the file size
				if ( $_FILES[ "fileToUpload" ][ "size" ] > 500000 ) :
					$upload = 0;
				endif;

				// Only allow MP3 and WAV file formats
				if ( $audio_file_type != "mp3" && $audio_file_type != "wav" ) :
					$upload = 0;
				endif;

				// Check if the $upload variable flag is set to 0 by an error
				if ( $upload === 0 ) :
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				else :
					if ( move_uploaded_file( $_FILES[ "fileToUpload" ][ "tmp_name" ], $target_file ) ) :
						echo "The file " . basename( $_FILES[ "fileToUpload" ][ "name" ]) . " has been uploaded.";
					else :
						echo "Sorry, there was an error uploading your file.";
					endif;
				endif;

				if ( $files ) :
					?>
					<div class="list-group">
						<?php foreach ( $files as $file ) : ?>
							<a href="<?php echo $path . '/' . $file; ?>" class="list-group-item list-group-item-action audio-file"><?php echo $file; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- build:js -->
	<script src="assets/js/main.js"></script>
	<!-- endbuild -->
</body>

</html>
