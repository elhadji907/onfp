@extends('layout.default')
@section('title', 'ONFP - Liste des courriers arrivées')
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
                        Liste des courriers reçues
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{!! url('recues/create') !!}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" id="table-recus" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width:11%;">{{ __('DATE ARRIVEE') }} </th>
                                        <th style="width:11%;">{{ __('DATE CORRESP.') }}</th>
                                        <th style="width:8%;">{{ __('N° COR.') }}</th>
                                        <th style="width:15%;">EXPEDITEUR</th>
                                        <th>OBJET</th>
                                        <th style="width:2%;">SCAN</th>
                                        <th style="width:15%;">IMPUTATION</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($recues as $recue)
                                        <tr>
                                            <td>{!! optional($recue->courrier->date_recep)->format('d/m/Y') !!}</td>
                                            <td>{!! optional($recue->courrier->date_cores)->format('d/m/Y') !!}</td>
                                            <td>{!! $recue->numero !!}</td>
                                            <td>{!! $recue->courrier->expediteur !!}</td>
                                            <td>{!! $recue->courrier->objet !!}</td>
                                            <td>
                                                @if ($recue->courrier->file != '')
                                                    <a class="btn btn-outline-secondary btn-sm"
                                                        title="télécharger le fichier joint" target="_blank"
                                                        href="{{ asset($recue->courrier->getFile()) }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach ($recue->courrier->imputations as $imputation)
                                                    {{--  <span class="btn btn-default">{!! $imputation->sigle !!}</span>  --}}
                                                    <span>{!! $imputation->sigle !!},</span>
                                                @endforeach
                                            </td>
                                            <td class="d-flex align-items-baseline">
                                                @can('courrier-edit')
                                                    <a href="{!! url('recues/' . $recue->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                        title="modifier">
                                                        <i class="far fa-edit">&nbsp;</i>
                                                    </a>
                                                @endcan
                                                &nbsp; <a href="{!! url('courriers/' . $recue->courrier->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;@can('courrier-delete')
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'url' => 'recues/' . $recue->id,
                                                        'id' => 'deleteForm',
                                                        'onsubmit' => 'return ConfirmDelete()',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'supprimer',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
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
            $('#table-recus').DataTable({
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
                    [2, 'desc']
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
