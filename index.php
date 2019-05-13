<?php
	// For Debugging
	// ini_set( 'display_errors', 1 );
	// ini_set( 'display_startup_errors', 1 );
	// error_reporting( E_ALL );
?>

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
        <a class="navbar-brand" href="#">Mumble Soundboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#soundboard-navbar" aria-controls="soundboard-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="soundboard-navbar">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 audio-search" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 audio-search-btn" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div id="sound-clips" class="col-md-9">
                <h1 class="text-center">Mumble Soundboard</h1>

                <form id="audio-upload" class="my-5" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="audio-file-upload" class="d-block">Browse soundboard clips</label>

                        <div class="d-flex align-items-center justify-content-between">
                            <input type="file" id="audio-file-upload" class="d-inline-block audio-control-file" name="files[]" multiple />
                            <input type="submit" class="d-inline-block btn btn-primary" value="Upload File" name="submit" />
                        </div>
                    </div>

                    <div class="alert alert-success" role="alert">Successfully uploaded.</div>

                    <div class="alert alert-danger" role="alert"><strong>Error!</strong> Could not upload your file.</div>
                </form>

                <?php
				// Global Variables
				$errors     = [];
				$path       = 'assets/wav/';
				$extensions = [ 'mp3', 'wav' ];
				$files      = scandir( $path );
				$files      = preg_grep( '/^([^.])/', array_diff( scandir( $path ), array( '.', '..' ) ) );

				if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) :
					if ( isset( $_FILES[ 'files' ] ) ) :
						$all_files = count( $_FILES[ 'files' ][ 'tmp_name' ] );

						// File Upload Functionality
						for ( $i = 0; $i < $all_files; $i++ ) :
							$file_name = $_FILES[ 'files' ][ 'name' ][ $i ];
							$file_tmp  = $_FILES[ 'files' ][ 'tmp_name' ][ $i ];
							$file_type = $_FILES[ 'files' ][ 'type' ][ $i ];
							$file_size = $_FILES[ 'files' ][ 'size' ][ $i ];
							$file_ext  = strtolower( end( explode( '.', $_FILES[ 'files' ][ 'name' ][ $i ] ) ) );

							$file = $path . $file_name;

							if ( !in_array( $file_ext, $extensions ) ) :
								$errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
							endif;

							if ( $file_size > 2097152 ) :
								$errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
							endif;

							if ( empty( $errors ) ) :
								move_uploaded_file( $file_tmp, $file );
							endif;
						endfor;

						if ( $errors ) print_r( $errors );
					endif;
				endif;

				// Display Uploaded Files
				if ( $files ) :
					?>
                <div class="list-group">
                    <?php foreach ( $files as $file ) : ?>
                    <a href="<?php echo $path . $file; ?>" class="list-group-item list-group-item-action audio-file"><?php echo $file; ?></a>
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