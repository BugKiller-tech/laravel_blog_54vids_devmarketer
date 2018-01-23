@extends('main')

@section('title', 'Categories')

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>Categories</h1>

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
			</thead>

			<tbody>
				@forelse($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<td>{{ $category->name }}</td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table>
	</div>

	<div class="col-md-3">
		<div class="well">
			{!! Form::open(['route'=>'categories.store', 'method'=>'POST']) !!}
			<h2>New Category</h2>
			{!! Form::label('name', 'Name:', []) !!}
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
			{!! Form::submit('Save', ['class'=>'btn btn-primary btn-block spacing-top-margin']) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection