@extends('layouts.admin')

@section('content')
	<h1>Media</h1>
	
	@if($photos)
	<table class="table">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Created</th>
	        <th>Updated</th>
	      </tr>
	    </thead>
	    <tbody>
			@foreach($photos as $photo)
				<tr>
					<td>{{$photo->id}}</td>
			        <td><img height="40" src="{{$photo->file ? 'http://localhost/laravel-courses/application/public' . $photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
			        <td>{{$photo->created_at->diffForHumans()}}</td>
			        <td>{{$photo->updated_at->diffForHumans()}}</td>
			        <td>
			        	{!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}

							<div class='form-group'>
								{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
							</div>

						{!! Form::close() !!}

			        </td>
				</tr>
			@endforeach
	    </tbody>
	</table>
	@endif
@endsection