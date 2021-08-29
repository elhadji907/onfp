@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
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
                        <div class="mr-3"><b>Adresse e-mail:</b> {{ auth::user()->email }}</div>
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
    </div>
    <div class="container-fluid col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
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
    </div>
    @hasrole('Demandeur')
    <div class="container-fluid col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="row mt-5">
            @if (isset($individuelle_demandeur->cin))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('individuelles/' . $individuelle_demandeur->id) !!}" target="_blank">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Individuelle)' }}</div>
                                        <div
                                            class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($individuelle_demandeur->modules as $module_individuelle)
                                                @if ($loop->last)
                                                    {!! $loop->count !!}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span>
                                            @if (isset($module_individuelle->name))
                                                <h5><label
                                                        class="badge badge-success">{{ $individuelle_demandeur->statut }}</label>
                                                </h5>
                                            @else
                                                <h5><label class="badge badge-danger">Invalide</label></h5>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if (isset($collective_demandeur->name))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('collectives/' . $collective_demandeur->id) !!}" target="_blank">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Collective)' }}</div>
                                        <div
                                            class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($collective_demandeur->modules as $module_collective)
                                                @if ($loop->last)
                                                    {!! $loop->count !!}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span>
                                            @if (isset($module_collective->name))
                                                <h5><label
                                                        class="badge badge-success">{{ $collective_demandeur->statut }}</label>
                                                </h5>
                                            @else
                                                <h5><label class="badge badge-danger">Invalide</label></h5>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if (isset($pcharge_demandeur->annee))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('pcharges/' . $pcharge_demandeur->id) !!}" target="_blank">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (prise en charge)' }}</div>
                                        <div
                                            class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($pcharge_demandeur->modules as $module)
                                                @if ($loop->last)
                                                    {!! $loop->count !!}
                                                @endif
                                            @endforeach
                                            @if (isset($module->name))
                                                <h5><label
                                                        class="badge badge-success">{{ $pcharge_demandeur->statut }}</label>
                                                </h5>
                                            @else
                                                <h5><label class="badge badge-danger">Invalide</label></h5>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span data-feather="mail"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="row mt-5">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mt-3">
                    <a class="btn btn-outline-primary btn-block" href="{!! url('individuelles/' . $individuelle_demandeur->id . '/edit') !!}"><span
                            data-feather="book-open"></span>Ajouter demande individuelle</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mt-3">
                    <a class="btn btn-outline-success btn-block" href="{!! url('collectives/' . $collective_demandeur->id . '/edit') !!}"><span
                            data-feather="book-open"></span>Ajouter demande collective</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mt-3">
                    <a class="btn btn-outline-info btn-block" href="{!! url('pcharges/' . $pcharge_demandeur->id . '/edit') !!}"><span
                            data-feather="book-open"></span>Ajouter prise en charge</a>
                </div>
            </div>
        </div>
    </div>
@else

<div class="container-fluid col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <div class="row mt-5">
        @if (isset($individuelle_user->cin))
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <a class="nav-link" href="{!! url('individuelles/' . $individuelle_user->id) !!}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ 'Demande (Individuelle)' }}</div>
                                    <div
                                        class="h5 mb-0 font-weight-bold text-gray-800">
                                        @foreach ($individuelle_user->modules as $module_individuelle)
                                            @if ($loop->last)
                                                {!! $loop->count !!}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span>
                                        @if (isset($module_individuelle->name))
                                            <h5><label
                                                    class="badge badge-success">{{ $individuelle_user->statut }}</label>
                                            </h5>
                                        @else
                                            <h5><label class="badge badge-danger">Invalide</label></h5>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if (isset($collective_user->name))
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <a class="nav-link" href="{!! url('collectives/' . $collective_user->id) !!}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ 'Demande (Collective)' }}</div>
                                    <div
                                        class="h5 mb-0 font-weight-bold text-gray-800">
                                        @foreach ($collective_user->modules as $module_collective)
                                            @if ($loop->last)
                                                {!! $loop->count !!}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span>
                                        @if (isset($module_collective->name))
                                            <h5><label
                                                    class="badge badge-success">{{ $collective_user->statut }}</label>
                                            </h5>
                                        @else
                                            <h5><label class="badge badge-danger">Invalide</label></h5>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if (isset($pcharge_user->annee))
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <a class="nav-link" href="{!! url('pcharges/' . $pcharge_user->id) !!}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ 'Demande (prise en charge)' }}</div>
                                    <div
                                        class="h5 mb-0 font-weight-bold text-gray-800">
                                        @foreach ($pcharge_user->modules as $module)
                                            @if ($loop->last)
                                                {!! $loop->count !!}
                                            @endif
                                        @endforeach
                                        @if (isset($module->name))
                                            <h5><label
                                                    class="badge badge-success">{{ $pcharge_user->statut }}</label>
                                            </h5>
                                        @else
                                            <h5><label class="badge badge-danger">Invalide</label></h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
    @endhasrole

@endsection
