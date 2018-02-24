@extends('layouts.blog-post')

@section('content')
	<!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at ? $post->created_at->diffForHumans() : '...'}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? 'http://localhost/laravel-courses/application/public' . $post->photo->file : 'http://placehold.it/900x300'}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->body}}</p>

    <hr>

	@if(Session::has('comment_message'))
		<p class="bg-danger">{{session('comment_message')}}</p>
	@endif

    @if(Session::has('reply_message'))
        <p class="bg-danger">{{session('reply_message')}}</p>
    @endif

    <!-- Blog Comments -->

@if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

		{!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
			<input type="hidden" name="post_id" value="{{$post->id}}">

			<div class='form-group'>
				{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
			</div>

			<div class='form-group'>
				{!! Form::submit('Submit Comment', ['class' => 'btn btn-primany']) !!}
			</div>

		{!! Form::close() !!}
    </div>
@endif

    <hr>

    <!-- Posted Comments -->
@if(count($comments) > 0)
    @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{$comment->photo ? 'http://localhost/laravel-courses/application/public' . $comment->photo : 'http://placehold.it/64x64'}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at ? $comment->created_at->diffForHumans() : '...'}}</small>
            </h4>
            <p>{{$comment->body}}</p>

            @if($comment->replies)
                @foreach($comment->replies as $reply)
                    @if($reply->is_active == 1)
                        <!-- Nested Comment -->
                        <div id="nested-comment" class="media">
                            <a class="pull-left" href="#">
                                 <img height="64" class="media-object" src="{{$reply->photo ? 'http://localhost/laravel-courses/application/public' . $reply->photo : 'http://placehold.it/64x64'}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at ? $reply->created_at->diffForHumans() : '...'}}</small>
                                </h4>
                                <p>{{$reply->body}}</p>
                            </div>
                        </div>

                        <div class="comment-reply-container">

                            <button class="toogle-reply btn btn-primary pull-right">Reply</button>

                            <div class="comment-reply">
                                {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}
                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                    <div class='form-group'>
                                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                    </div>

                                    <div class='form-group'>
                                        {!! Form::submit('Submit Reply', ['class' => 'btn btn-primany']) !!}
                                    </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    @endforeach
@endif
@endsection

@section('scripts')
    <script>
        $('.comment-reply-container .toogle-reply').click(function(){
            $(this).next().slideToggle("slow");
        });
    </script>
@endsection