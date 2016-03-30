@extends('navigation')
@content('section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $event }}
      @if($event_type == 2 || $event_type == 3)
      <div class="dropdown pull-right">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Go To Ques:
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            @for($i = 1; $i <= level; $i++)
            <li><a id="goto" val="{{ $i }}"><p>level {{ $i }}</p></a></li>
            @endfor
        </ul>
    </div>
    @endif
</h1>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <!-- ./col -->
    <div class="col-lg-12 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-grey " id="image">
        <div class="inner">
          <div data-original-title="Click To Expand" data-toggle="tooltip" data-placement="top"><a href="#myModal" data-toggle="modal"><img src="assets/quizpic.jpg" class="img-responsive"></a></div>
      </div>
      <div class="icon">
          <i class=""></i>
      </div>
  </div>
</div><!-- ./col -->
<!-- Modal HTML -->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">How Does It Look ?</h4>
    </div>
    <div class="modal-body">
        <img src="{{ asset($question->image) }}" class="img-responsive">
    </div>
</div>
</div>
</div>
<div class="col-lg-8 col-xs-12">
  <!-- small box -->
  <div class="small-box " id="question" style="margin-top:20px;">
    <div class="inner">
      <h3 class="text-purple">Level - {{ $level }}</h3>
      <hr>
      <p>
        {{ $question->question }}
      </p>
  </div>
</div>
</div>
<div class="col-lg-4 col-xs-12 col-md-8 col-lg-offset-0">
  <!-- small box -->
  <div class="form-group">
    <input type="text" class="form-control" name="send" placeholder="Your answer can be correct ! Let's Check.." id="input-box" style="margin-top:20px;" >
</div>

</div><!-- ./col -->
<div class="col-xs-11 col-sm-5 col-md-3 " id="go">
  <a id='go' q-id="{{ $question->id }}" e-id="{{ $event->id }}">Try <span><i class="ion ion-log-in pull-right"></i></span></a>
</div><!-- ./col -->
</div><!-- /.row -->
<!-- Main row -->

<!-- Replace alert-warning with alert-success for right answer  -->

<div class="alert alert-success" style="margin-top:20px;" hidden>
    <p><strong></p>
</div>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop