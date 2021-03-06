@extends('layout.default')
@section('title', 'ONFP - Liste des opérateurs')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Liste des opérateurs
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{!! url('operateurs/create') !!}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" id="operateurTable" width="100%"
                                cellspacing="0">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="12%">Numéro agrément</th>
                                        <th width="50%">Opérateur</th>
                                        <th width="10%">Sigle</th>
                                        <th width="5%">Modules</th>
                                        <th width="5%">Formations</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>Numéro agrément</th>
                                        <th>Opérateur</th>
                                        <th>Sigle</th>
                                        <th>Modules</th>
                                        <th>Formations</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($operateurs as $operateur)
                                        <tr>
                                            <td>{!! $operateur->numero_agrement !!}</td>
                                            <td>{!! $operateur->name !!}</td>
                                            <td>{!! $operateur->sigle !!}</td>
                                            <td align="center">
                                                @foreach ($operateur->modules as $key => $module)
                                                    @if ($loop->last)
                                                        <a class="nav-link badge badge-default" href="#"
                                                            target="_blank">{!! $loop->count !!}</a>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td align="center">
                                                @foreach ($operateur->formations as $key => $formation)
                                                    @if ($loop->last)
                                                        <a class="nav-link badge badge-default" href="#"
                                                            target="_blank">{!! $loop->count !!}</a>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="d-flex align-items-baseline align-content-center">
                                                {{-- @can('update', $operateur) --}}
                                                <a href="{!! url('operateurs/' . $operateur->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                {{-- @endcan --}}
                                                &nbsp; <a href="{!! url('operateurs/' . $operateur->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                {{-- @can('delete', $operateur) --}}
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'operateurs/' . $operateur->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                {!! Form::close() !!}
                                                {{-- @endcan --}}
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
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#operateurTable').DataTable({
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
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Tout"]
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
