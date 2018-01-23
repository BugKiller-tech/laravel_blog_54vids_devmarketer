@extends('main')

@section('title', " | posts")

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Blog</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2" >
		@forelse($posts as $post)
		    <div class="post">
		        <h2>{{ $post->title }}</h2>
		        <h6 style="color: #aaa; font-style: italic;">Published: {{ date('M j, Y', strtotime($post->created_at)) }}</h6>
		        <p>{{ substr(strip_tags($post->body), 0, 300)}}{{ strlen(strip_tags($post->body))>300? '...' :''}}</p>
		        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
		    </div>
		    <hr>
		@empty
		<div class="post">
		    <h3>Nothing posts!</h3>
		</div>
		@endforelse
		<div class="row">
			<div class="col-md-12">
				{{ $posts->links() }}
			</div>
		</div>

	</div>
</div>
@endsection