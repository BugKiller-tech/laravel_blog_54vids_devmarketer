@extends('main')

<?php $title = htmlspecialchars($post->title); ?>
@section('title', " | $title")

@section('content')
<div class="row">
	<div class="col-md-8">
	<img src="{{ asset('images/'. $post->featured_image) }}" alt="">
		<h3>{{ $post->title }}</h3>
		<p>{!! $post->body !!}</p>
		<hr>
		<p><b>Posted in </b>{{ $post->category->name }}</p>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h3 class="comments-title">
		<span class="glyphicon glyphicon-comment comments-symbol"></span>
		{{ $post->comments()->count() }} Comments
	</h3>
		@foreach($post->comments as $comment)
			<div class="comment">
				<div class="author-info">
					<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) ."?s=50&d=retro" }}" class="author-image">
					<div class="author-name">
						<h4>{{ $comment->name }}</h4>
						<p class="author-time">{{ date('F jS, Y - g:i',strtotime($comment->created_at)) }}</p>
					</div>
				</div>

				<div class="comment-content">
					{{ $comment->comment }}
				</div>				
			</div>
		@endforeach
	</div>	
</div>


<div class="row" style='margin-top: 50px;'>
	<div class="col-md-8 col-md-offset-2">
	{!! Form::open(['route'=>['comments.store', $post->id], 'method'=>'POST']) !!}
		<div class="row">
			<div class="col-md-6">
				{!! Form::label('name', 'Name', []) !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			<div class="col-md-6">
				{!! Form::label('email', 'Email', []) !!}
				{!! Form::text('email', null, ['class'=>'form-control']) !!}
			</div>
			<div class="col-md-12">
				{!! Form::label('comment', 'Comment', []) !!}
				{!! Form::textarea('comment', null, ['class'=>'form-control', 'rows'=>'5']) !!}
				{!! Form::submit('Submit', ['class'=>'btn btn-success form-control btn-block', 'style'=>'margin-top: 20px;']) !!}
			</div>

		</div>
	{!! Form::close() !!}
	</div>
</div>
@endsection