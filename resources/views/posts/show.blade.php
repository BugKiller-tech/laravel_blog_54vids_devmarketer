@extends('main')

@section('content')
<div class="row">
	<div class="col-md-8">
		<img src="{{ asset('images/'.$post->featured_image) }}" alt="">
		<h1>{{ $post->title }}</h1>
		<div class="lead">
			{!! $post->body !!}
		</div>
		<hr>
		<div class="tags">
			@foreach($post->tags as $tag)
				<span class="label label-default">{{ $tag->name }}</span>
			@endforeach
		</div>


		<div class="row col-md-12" id="backend-comments" style="margin-top: 50px;">
			<h3>Comments <small>{{ $post->comments()->count() }} </small> total</h3>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Comment</th>
						<th style="width:70px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($post->comments as $comment)
					<tr>
						<td>{{ $comment->name }}</td>
						<td>{{ $comment->email}}</td>
						<td>{{ $comment->comment }}</td>
						<td>
							<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
							<a data-confirm="Really delete?" href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>


	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
			  <label>Slug:</label>
			  <p><a href="{{ url('blog/'.$post->slug) }}">{{ url('blog/'.$post->slug) }}</a></p>
			</dl>

			<dl class="dl-horizontal">
			  <label>Category:</label>
			  <p>{{ $post->category->name }}</p>
			</dl>

			<dl class="dl-horizontal">
			  <label>Created At:</label>
			  <p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
			</dl>
			<dl class="dl-horizontal">
			  <label>Last Updated At:</label>
			  <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
			</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('posts.edit', 'Edit', [$post->id], ['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
					{!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
						{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('posts.index') }}" class="btn btn-default btn-block btn-top spacing-top-margin"><< See the All posts</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
