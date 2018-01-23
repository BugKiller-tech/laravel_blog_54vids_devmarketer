@extends('main')


@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@endsection


@section('content')
<div class="row">
{!! Form::model($post, ['route'=>['posts.update', $post->id], 'method'=>'PUT', 'files'=>true]) !!}
	<div class="col-md-8">
		{!! Form::label('title', 'Title', []) !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}

		{!! Form::label('slug', 'Slug', []) !!}
		{!! Form::text('slug', null, ['class'=>'form-control']) !!}

		{!! Form::label('category_id', 'Category:', []) !!}
		{!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}

		{!! Form::label('tags', 'Tags', []) !!}
		{!! Form::select('tags[]', $tags, null, ['class'=>'form-control select2_multi', 'multiple'=>'multiple']) !!}

		{!! Form::label('featured_image', 'Featured Image', []) !!}
		{!! Form::file('featured_image', []) !!}

		{!! Form::label('body', 'Content', ['class'=>'form-spacing-top']) !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>	
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
			  <dt>Created At:</dt>
			  <dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
			</dl>
			<dl class="dl-horizontal">
			  <dt>Last Updated At:</dt>
			  <dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
			</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('posts.show', 'Cancel', [$post->id], ['class'=>'btn btn-danger btn-block']) !!}
				</div>
				<div class="col-sm-6">
					{!! Form::submit('Save', ['class'=>'btn btn-success btn-block']) !!}
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}

</div>
@endsection


@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$(".select2_multi").select2();
		$(".select2_multi").select2().val({{ json_encode($post->tags()->pluck('tag_id')->all()) }}).trigger('change');
	</script>


	<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
	<script>
		tinymce.init({
			selector:'textarea',
			plugins:'link code',
			menubar:''
		});
	</script>
	
@endsection