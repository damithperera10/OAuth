<!DOCTYPE html>
<html lang="en">

<head>
	<title>SSD OAuth</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

	<div class="jumbotron text-center">
		<h2>My Google drive file upload</h2>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">

        <div style="text-align: center;">

          <h4>Upload File To Google Drive</h4>

          <form method="post" action="upload_to_drive.php" enctype="multipart/form-data">

            <div class="form-group" style="margin-top: 20px;">
              <input type="file" class="form-control-file" style="display: inline-block;" name="fileName">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Upload The File</button>
            </div>

          </form>

        </div>

      </div>
    </div>
	</div>

</body>

</html>
