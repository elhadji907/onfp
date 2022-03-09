@extends('layout.default')
@section('title', 'ONFP - AGEROUTE BENEFICIAIRES')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-80 py-2">
                    <a class="nav-link" href="{{ route('agerouteindividuelles.index') }}">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('TOTAL') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php $i = 0; ?>
                                        @foreach ($projet->individuelles as $key => $individuelle)
                                            @foreach ($individuelle->localites as $key => $localite)
                                                @if ($loop->last && isset($localite->nom))
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        {!! $i !!}
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
                        href="{{ url('listerparlocalite', ['$projet' => $projet, '$localite' => 'Ziguinchor']) }}"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        {{ __('ZIGUINCHOR') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php $i = 0; ?>
                                        @foreach ($projet->individuelles as $key => $individuelle)
                                            @foreach ($individuelle->localites as $key => $localite)
                                                @if ($loop->last && isset($localite->nom) && $localite->nom == 'Ziguinchor')
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        {!! $i !!}
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
                        href="{{ url('listerparlocalite', ['$projet' => $projet, '$localite' => 'Bignona']) }}"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        {{ __('BIGNONA') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php $i = 0; ?>
                                        @foreach ($projet->individuelles as $key => $individuelle)
                                            @foreach ($individuelle->localites as $key => $localite)
                                                @if ($loop->last && isset($localite->nom) && $localite->nom == 'Bignona')
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        {!! $i !!}
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
                        href="{{ url('listerparlocalite', ['$projet' => $projet, '$localite' => 'Bounkiling']) }}"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        {{ __('BOUNKILING') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php $i = 0; ?>
                                        @foreach ($projet->individuelles as $key => $individuelle)
                                            @foreach ($individuelle->localites as $key => $localite)
                                                @if ($loop->last && isset($localite->nom) && $localite->nom == 'Bounkiling')
                                                    <?php $i++; ?>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        {!! $i !!}
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
        </div>
    </div>
    <div class="container-fluid">
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
                        LISTE BENEFICIAIRES {{-- {!! $projet_name !!} --}}
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
                                            <th style="width:5%;">N°</th>
                                            <th style="width:10%;">N° CIN</th>
                                            <th style="width:10%;">Prenom</th>
                                            <th style="width:5%;">Nom</th>
                                            <th style="width:8%;">Date nais.</th>
                                            <th style="width:10%;">Lieu nais.</th>
                                            <th style="width:5%;">Téléphone</th>
                                            <th style="width:10%;">Départements</th>
                                            <th style="width:13%;">Communes</th>
                                            <th style="width:5%;">Module</th>
                                            <th style="width:9%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($projet->individuelles as $key => $individuelle)
                                            <tr>
                                                <td>{!! $individuelle->numero_dossier !!}</td>
                                                <td>{!! $individuelle->cin !!}</td>
                                                <td>{!! $individuelle->demandeur->user->firstname !!} </td>
                                                <td>{!! $individuelle->demandeur->user->name !!} </td>
                                                <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                                <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                                <td>
                                                    @foreach ($individuelle->localites as $key => $localite)
                                                        {!! $localite->nom ?? '' !!}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($individuelle->zones as $key => $zone)
                                                        {!! $zone->nom ?? '' !!}
                                                    @endforeach
                                                </td>
                                                <td ALIGN="CENTER">
                                                    <?php $h = 1; ?>
                                                    @foreach ($individuelle->modules as $key => $module)
                                                        @if ($loop->last)
                                                            <a class="nav-link badge badge-info"
                                                                href="{{ url('moduleindividuelle', ['$projet' => $projet, '$individuelle' => $individuelle]) }}"
                                                                target="_blank">{!! $loop->count !!}</a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td ALIGN="CENTER" class="d-flex align-items-baseline">
                                                    <a href="{!! url('agerouteindividuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                        title="modifier">
                                                        <i class="far fa-edit">&nbsp;</i>
                                                    </a>
                                                    &nbsp;
                                                    <a href="{{ url('agerouteindividuelles', ['$id' => $individuelle->id]) }}"
                                                        class='btn btn-primary btn-sm' title="voir" target="_blank">
                                                        <i class="far fa-eye">&nbsp;</i>
                                                    </a>
                                                    &nbsp;
                                                    {{--  @can('role-delete')  --}}
                                                        {!! Form::open(['method' => 'DELETE', 'url' => 'agerouteindividuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                        {!! Form::close() !!}
                                                    {{--  @endcan  --}}
                                                </td>
                                            </tr>
                                        @endforeach
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
                    [0, 'asc']
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
