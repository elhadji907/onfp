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

        table {
            border-left: 1px solid rgb(0, 0, 0);
            border-right: 0;
            border-top: 1px solid rgb(0, 0, 0);
            border-bottom: 0;
            width: 100%;
            border-spacing: -1px;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 1px solid rgb(0, 0, 0);
            border-top: 0;
            border-bottom: 1px solid rgb(0, 0, 0);
            text-align: center;
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
                <div style="position: fixed;
                top: -10px;
                left: 0px;
                right: 0px;
                height: 50px;
                background-color: #ffffff;
                color: white;
                text-align: center;
                line-height: 35px;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo1.png'))) }}"
                        style="width: 100%; height: auto;">
                </div>
                <b>
                    <center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p>Entre les soussign??s<br></p>
                    </center>
                    <center>
                        <p>Office National de Formation Professionnelle (O.N.F.P.)
                            Cit?? SIPRES 1, Lot 2, 2 voies Libert?? 6 extension VDN - BP 21013 ??? Dakar Ponty<br>
                            Et
                        </p>
                        <p>{{ $pcharge->etablissement->name }}
                            @if (isset($pcharge->etablissement->sigle))
                                ({{ $pcharge->etablissement->sigle }})
                            @else
                            @endif <br>
                            <strong>Contact</strong> : {{ $pcharge->etablissement->fixe }}&nbsp; /
                            &nbsp;{{ $pcharge->etablissement->telephone1 }}<br>
                            <strong>Email</strong> : <span style="color: blue">
                                {{ $pcharge->etablissement->email }}</span>
                        </p>
                    </center>
                </b>
                <p>Il a ??t?? convenu et arr??t?? ce qui suit :</p>
                <h6><b>Article 1 : Objet du contrat </b></h6>
                {{-- <p>Pour l???ann??e acad??mique <b>{{ $pcharge->scolarite->annee }}</b>, l???Office National de Formation
                    Professionnelle (ONFP) confie ??
                    l???Op??rateur, qui accepte, la formation d???un(e) ??tudiant(e), conform??ment aux indications du tableau
                    suivant :</p> --}}
                <div>

                    {{-- <table class="table table-bordered" method="POST" cellpadding="0" cellspacing="0">
                        <tr class="heading">
                            <td>
                                Pr??nom & Nom
                            </td>
                            <td>
                                Niveau
                            </td>

                        </tr>

                        <tr class="item">
                            <td>
                                {{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="heading">
                            <td>
                                {{ __('Sp??cialit??') }}
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr class="details">
                            <td>
                                {{ $pcharge->filiere->name }}
                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr class="heading">
                            <td>Montant</td>
                            <td>Prix</td>
                        </tr>
                        <tr class="item">
                            <td>{{ __('Montant global') }}</td>

                            <td>{!! number_format($pcharge->montant, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>

                        <tr class="total">
                            <td></td>

                            <td>Total: {!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>

                    </table> --}}

                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Pr??noms et Nom</th>
                                <th scope="col">Sp??cialit??</th>
                                <th scope="col">Niveau</th>
                                <th scope="col">Montant (CFA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}
                                </td>
                                <td>{{ $pcharge->filiere->name }}</td>
                                <td>{{ $pcharge->niveau }}</td>
                                <td>{!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h6><b>Article 2 : Engagement des parties</b></h6>
                <h6><b>A : Engagement de l???ONFP</b></h6>
                <p>L???ONFP s???engage :</p>
                <ul>
                    <li> A prendre en charge les frais de scolarit?? annuels (except?? les frais d???inscription), selon les
                        modalit??s pr??vues ?? article 3;</li>
                    <li>A r??aliser des visites ponctuelles au niveau de l?????tablissement pour le suivi de la formation
                    </li>
                </ul>
                <h6><b>B : Engagement de l???Etablissement</b></h6>
                <p>L???Etablissement s???engage ??:</p>
                <ul>
                    <li>Assurer ?? l???apprenant une formation, correspondant ?? la sp??cialit?? et au niveau indiqu?? dans le
                        contrat;</li>
                    <li>Veuillez au respect de l???assiduit?? de l???apprenant /??tudiant ;</li>
                    <li>Mettre ?? la disposition de l???ONFP les relev??s de notes de l???apprenant/??tudiant ainsi que les
                        factures et rapport d???ex??cution</li>
                    <li>Signaler tout manquement de la part de l?????tudiant notamment assiduit??, r??sultat scolaire,
                        discipline.</li>
                    <li>Faciliter ?? tout moment les visites de contr??le au sein de l?????tablissement </li>
                </ul>
                <h6>Article 3 : Modalit??s de paiement:</h6>
                <p>Le r??glement s???effectue selon les modalit??s ci-apr??s :</p>
                <ul>
                    <li>50% d??s signature du pr??sent contrat par les deux parties, sur pr??sentation d???une facture
                        d???acompte par l???Op??rateur ; </li>
                    <li>50% ?? la fin de la formation, apr??s pr??sentation par l???op??rateur d???un rapport d???ex??cution et de
                        la facture reliquat.</li>
                </ul>
                <h6>Article 4 : Modification</h6>
                <p>Toute modification de la pr??sente convention fera l???objet d???un avenant ??crit et d??ment sign?? par les
                    deux parties.</p>
                <h6>Article 5: R??siliation </h6>
                <p>La pr??sente convention peut ??tre r??sili??e, sans indemnit??s, ?? tout moment par l???une des parties en
                    cas de manquement grave des obligations mises ?? la charge de l???autre, ou encore en cas d???arr??t
                    d??finitif de l???apprenant en cours de formation pour un quelconque motif. Le contrat ne sera pas
                    renouvel?? en cas d???insuffisance de r??sultat du b??n??ficiaire.</p>
                <h6>Article 6: r??glement des Litiges : </h6>
                <p>Le pr??sent contrat est soumis au droit en vigueur au S??n??gal.</p>
                <p>Les parties conviennent de tout mettre en ??uvre pour trouver un r??glement amiable aux diff??rends qui
                    pourraient na??tre de l???ex??cution ou de l???interpr??tation des pr??sentes.</p>
                <center>
                    <p>Fait ?? Dakar en deux exemplaires originaux, le???????????????????????????</p>
                </center>
                {{-- <table class="table" style="border: hidden">
                    <tbody>
                        <tr>
                            <td><b>{{ __('Pour l???Op??rateur,') }} <br>
                                    Le Directeur
                                </b></td>
                            <td class="float-right" style="border: hidden"><b>{{ __('Pour l???ONFP') }} <br> Le
                                    Directeur G??n??ral</b></td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>
            <div style="position: fixed; 
            bottom: -10px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            background-color: white;
            color: white;
            text-align: center;
            line-height: 35px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pied.png'))) }}"
                    style="width: 100%; height: auto;">
            </div>
        </div>
    @endforeach
</body>

</html>
