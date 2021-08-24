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
                <div class="mt-0 d-flex">
                    @if (auth::user()->civilite == 'M.')
                        <div class="mr-1"><b>né le</b></div>
                    @endif
                    @if (auth::user()->civilite == 'Mme')
                        <div class="mr-1"><b>née le</b></div>
                    @endif
                    @if (auth::user()->date_naissance !== null)
                        <div class="mr-1">{{ auth::user()->date_naissance->format('d/m/Y') }}</div>
                    @endif
                    @if (auth::user()->lieu_naissance !== null)
                        <div class="mr-1">à</div>
                        <div class="mr-1">{{ auth::user()->lieu_naissance }}</div>
                    @endif
                </div>
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
                            <thead class=" bg-info text-dark">
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
                                                @if ($demandeur->modules == "[]")                                                                
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
    <div class="container-fluid">
        @unlessrole('Demandeur')
        <div class="list-group mt-5">
            @foreach ($courriers as $courrier)
                <div class="list-group-item">
                    <h4><a href="{!! route('courriers.show', $courrier->id) !!}">{!! $courrier->objet !!}</a></h4>
                    <p>{!! $courrier->message !!}</p>
                    <p><strong>Type de courrier : </strong> {!! $courrier->types_courrier->name !!}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {!! $courrier->created_at->format('d/m/Y à H:m') !!}</small>
                        <span class="badge badge-primary">{!! $courrier->user->firstname !!}&nbsp;{!! $courrier->user->name !!}</span>
                    </div>
                </div>
            @endforeach
            {{--  <div class="d-flex justify-content-center pt-2">
                {!! $courriers->links() !!}
            </div>  --}}
        </div>
        @else
        @endunlessrole
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @hasrole('Demandeur')
        @if (isset($user_connect))
            <div class="row mt-5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12">
                    @if (isset($demandeurs))
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Mon dossier
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table border="1" height="100" class="table table-bordered table-striped" width="100%"
                                        cellspacing="0" id="table-demandeurs">
                                        <thead class="table-dark">
                                            <tr>
                                                <th width="120px">N°</th>
                                                <th width="100px">CIN</th>
                                                <th>Prenom</th>
                                                <th>Nom</th>
                                                <th>Date nais.</th>
                                                <th>Lieu nais.</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th width="20px">Module</th>
                                                <th width="130px">Type demande</th>
                                                <th>Statut</th>
                                                <th width="130px"></th>
                                            </tr>
                                        </thead>
                                        <tfoot>

                                        </tfoot>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($demandeurs as $demandeur)
                                                @can('view', $demandeur)
                                                    <tr valign="bottom">
                                                        <td>{!! $demandeur->numero !!}</td>
                                                        <td>{!! $demandeur->cin !!}</td>
                                                        <td>{!! $demandeur->user->firstname !!}</td>
                                                        <td>{!! $demandeur->user->name !!}</td>
                                                        <td>{!! $demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                        <td>{!! $demandeur->user->lieu_naissance !!}</td>
                                                        <td>{!! $demandeur->user->email !!}</td>
                                                        <td>{!! $demandeur->user->telephone !!}</td>
                                                        <td ALIGN="CENTER">
                                                            @foreach ($demandeur->modules as $module)
                                                                @if ($loop->last)
                                                                    {!! $loop->count !!}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{!! $demandeur->types_demande->name ?? ' ' !!}</td>
                                                        <td style="text-align: center;">
                                                            @if ($demandeur->modules == "[]")                                                                
                                                                <label class="badge badge-danger">Invalide</label>
                                                            @else
                                                            <label class="badge badge-success">{{ $demandeur->statut }} </label>          
                                                        @endif
                                                        </td>
                                                        <td class="d-flex align-items-baseline align-content-center">
                                                            <a href="{!! url('demandeurs/' . $demandeur->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                                title="modifier">
                                                                <i class="far fa-edit">&nbsp;</i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{!! url('demandeurs/' . $demandeur->id) !!}" class='btn btn-primary btn-sm'
                                                                title="voir">
                                                                <i class="far fa-eye">&nbsp;</i>
                                                            </a>
                                                            &nbsp;
                                                            {!! Form::open(['method' => 'DELETE', 'url' => 'demandeurs/' . $demandeur->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endcan
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @else
                        <div lass="d-flex justify-content-between align-items-center">
                            <small>
                                <a href="{{ route('demandeurs.create') }}">
                                    <div class="btn btn-primary mt-3"><i class="fas fa-plus"></i>&nbsp;Cliquez ici pour
                                        compléter votre demande de formation demandeur</i></div>
                                </a>
                            </small>
                            <small>
                                <a href="{{ route('operateurs.create') }}">
                                    <div class="btn btn-info mt-3"><i class="fas fa-plus"></i>&nbsp;Devenir opérateur</i>
                                    </div>
                                </a>
                            </small>
                            <small>
                                <a href="{{ route('collectives.create') }}">
                                    <div class="btn btn-success mt-3"><i class="fas fa-plus"></i>&nbsp;Cliquez ici pour
                                        compléter votre demande de formation colective</i></div>
                                </a>
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        @else
        @endif
    @else
        @endhasrole
    </div>
@endsection
