@extends('navigation2')

@section('content_mcq')
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-4 col-lg-push-8 " id="id1">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<h2><small>Time Left</small></h2>
							<div id="clockdiv">
								<div>
									<span class="minutes"> 04 </span>
									<div class="smalltext">Minutes</div>
								</div>
								<div>
									<span class="seconds"> 23 </span>
									<div class="smalltext">Seconds</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-sm-12 col-lg-8 col-lg-pull-4" id="id2">
				<!-- Question Panel -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5>Question 1:</h5>
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>

						<div class="form-group">
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
									<span>A</span>Option 1
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
									<span>B</span>Option 2
								</label>
							</div>
						</div>
					</div>

					<div class="panel-footer text-center" id="mcq-btn">
						<button type="button" class="btn btn-danger pull-left">Prev</button>
						<button type="button" class="btn btn-success btn-lg">SUBMIT</button>
						<button type="button" class="btn btn-danger pull-right">Next</button>
					</div>
				</div>
			</div>            

			<div class="col-sm-12 col-lg-4 col-lg-push-8" id="id3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2> <small>Questions</small> </h2>
						<button type="button" class="btn btn-default btn-circle">1</button>
						<button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>
					</div>
				</div>
			</div>       

			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
</div>
<script type="text/javascript">
	var questions = {!! json_encode($questions) !!};
	var duration = {{$duration}};
</script>
@stop