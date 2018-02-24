@extends('layouts.admin')

@section('content')

	<h1>Edit Post</h1>

	<div class="row">

		<div class="col-sm-3">
			<img src="{{'http://localhost/laravel-courses/application/public' . $post->photo->file}}" alt="" class="img-responsive">
		</div>
		<div class="col-sm-9">
			{!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

				<div class='form-group'>
					{!! Form::label('title', 'Title:') !!}
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>

				<div class='form-group'>
					{!! Form::label('category_id', 'Category:') !!}
					{!! Form::select('category_id', ['0' => 'Uncategorized'] + $categories, null, ['class' => 'form-control']) !!}
				</div>

				<div class='form-group'>
					{!! Form::label('photo_id', 'File:') !!}
					{!! Form::file('photo_id', ['class' => 'form-control']) !!}
				</div>

				<div class='form-group'>
					{!! Form::label('body', 'Body:') !!}
					{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 5]) !!}
				</div>

				<div class='form-group'>
					{!! Form::submit('Update Post', ['class' => 'btn btn-primany col-sm-4']) !!}
				</div>

			{!! Form::close() !!}

				
			{!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}


				<div class='form-group'>
					{!! Form::submit('Delete Post', ['class' => 'btn btn-danger col-sm-4']) !!}
				</div>

			{!! Form::close() !!}
		</div>
	</div>

	<div class="row">
		@include('includes.form-error')
	</div>
@endsection