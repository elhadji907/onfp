@extends('layout.default')
@section('title', 'ONFP - SELECTION DES CANDIDATS')
@section('content')
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
                        LISTE DES CANDIDATS ÉLIGIBLES
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
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
                                            <th style="width:5%;">Formations</th>
                                            <th style="width:9%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($individuelles as $key => $individuelle)
                                            @foreach ($individuelle->projets as $key => $projet)
                                            @endforeach
                                            @foreach ($individuelle->modules as $key => $module)
                                            @endforeach
                                            @if (isset($projet) && $projet->name == $projet_name)
                                                @if (isset($module) && $module->name == $module_name)
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
                                                            @foreach ($individuelle->formations as $key => $formation)
                                                                @if ($loop->last)
                                                                    <a class="nav-link badge badge-info"
                                                                        href="{{ url('individuelleformations', ['$individuelle' => $individuelle->id, '$formation' => $formation->id]) }}"
                                                                        target="_blank">{!! $loop->count !!}</a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td ALIGN="CENTER" class="d-flex align-items-baseline">
                                                            <a href="{{ url('formationcandidatsadd', ['$individuelle' => $individuelle->id, '$findividuelle' => $findividuelle->id]) }}"
                                                                title="ajouter" class="btn btn-outline-primary btn-sm mt-0">
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ url('formationcandidatsadd', ['$individuelle' => $individuelle->id, '$findividuelle' => $findividuelle->id]) }}"
                                                                title="retirer" class="btn btn-outline-danger btn-sm mt-0">
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
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
