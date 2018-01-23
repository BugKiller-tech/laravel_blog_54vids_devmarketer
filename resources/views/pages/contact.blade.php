@extends('main')

@section('title','Contact Us')

@section('content')
<div class="container">
    <div class="row col-md-12">
        {!! Form::open(['url'=>'contact', 'method'=>'POST']) !!}
        	<div class="form-group">
        		<label for="title">Title</label>
        		<input name="title" type="text" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="email">Email</label>
        		<input name="email" type="text" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="subject">Content</label>
        		<textarea name="subject" class="form-control" id="" cols="30" rows="10"></textarea>
        	</div>
        	<input class="btn btn-success" type="submit" value="Send">
        {!! Form::close() !!}
    </div>
</div>
@endsection