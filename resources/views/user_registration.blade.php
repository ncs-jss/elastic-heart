<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<link rel="stylesheet" href="{{URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css')}}" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="{{URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css')}}" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="{{URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')}}" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="jumbotron">
		<h1 style="text-align:center">Registration</h1><br>
	</div>
			<div style="text-align:center">
			<form class="form-horizontal" role="form" action=" " method="POST">
				<div class="form-group">
				<label for="name" class="col-md-4 control-label">Full Name</label>
					<div class="col-md-5">
						<input type="text" name="name" class="form-control" placeholder="Full Name">
					</div>
				</div><br>
				<div class="form-group">
					<label for="college" class="col-md-4 control-label">College Name</label>
					<div class="col-md-5">
						<input type="text" name="college" class="form-control" placeholder="College Name">
					</div>
				</div><br>
				<div class="form-group">
					<label for="year" class="col-md-4 control-label">Year</label>
					<div class="col-md-5">
					<select class="form-control" name="year">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div>
				</div><br>
				<div class="form-group">
					<label for="course" class="col-md-4 control-label">Course</label>
					<div class="col-md-5">
					<select class="form-control" name="course">
						<option>B.Tech</option>
						<option>MCA</option>
						<option>MBA</option>
						<option>XYZ</option>
					</select>
					</div>
				</div><br>
				<div class="form-group">
					<label for="contact" class="col-md-4 control-label">Contact</label>
					<div class="col-md-5">
						<input type="text" name="contact" class="form-control" placeholder="Contact">
					</div>
				</div><br>
				<div class="form-group">
					<label for="email" class="col-md-4 control-label">E-mail</label>
					<div class="col-md-5">
						<input type="text" name="email" class="form-control" placeholder="E-mail">
					</div>
				</div><br>
				<div class="col-md-7"></div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">Register Me!</button>
                    </div>
                </div>
			</form>
		</div>
	</div>
</body>
</html>