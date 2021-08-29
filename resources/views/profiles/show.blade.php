@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-4 text-center">
                <img src="{{ asset(auth::user()->profile->getImage()) }}" class="rounded-circle w-50" />
            </div>
            <div class="col-4">
                @can('update', $user->profile)
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
                @endcan
            </div>
            @unlessrole('Demandeur')
            <div class="col-4">
                <div class="mt-3 d-flex">
                    @if (isset($user_connect))
                        <table class="table table-bordered" id="table-tresors" width="100%" cellspacing="0">
                            <thead class="bg-info text-dark">
                                <tr>
                                    <th style="width:5%;">N°</th>
                                    <th style="width:75%;">TYPE</th>
                                    <th style="width:20%;">STATUT</th>
                                </tr>
                            </thead>
                            <tfoot class="table-dark">
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($demandeurs as $demandeur)
                                    @can('view', $demandeur)
                                        <tr>
                                            <td class="align-middle">{!! $i++ !!}</td>
                                            <td class="align-middle">{!! $demandeur->types_demande->name ?? ' ' !!}</td>
                                            <td style="text-align: center;">
                                                @if ($demandeur->modules == '[]')
                                                    <label class="badge badge-danger">Invalide</label>
                                                @else
                                                    <label class="badge badge-success">{{ $demandeur->statut }} </label>
                                                @endif
                                            </td>
                                        </tr>
                                    @endcan
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    @endif
                </div>
            </div>
        @else
            @endunlessrole
        </div>
    </div>
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
    @hasrole('Demandeur')
    <div class="container-fluid">
        <div class="row mt-5">
            @if (isset($individuelle_demandeur->cin))
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-3">
                        <a class="nav-link" href="{!! url('individuelles/' . $individuelle_demandeur->id) !!}" target="_blank">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Individuelle)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($individuelle_demandeur->modules as $module_individuelle)
                                            @endforeach
                                            @if (isset($module_individuelle->name))
                                                <h5><label
                                                        class="badge badge-success">{{ $individuelle_demandeur->statut }}</label>
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
            @if (isset($collective_demandeur->name))
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-3">
                        <a class="nav-link" href="{{ route('courriers.index') }}" target="_blank">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Collective)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($collective_demandeur->modules as $module_collective)
                                            @endforeach
                                            @if (isset($module_collective->name))
                                                <h5><label
                                                        class="badge badge-success">{{ $collective_demandeur->statut }}</label>
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
            @if (isset($pcharge_demandeur->annee))
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-3">
                        <a class="nav-link" href="{{ route('courriers.index') }}" target="_blank">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (prise en charge)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($pcharge_demandeur->modules as $module)
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
@else
    @endhasrole
@endsection
