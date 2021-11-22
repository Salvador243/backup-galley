@extends('layouts.app')
@section('content')
{{-- profile_details --}}
<div class="container my-3">
    <div class="col-md-12 justify-content-center my-5">
        <img class="rounded-circle mx-auto d-block mb-4 avatar" src="{{asset($data->avatar)}}">
        <div class="row justify-content-center d-flex">
            <p class="align-self-center text-pleca text-center">{{$data->name}}</p>
            @can('edit profile')
            @if($data->email == Auth::user()->email || Auth::user()->hasrole('admin') )
            <form action="{{ route( 'Eprofile', $data->email) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger ml-3" href="">Editar Perfil <svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                </button>
            </form>
            @endif
            @endcan
        </div>
        <blockquote class="blockquote text-center">
            <footer class="blockquote-footer">
                <cite title="Source Title">{{$data->signature}}</cite>
            </footer>
        </blockquote>
    </div>

    <div class="col-md-12 my-5 pleca rounded-new">
        <div class="container py-4">
            <h4 class="text-pleca">Fotos</p>
        </div>
        <div class="card-columns">
            @foreach($data->pictures as $picture)
            <div class="card">
                <a href="{{ route('picture_details', $picture->id) }}">
                    <img src="{{ asset($picture->image) }}" alt="" class="card-img-top">
                </a>
                @can('view', $picture->user_id)
                <form action="{{route('delete', $picture->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar" href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path
                                d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
                        </svg>
                    </button>
                </form>
                @endcan
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
