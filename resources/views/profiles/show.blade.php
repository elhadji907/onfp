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
    @hasrole('user')
    {{-- <div class="container-fluid col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="row justify-content-center mt-5">
            @if (isset($individuelle_user->cin))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('individuelles/' . $individuelle_user->id) !!}" target="_blank">
                            <div class="card-body">
                                <div class="row justify-content-center no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Individuelle)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
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
                                <div class="row justify-content-center no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Collective)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
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
            @if (isset($pcharge_user->scolarites_id))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('pcharges/' . $pcharge_user->id) !!}" target="_blank">
                            <div class="card-body">
                                <div class="row justify-content-center no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (prise en charge)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
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
    </div> --}}
@else
    {{-- <div class="container-fluid col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="row justify-content-center mt-5">
            @if (isset($individuelle_user->cin))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('individuelles/' . $individuelle_user->id) !!}">
                            <div class="card-body">
                                <div class="row justify-content-center no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Individuelle)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
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
                        <a class="nav-link" href="{!! url('collectives/' . $collective_user->id) !!}">
                            <div class="card-body">
                                <div class="row justify-content-center no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (Collective)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
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
            @if (isset($pcharge_user->scolarites_id))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a class="nav-link" href="{!! url('pcharges/' . $pcharge_user->id) !!}">
                            <div class="card-body">
                                <div class="row justify-content-center no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ 'Demande (prise en charge)' }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($pcharge_user->modules as $module)
                                                @if ($loop->last)
                                                    {!! $loop->count !!}
                                                @endif
                                            @endforeach
                                            <label class="badge badge-info">{{ $pcharge_user->filiere->name }}</label>
                                            @if (isset($pcharge_user->filiere->name))
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
    </div> --}}
    @endhasrole
    <div class="container-fluid col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                <div class="card border-success">
                    <div class="card-header border-success">
                        <i class="fas fa-table"></i>
                        Liste demandes individuelles
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @foreach (auth::user()->demandeur->individuelles as $individuelle)
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#individuelles">
                                    <i class="far fa-eye"></i>
                                </button>
                                @if (isset($individuelle->cin))
                                    <a href="{{ route('individuelles.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                @else
                                    <a href="{!! url('individuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm' title="modifier">
                                        <i class="fas fa-plus">Ajouter</i>
                                    </a>
                                @endif
                            </div>
                            <br />
                            @if (isset($individuelle->cin))
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                    id="table-individuelles">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width:15%;">N°</th>
                                            <th style="width:30%;">Module</th>
                                            <th>Région</th>
                                            <th>Statut</th>
                                            <th style="width:15%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach (auth::user()->demandeur->individuelles as $individuelle)
                                            <tr>
                                                <td>{{ $individuelle->demandeur->numero ?? '' }}</td>
                                                <td>
                                                    @foreach ($individuelle->modules as $module)
                                                        {!! $module->name ?? '' !!}
                                                    @endforeach
                                                </td>
                                                <td>{!! $individuelle->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                                <td>
                                                    <span>
                                                        @if (isset($individuelle->modules) && $individuelle->modules != '[]')
                                                            @foreach ($individuelle->modules as $module)
                                                                @if (isset($module->name))
                                                                    <h5>
                                                                        @if ($individuelle->statut != "Attente")                                                                            
                                                                        <label
                                                                        class="badge badge-success">{{ $individuelle->statut }}</label>
                                                                        @else                                                                            
                                                                        <label
                                                                        class="badge badge-warning">{{ $individuelle->statut }}</label>
                                                                        @endif
                                                                    </h5>
                                                                @else
                                                                    <h5><label class="badge badge-danger">Invalide</label>
                                                                    </h5>
                                                                @endif
                                                            @endforeach

                                                        @else
                                                            <h5><label class="badge badge-danger">Invalide</label></h5>

                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="d-flex align-items-baseline text-center-row">
                                                    <a href="{!! url('individuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                        title="modifier">
                                                        <i class="far fa-edit">&nbsp;</i>
                                                    </a>
                                                    &nbsp;                                                  
                                                <a href="{{ url('indetails', ['$id' => $individuelle->id]) }}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                    {{-- &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'individuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                {!! Form::close() !!} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else

                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card border-success">
                    <div class="card-header border-success">
                        <i class="fas fa-table"></i>
                        Liste demandes collectives
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @foreach (auth::user()->demandeur->collectives as $collective)
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                    data-target="#collectives">
                                    <i class="far fa-eye"></i>
                                </button>
                                @if (isset($collective->cin))
                                    <a href="{{ route('collectives.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                @else
                                    <a href="{!! url('collectives/' . $collective->id . '/edit') !!}" class='btn btn-success btn-sm' title="modifier">
                                        <i class="fas fa-plus">Ajouter</i>
                                    </a>
                                @endif
                            </div>
                            <br />
                            @if (isset($collective->name))
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                    id="table-collectives">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width:15%;">N°</th>
                                            <th style="width:30%;">Module</th>
                                            <th>Région</th>
                                            <th>Statut</th>
                                            <th style="width:15%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach (auth::user()->demandeur->collectives as $collective)
                                            <tr>
                                                <td>{{ $collective->demandeur->numero ?? '' }}</td>
                                                <td>
                                                    @foreach ($collective->modules as $module)
                                                        {!! $module->name ?? '' !!}
                                                    @endforeach
                                                </td>
                                                <td>{!! $collective->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                                <td>
                                                    <span>
                                                        @if (isset($collective->modules) && $collective->modules != '[]')
                                                            @foreach ($collective->modules as $module)
                                                                @if (isset($module->name))
                                                                    <h5>
                                                                        @if ($collective->statut != "Attente")                                                                            
                                                                        <label
                                                                        class="badge badge-success">{{ $collective->statut }}</label>
                                                                        @else                                                                            
                                                                        <label
                                                                        class="badge badge-warning">{{ $collective->statut }}</label>
                                                                        @endif
                                                                    </h5>
                                                                @else
                                                                    <h5><label class="badge badge-danger">Invalide</label>
                                                                    </h5>
                                                                @endif
                                                            @endforeach

                                                        @else
                                                            <h5><label class="badge badge-danger">Invalide</label></h5>

                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="d-flex align-items-baseline text-center-row">
                                                    <a href="{!! url('collectives/' . $collective->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                        title="modifier">
                                                        <i class="far fa-edit">&nbsp;</i>
                                                    </a>
                                                    &nbsp;
                                                    <a href="{{ url('coldetails', ['$id' => $collective->id]) }}"
                                                        class='btn btn-primary btn-sm' title="voir">
                                                        <i class="far fa-eye">&nbsp;</i>
                                                    </a>
                                                    {{-- &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'collectives/' . $collective->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                {!! Form::close() !!} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card border-success">
                    <div class="card-header border-success">
                        <i class="fas fa-table"></i>
                        Liste demandes prises en charges
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @foreach (auth::user()->demandeur->pcharges as $pcharge)
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                    data-target="#pcharges">
                                    <i class="far fa-eye"></i>
                                </button>
                                @if (isset($pcharge->scolarite->annee))
                                    <a href="{{ route('pcharges.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                @else
                                    <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" class='btn btn-success btn-sm' title="modifier">
                                        <i class="fas fa-plus">Ajouter</i>
                                    </a>
                                @endif
                            </div>
                            <br />
                            @if (isset($pcharge->scolarite->annee))
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                    id="table-pcharges">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width:7%;">N°</th>
                                            <th style="width:7%;">Scolarité</th>
                                            <th style="width:30%;">Etablissement</th>
                                            <th style="width:15%;">Filière</th>
                                            <th style="width:8%;">Région</th>
                                            <th style="width:7%;">Statut</th>
                                            <th style="width:7%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach (auth::user()->demandeur->pcharges as $pcharge)
                                            <tr>
                                                <td>{{ $pcharge->demandeur->numero ?? '' }}</td>
                                                <td>{{ $pcharge->scolarite->annee ?? '' }}</td>
                                                <td>{{ $pcharge->etablissement->name ?? '' }}</td>
                                                <td>{{ $pcharge->filiere->name ?? '' }}</td>
                                                <td>{!! $pcharge->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                                <td>
                                                    @if (isset($pcharge->filiere->name))
                                                        <h5>
                                                            @if ($pcharge->statut == "Attente")                                                                            
                                                            <label
                                                            class="badge badge-warning">{{ $pcharge->statut }}</label>
                                                            @else                                                                            
                                                            <label
                                                            class="badge badge-success">{{ $pcharge->statut }}</label>
                                                            @endif
                                                        </h5>
                                                    @else
                                                        <h5><label class="badge badge-danger">Invalide</label></h5>
                                                    @endif
                                                </td>
                                                <td class="d-flex align-items-baseline text-center-row">
                                                    <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                        title="modifier">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    &nbsp;
                                                    <a href="{{ url('pdetails', ['$id' => $pcharge->demandeur->id, '$pchareg' => $pcharge->id]) }}"
                                                        class='btn btn-primary btn-sm' title="voir">
                                                        <i class="far fa-eye"></i>
                                                        {{-- &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'pcharges/' . $pcharge->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                {!! Form::close() !!} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mt-3 d-flex align-items-baseline align-middle">
                    <a class="btn btn-outline-secondary btn-block" href="{!! url('operateurs/' . $pcharge_user->id . '/edit') !!}" target="_blank"><span
                            data-feather="book-open"></span>Devenir opérateur</a>
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#operateurs">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="modal fade" id="individuelles" tabindex="-1" role="dialog" aria-labelledby="individuellesTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="individuellesTitle">Informations concernant une demande individuelle
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="collectives" tabindex="-1" role="dialog" aria-labelledby="collectivesTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="collectivesTitle">Informations concernant une demande collective</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pcharges" tabindex="-1" role="dialog" aria-labelledby="pchargesTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pchargesTitle">Informations concernant les prises en charge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="operateurs" tabindex="-1" role="dialog" aria-labelledby="operateursTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="operateursTitle">Informations concernant les opérateurs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
