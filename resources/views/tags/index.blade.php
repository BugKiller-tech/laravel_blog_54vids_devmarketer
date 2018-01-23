@extends('main')

@section('title', 'Categories')

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>Tags</h1>

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
			</thead>

			<tbody>
				@forelse($tags as $tag)
					<tr>
						<th>{{ $tag->id }}</th>
						<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table>
	</div>

	<div class="col-md-3">
		<div class="well">
			{!! Form::open(['route'=>'tags.store', 'method'=>'POST']) !!}
			<h2>New Tag</h2>
			{!! Form::label('name', 'Name:', []) !!}
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
			{!! Form::submit('Save', ['class'=>'btn btn-primary btn-block spacing-top-margin']) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection