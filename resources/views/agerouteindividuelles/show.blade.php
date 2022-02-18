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
            color: #555;
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
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
    <link href="//db.onlinewebfonts.com/c/dd79278a2e4c4a2090b763931f2ada53?family=ArialW02-Regular" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="invoice-box">
        <div>
            <div class="" style="position: fixed;
                top: -10px;
                left: 0px;
                right: 0px;
                height: 50px;
                background-color: #ffffff;
                color: white;
                text-align: center;
                line-height: 35px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/entete_onfp_ageroute.png'))) }}"
                    style="width: 100%; height: auto;">
            </div>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div align="right">
                <p><b><u>N° Dossier</u></b> : <span style="color: rgb(255, 0, 0); text-shadow: 2px 2px;"> {{ $individuelle->numero_dossier ?? '' }}</span><br></p>
            </div>
            <div align="center">
                <p><b><u>I. IDENTIFICATION DU CANDIDAT</u></b></p>
            </div>
            <p><b>{{ __("N° carte nationale d'identité") }}:</b> {{ $individuelle->cin ?? '' }}<br />
                <b>{{ __('Civilité, Prénom & Nom') }}:</b>
                {{ $individuelle->demandeur->user->civilite ?? '' }}&nbsp;{{ $individuelle->demandeur->user->firstname ?? '' }}&nbsp;{{ $individuelle->demandeur->user->name ?? '' }}
                <br />
                <b>{{ __('Date & lieu de naissance') }}:</b>
                {{ $individuelle->demandeur->user->date_naissance->format('d/m/Y') ?? '' }}&nbsp;à&nbsp;{{ $individuelle->demandeur->user->lieu_naissance ?? '' }}
            </p>
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
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pied_ageroute_onfp.png'))) }}"
                style="width: 100%; height: auto;">
        </div>
    </div>
</body>

</html>
