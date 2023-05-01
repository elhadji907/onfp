@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-4">
            @can('update', $user->profile)
                <div class="col-4 text-center">
                    <img src="{{ asset(Auth::user()->profile->getImage()) }}" class="rounded-circle w-50" />
                </div>
                <div class="col-4">
                    <div class="mt-3 d-flex">
                        <div class="mr-1"><b>{{ auth::user()->civilite }}</b></div>
                        <div class="mr-1"><b>{{ auth::user()->firstname }}</b></div>
                        <div class="mr-1"><b>{{ auth::user()->name }}</b></div>
                    </div>
                    @if (auth::user()->date_naissance !== null)
                        <div class="mt-0 d-flex">
                            @if (auth::user()->civilite == 'M.')
                                <div class="mr-1"><b>né le</b></div>
                            @endif
                            @if (auth::user()->civilite == 'Mme')
                                <div class="mr-1"><b>née le</b></div>
                            @endif
                            <div class="mr-1">{{ auth::user()->date_naissance->format('d/m/Y') }}</div>
                            @if (auth::user()->lieu_naissance !== null)
                                <div class="mr-1">à</div>
                                <div class="mr-1">{{ auth::user()->lieu_naissance }}</div>
                            @endif
                        </div>
                    @endif
                    <div class="mt-0">
                        <div class="mr-3"><b>{{ __("Nom d'utilisateur") }}:</b> {{ auth::user()->username }}</div>
                        <div class="mr-3"><b>E-mail:</b> {{ auth::user()->email }}</div>
                        <div class="mr-3"><b>Téléphone:</b> {{ auth::user()->telephone }}</div>
                    </div>
                    @if (auth::user()->civilite == null or auth::user()->fixe == null)
                        <a href="{{ route('profiles.edit', [auth::user()->username]) }}"
                            class="btn btn-outline-danger mt-3">Compléter votre profil</a>
                    @else
                        <a href="{{ route('profiles.edit', [auth::user()->username]) }}"
                            class="btn btn-outline-secondary mt-3">Modifier mon profil</a>
                    @endif
                </div>
            @endcan
        </div>
        <div class="list-group mt-5">

            @if (isset(auth::user()->employee))
                @foreach (auth::user()->employee->courriers as $courrier)
                    <div class="list-group-item">
                        <h4><a href="{!! route('courriers.show', $courrier->id) !!}">{!! $courrier->objet ?? '' !!}</a></h4>
                        <p>{!! $courrier->message !!}</p>
                        <p><strong>Type de courrier : </strong> {!! $courrier->types_courrier->name ?? '' !!}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            {{--  <small>Posté le {!! $courrier->created_at->format('d/m/Y à H:m') !!}</small>  --}}
                            <small>Posté le {!! $courrier->created_at->diffForHumans() !!}</small>
                            <span class="badge badge-primary">{!! $courrier->user->firstname !!}&nbsp;{!! $courrier->user->name ?? '' !!}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info"> {{ __("Vous n'avez pas de courrier à votre nom") }} </div>
            @endif
        </div>
        {{--  <div class="d-flex justify-content-center pt-2">
            {!! $courrierss->links() !!}
        </div>  --}}
    </div>
    <div class="container-fluid col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="mt-5">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="mt-5">
            @if (session()->has('attention'))
                <div class="alert alert-danger" role="alert">
                    <strong>Oups!</strong>.<br><br>{{ session('attention') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-attention">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
@endsection
