@extends('layouts.app')
@section('content')


{{-- Pleca --}}
<div class="container mt-5 pleca rounded-new">
	<div class="row">
		<div class="col-sm-6 my-5">
			<div class="padding-img">
				<img src="{{ asset($picture->image) }}" class="card-img-top">        
			</div>
		</div>
		<div class="col-sm-6 my-5">
			<div class="row mx-3">
				<div class="col-sm-3 mb-5">
					<div class="row">
						<div class="col d-flex justify-content-center">
							<a class="icon-details pb-4" href="{{ asset($picture->image) }}" download>
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
									<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
									<path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
								</svg>
							</a>
						</div>
						<div class="col d-flex justify-content-center">
							<a class="icon-details" href="">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
									<path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col d-flex justify-content-end">
							<a class="justify-content-end" href="{{ route('profiles',$upload_user->id) }}">	
								<p class="name-user">{{ $picture->user->name }}</p>
							</a>
						</div>
						<div class="col d-flex justify-content-center">
							<a href="{{ route('profiles',$upload_user->id) }}">
								<img src="{{ asset($picture->user->avatar) }}" class="avatar float-right" width="60px" height="55px">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col my-4">
				<p class="title-details pt-2">{{ $picture->title }}</p>
				<p class="description">{{ $picture->description }}</p>
				<blockquote class="blockquote">
					<footer class="firma">
						<cite title="Source Title">{{$upload_user->signature}}</cite>
					</footer>
				</blockquote>
				<div class="border-bottom mb-4"></div>
				<h2 class="comentarios pt-3">Comentarios</h2>
			</div>
			
			

			@if(Auth::check())
			<form action="{{ route('addComment') }}" method="GET" id="form-comment">
				@csrf
				<div class="row mt-3 mx-3">
					<div class="col-3 align-self-center d-flex justify-content-end">
						<img width="50px" height="45px" class=" avatar" 
						src="{{ asset(Auth::user()->avatar) }}">						
					</div>
					<div class="col-9 align-self-center">
						<div class="mb-3">
							<input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
							<input type="text" name="picture_id" value="{{ $picture->id }}" hidden>
							<textarea name="comment" cols="24" class="card-comment"
							placeholder="Write a comment...."></textarea>
						</div>
						<button type="submit" class="btn btn-danger">Comentar</button>
					</div>
				</div>
			</form>
			@endif
			<div class="mt-4" id="comments">
				@foreach($comments as $comment)
				<div class="row mx-4">
					<div class="col-3 align-self-center d-flex justify-content-end">
						<img width="50px" height="45px" class="align-self-center avatar"
						src="{{ asset($comment->user->avatar) }}">					
					</div>
					<div class="col-9 d-flex justify-content-start">
						<div class="card-new align-self-center">
							<div class="card-comment">
								<p class="pt-3 text-center">{{ $comment->comment }}</p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$("#form-comment").submit(function (ev) {
			$.ajax({
				type: $('#form-comment').attr('method'),
				url: $('#form-comment').attr('action'),
				data: $('#form-comment').serialize(),
				success: function (data) {
					showComments(data);
				}
			});
			ev.preventDefault();
		});

		function showComments(data) {
			var comments = JSON.parse(data);
			var str = '';

			for (let comment of comments) {
				str += `
				<div class="row mx-4">

				<!--Avatar-->

				<div class="col-3 align-self-center d-flex justify-content-end">
				<img width="50px" height="45px" class="align-self-center avatar"
				src="${comment.user.avatar}">
				</div>

				<!--Comment-->
				<div class="col-9 d-flex justify-content-start">
				<div class="card-new align-self-center">
				<div class="card-comment">
				<p class="pt-3 text-center">${comment.comment}</p>`;

				str += `	</div>
				</div>
				</div>
				</div>`;
			}

			$("#comments").html(str);
		}
	});
</script>









@endsection