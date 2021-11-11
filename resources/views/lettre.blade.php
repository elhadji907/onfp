<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Contrat</title>
    <style>
        .invoice-box {
            max-width: 1500px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @foreach ($pcharges as $pcharge)
        <div class="invoice-box">
            <div class="row justify-content-center pb-2">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div>
                <div>
                    <img style="max-width:100%;" src="{{ asset('images/logo2.png') }}">
                </div>
                <br>
                <br>
                <br>
                <br>
                <h6><b><u>Objet</u> </b>: Prise en charge de formation</h6><br>

                <p><b>Monsieur le Directeur,</b></p>
                <p>Pour l’année académique <b>{{ $pcharge->scolarite->annee }}</b>, l’Office national de Formation
                    professionnelle (ONFP) assure la prise en charge de la formation d’un(e) étudiant(e) admis dans
                    votre établissement, selon le tableau ci-après.:</p>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Prénoms et Nom</th>
                                <th scope="col">Spécialité</th>
                                <th scope="col">Niveau</th>
                                <th scope="col">Montant (CFA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}
                                </td>
                                <td>{{ $pcharge->filiere->name }}</td>
                                <td>{{ $pcharge->items1 }}</td>
                                <td>{!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    <center><b>TOTAL</b></center>
                                </th>
                                <td><b>{!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</b></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <br>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A cet effet, je vous transmets le contrat ci-joint que vous voudrez bien signer et
                    me retourner au
                    plus tard un mois après la date de réception.</p>
                <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Je vous prie de croire, Monsieur le Directeur, en l’assurance de ma considération
                    distinguée.</p><br><br>
                <h6><b><span class="font-italic"><u>P.J</u></span> : contrat<br><br>

                        A<br>
                        @if ($pcharge->etablissement->user->civilite == 'M.')
                            {{ __('Monsieur le Directeur') }}<br>
                        @elseif($pcharge->etablissement->user->civilite == 'Mme')
                            {{ __('Madame la Directrice') }}<br>
                        @else
                            {{ __('') }}<br>
                        @endif
                        {{ $pcharge->etablissement->name }}<br>
                        <u>Adresse</u> : {{ $pcharge->etablissement->adresse }}<br>
                        <u>Téléphone</u> : {{ $pcharge->etablissement->telephone1 }}<br>
                        <u>Email</u> : {{ $pcharge->etablissement->user->email }}<br><br><br>


                        {{ $pcharge->etablissement->commune->arrondissement->departement->region->nom }}
                    </b>
                </h6>
                <div style="margin-top:150px">
                    <img style="max-width:100%;" src="{{ asset('images/pied.png') }}">
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>
