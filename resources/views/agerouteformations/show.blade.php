@extends('layout.default')
@section('title', 'ONFP - Formation individuelle')
@section('content')

    <style>
        .invoice-box {
            max-width: 1500px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: left;
        }

        .invoice-box table tr td:nth-child(6) {
            text-align: center;
        }

        .invoice-box table tr td:nth-child(10) {
            text-align: center;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: rgb(224, 224, 224);
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
    <?php $i = 1; ?>
    <div class="invoice-box justify-content-center">
        <div class="card card border-success">
            <div class="card-header  text-center bg-gradient-default border-success">
                <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><span
                        class="font-italic">Formation individuelle</span></h1>
            </div>
            <div class="card-body">
                <table method="POST" cellpadding="0" cellspacing="0">
                    <tr class="information">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr class="heading">
                                <td colspan="1" class="pt-3">CODE</td>
                                <td colspan="1" class="pt-3">N° convention</td>
                                <td colspan="1" class="pt-3">Commission</td>
                            </tr>
                            <tr class="details">
                                <td colspan="1" class="pt-3">{!! $findividuelle->code ?? '' !!}</td>
                                <td colspan="1" class="pt-3">
                                    {{ $findividuelle->formation->convention->numero ?? '' }}</td>
                                <td colspan="1" class="pt-3">
                                    {{ $findividuelle->formation->choixoperateur->trimestre ?? '' }}</td>
                            </tr>
                            <tr class="heading">
                                <td colspan="2" class="pt-3">Module</td>
                                <td colspan="2" class="pt-3">Bénéficiaires</td>
                            </tr>
                            <tr class="details">
                                <td colspan="2" class="pt-3">{!! $findividuelle->module->name ?? '' !!}</td>
                                <td colspan="2" class="pt-3">{{ $findividuelle->formation->beneficiaires ?? '' }}</td>
                            </tr>
                            <tr class="heading">
                                <td colspan="3" class="pt-3">Opérateur</td>
                            </tr>
                            <tr class="details">
                                <td colspan="3" class="pt-3">{!! $findividuelle->formation->operateur->name ?? '' !!} ({{ $findividuelle->formation->operateur->sigle ?? '' }})</td>
                            </tr>
                            <tr class="heading">
                                <td colspan="2" class="pt-3">Département</td>
                                <td colspan="2" class="pt-3">Adresse</td>
                            </tr>
                            <tr class="details">
                                <td colspan="2" class="pt-3">{!! $findividuelle->formation->localite->nom ?? '' !!}</td>
                                <td colspan="2" class="pt-3">{{ $findividuelle->formation->adresse ?? '' }}</td>
                            </tr>
                            @if (isset($findividuelle->projet->name) && $findividuelle->projet->name != 'Aucun')
                                <tr class="heading">
                                    <td colspan="3" class="pt-3">Projet</td>
                                </tr>
                                <tr class="details">
                                    <td colspan="3" class="pt-3">{!! strtolower($findividuelle->projet->name) ?? '' !!} ({{ $findividuelle->projet->sigle ?? '' }})</td>
                                </tr>
                            @endif
                            @if (isset($findividuelle->programme->name) && $findividuelle->programme->name != 'Aucun')
                                <tr class="heading">
                                    <td colspan="3" class="pt-3">Programme</td>
                                </tr>
                                <tr class="details">
                                    <td colspan="3" class="pt-3">{!! strtolower($findividuelle->programme->name) ?? '' !!} ({{ $findividuelle->programme->sigle ?? '' }})</td>
                                </tr>
                            @endif
                        </table>
                    </tr>
                    <table class="table table-bordered" width="100%" cellspacing="0" id="table-individuelles">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div align="right" class="pb-3">
                            <a href="{{ url('formationcandidats', ['$module' => $findividuelle->module->id,'$projet' => $findividuelle->projet->id,'$programme' => $findividuelle->programme->id, '$findividuelle' => $findividuelle->id]) }}"
                                target="_blank">
                                <div class="btn btn-outline-success  btn-md" title="ajouter candidat">
                                    <i class="fas fa-plus"></i></i>
                                </div>
                            </a>
                        </div>
                        <thead class="heading">
                            <tr>
                                <th width="2%">N°</th>
                                <th width="8%">CIN</th>
                                <th width="5%">Civilité</th>
                                <th width="10%">Prénom</th>
                                <th width="10%">Nom</th>
                                <th width="12%">Date naissance</th>
                                <th width="12%">Lieu naissance</th>
                                <th width="10%">Email</th>
                                <th width="10%">Téléphone</th>
                                <th width="1%"></th>
                            </tr>
                        </thead>
                        <tbody class="details">
                            <?php $i = 1; ?>
                            @foreach ($formation->individuelles as $individuelle)
                                @if (isset($individuelle) && $individuelle->module->name == $findividuelle->module->name && strtolower($individuelle->localite->nom) == strtolower($findividuelle->formation->localite->nom) && strtolower($individuelle->projet->name) == strtolower($findividuelle->projet->name))
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $individuelle->demandeur->cin }}</td>
                                        <td>{{ $individuelle->demandeur->user->civilite }}</td>
                                        <td>{{ $individuelle->demandeur->user->firstname }}</td>
                                        <td>{{ $individuelle->demandeur->user->name }}</td>
                                        <td>{{ $individuelle->demandeur->user->date_naissance->format('d/m/Y') }}</td>
                                        <td>{{ $individuelle->demandeur->user->lieu_naissance }}</td>
                                        <td>{{ $individuelle->demandeur->user->email }}</td>
                                        <td>{{ $individuelle->demandeur->user->telephone }}</td>
                                        <td>
                                            <a href="{{ url('formationcandidatsdelete', ['$individuelle' => $individuelle->id,'$findividuelle' => $findividuelle->id]) }}"
                                                title="retirer" class="btn btn-outline-warning btn-sm mt-0">
                                                <i class="fa fa-share" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-individuelles').DataTable({
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
