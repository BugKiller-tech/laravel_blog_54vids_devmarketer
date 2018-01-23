@extends('main')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')

<div class="row col-md-8 col-md-offset-2">
	{!! Form::open(array('route'=>'posts.store', 'data_parsley_validate'=>'', 'files'=>true)) !!}
		{!! Form::label('title', 'Title: ', []) !!}
		{!! Form::text('title', '', ['class' => 'form-control', 'required'=>'', 'maxlength'=>"255"]) !!}


		{!! Form::label('slug', 'Slug', []) !!}
		{!! Form::text('slug', null, ['class'=>'form-control', 'required'=>'', 'minlength'=>'5', 'maxlength'=>'25']) !!}

		{!! Form::label('category_id', 'Category', []) !!}
		<select name="category_id" class='form-control'>
			@forelse($categories as $category)
				<option value="{{ $category->id }}">{{ $category->name }}</option>
			@empty
			@endforelse
		</select>

		{!! Form::label('featured_image', 'Featured Image', []) !!}
		{!! Form::file('featured_image', []) !!}



		{!! Form::label('body', 'Posts Body', []) !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}


		{!! Form::label('tags', 'Tags', []) !!}
		<select name="tags[]" class='form-control select2-multi' multiple="multiple">
			@forelse($tags as $tag)
				<option value="{{ $tag->id }}">{{ $tag->name }}</option>
			@empty

			@endforelse
		</select>

		{!! Form::submit('Submit', ['class' => 'btn btn-success btn-lg btn-block', 'style'=>'margin-top: 20px;']) !!}


	{!! Form::close() !!}
</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}


	<script type="text/javascript">
		$(".select2-multi").select2();
	</script>


	{{-- <script src="{{ asset('js/tinymce.min.js') }}"></script> --}}
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
	<script>
		tinymce.init({
			selector:'textarea',
			plugins:'link code',
			menubar:''
		});
	</script>
@endsection
