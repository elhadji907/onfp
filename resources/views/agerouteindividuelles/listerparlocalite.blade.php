@extends('layout.default')
@section('title', 'AGEROUTE - demandeurs du département de ' . $localite)
@section('content')
    <div class="container-fluid">
       {{--   <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-80 py-2">
                    <a class="nav-link" href="#">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('FEMMES') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      
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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-80 py-2">
                    <a class="nav-link"
                        href="#"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        {{ __('HANDICAPÉS') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      
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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-80 py-2">
                    <a class="nav-link"
                        href="#"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        {{ __('DÉPLACÉS DE GUERRE') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      
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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-80 py-2">
                    <a class="nav-link"
                        href="#"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        {{ __('EMMIGRATION') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    
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
        </div>  --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Agéroute - Liste des demandeurs du département de {{ $localite }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <div align="right">
                                    <a href="{{ route('agerouteindividuelles.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                </div>
                                <table class="table table-bordered" id="table-ageroutebeneficiaires">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width:10%;">N° CIN</th>
                                            <th style="width:5%;">Sexe</th>
                                            <th style="width:8%;">Prenom</th>
                                            <th style="width:5%;">Nom</th>
                                            <th style="width:8%;">Date nais.</th>
                                            <th style="width:8%;">Lieu nais.</th>
                                            <th style="width:8%;">Communes</th>
                                            <th style="width:20%;">Module</th>
                                            <th style="width:5%;">Handicap</th>
                                            <th style="width:5%;">Déplacés</th>
                                            <th style="width:9%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @if ($localite == 'Bounkiling')
                                            @foreach ($projet->individuelles as $key => $individuelle)
                                                @foreach ($individuelle->localites as $key => $localite)
                                                    @if (isset($localite->nom) && $localite->nom == 'Bounkiling')
                                                        <tr>
                                                            <td>{!! $individuelle->cin !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->sexe !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->firstname !!} </td>
                                                            <td>{!! $individuelle->demandeur->user->name !!} </td>
                                                            <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                                            <td>
                                                                @foreach ($individuelle->zones as $key => $zone)
                                                                    {!! $zone->nom ?? '' !!}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <?php $h = 1; ?>
                                                                @foreach ($individuelle->modules as $key => $module)
                                                                    @if (isset($module->name))
                                                                        <a class="nav-link"
                                                                            href="{{ url('listerparmodulelocalite', ['$projet' => $projet,'$localite' => 'Bounkiling','$module' => $module->id]) }}"
                                                                            target="_blank">
                                                                            {!! $module->name ?? '' !!}<br />
                                                                        </a>
                                                                    @else
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>{!! $individuelle->handicap !!}</td>
                                                            <td>{!! $individuelle->victime_social !!}</td>
                                                            <td class="d-flex align-items-baseline">
                                                                <a href="{!! url('agerouteindividuelles/' . $individuelle->id . '/edit') !!}"
                                                                    class='btn btn-success btn-sm' title="modifier">
                                                                    <i class="far fa-edit">&nbsp;</i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="{{ url('agerouteindividuelles', ['$id' => $individuelle->id]) }}"
                                                                    class='btn btn-primary btn-sm' title="voir"
                                                                    target="_blank">
                                                                    <i class="far fa-eye">&nbsp;</i>
                                                                </a>
                                                                &nbsp;
                                                                @can('role-delete')
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'agerouteindividuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                                    {!! Form::close() !!}
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @elseif ($localite == 'Ziguinchor')
                                            @foreach ($projet->individuelles as $key => $individuelle)
                                                @foreach ($individuelle->localites as $key => $localite)
                                                    @if (isset($localite->nom) && $localite->nom == 'Ziguinchor')
                                                        <tr>
                                                            <td>{!! $individuelle->cin !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->sexe !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->firstname !!} </td>
                                                            <td>{!! $individuelle->demandeur->user->name !!} </td>
                                                            <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                                            <td>
                                                                @foreach ($individuelle->zones as $key => $zone)
                                                                    {!! $zone->nom ?? '' !!}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <?php $h = 1; ?>
                                                                @foreach ($individuelle->modules as $key => $module)
                                                                    @if (isset($module->name))
                                                                        <a class="nav-link"
                                                                            href="{{ url('listerparmodulelocalite', ['$projet' => $projet,'$localite' => 'Ziguinchor','$module' => $module->id]) }}"
                                                                            target="_blank">
                                                                            {!! $module->name ?? '' !!}<br />
                                                                        </a>
                                                                    @else
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>{!! $individuelle->handicap !!}</td>
                                                            <td>{!! $individuelle->victime_social !!}</td>
                                                            <td class="d-flex align-items-baseline">
                                                                <a href="{!! url('agerouteindividuelles/' . $individuelle->id . '/edit') !!}"
                                                                    class='btn btn-success btn-sm' title="modifier">
                                                                    <i class="far fa-edit">&nbsp;</i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="{{ url('agerouteindividuelles', ['$id' => $individuelle->id]) }}"
                                                                    class='btn btn-primary btn-sm' title="voir"
                                                                    target="_blank">
                                                                    <i class="far fa-eye">&nbsp;</i>
                                                                </a>
                                                                &nbsp;
                                                                @can('role-delete')
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'agerouteindividuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                                    {!! Form::close() !!}
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @elseif ($localite == 'Bignona')
                                            @foreach ($projet->individuelles as $key => $individuelle)
                                                @foreach ($individuelle->localites as $key => $localite)
                                                    @if (isset($localite->nom) && $localite->nom == 'Bignona')
                                                        <tr>
                                                            <td>{!! $individuelle->cin !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->sexe !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->firstname !!} </td>
                                                            <td>{!! $individuelle->demandeur->user->name !!} </td>
                                                            <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                            <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                                            <td>
                                                                @foreach ($individuelle->zones as $key => $zone)
                                                                    {!! $zone->nom ?? '' !!}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <?php $h = 1; ?>
                                                                @foreach ($individuelle->modules as $key => $module)
                                                                    @if (isset($module->name))
                                                                        <a class="nav-link"
                                                                            href="{{ url('listerparmodulelocalite', ['$projet' => $projet, '$localite' => 'Bignona', '$module' => $module->id]) }}"
                                                                            target="_blank">
                                                                            {!! $module->name ?? '' !!}<br />
                                                                        </a>
                                                                    @else
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>{!! $individuelle->handicap !!}</td>
                                                            <td>{!! $individuelle->victime_social !!}</td>
                                                            <td class="d-flex align-items-baseline">
                                                                <a href="{!! url('agerouteindividuelles/' . $individuelle->id . '/edit') !!}"
                                                                    class='btn btn-success btn-sm' title="modifier">
                                                                    <i class="far fa-edit">&nbsp;</i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="{{ url('agerouteindividuelles', ['$id' => $individuelle->id]) }}"
                                                                    class='btn btn-primary btn-sm' title="voir"
                                                                    target="_blank">
                                                                    <i class="far fa-eye">&nbsp;</i>
                                                                </a>
                                                                &nbsp;
                                                                @can('role-delete')
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'agerouteindividuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                                    {!! Form::close() !!}
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-ageroutebeneficiaires').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        orientation: 'landscape',
                        pageSize: 'RA4',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        titleAttr: 'Print'
                    }
                ],
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Tout"]
                ],
                "order": [
                    [0, 'desc']
                ],
                language: {
                    "sProcessing": "Traitement en cours...",
                    "sSearch": "Rechercher&nbsp;:",
                    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix": "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Pr&eacute;c&eacute;dent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                    },
                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    },
                    "select": {
                        "rows": {
                            _: "%d lignes séléctionnées",
                            0: "Aucune ligne séléctionnée",
                            1: "1 ligne séléctionnée"
                        }
                    }
                }
            });
        });
    </script>
@endpush
