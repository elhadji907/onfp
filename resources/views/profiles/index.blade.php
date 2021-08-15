@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-4 text-center">
            </div>
            <div class="col-8">
                <div class="mt-3 d-flex">
                    <div class="mr-1"><b>{{ auth::user()->civilite }}</b></div>
                    <div class="mr-1"><b>{{ auth::user()->firstname }}</b></div>
                    <div class="mr-1"><b>{{ auth::user()->name }}</b></div>

                    @if (auth::user()->civilite == 'M.')
                        <div class="mr-1"><b>né le</b></div>
                    @endif
                    @if (auth::user()->civilite == 'Mme')
                        <div class="mr-1"><b>née le</b></div>
                    @endif
                    @if (auth::user()->date_naissance !== null)
                        <div class="mr-1"><b>{{ auth::user()->date_naissance->format('d M Y') }}</b></div>
                    @endif
                    @if (auth::user()->lieu_naissance !== null)
                        <div class="mr-1"><b>à</b></div>
                        <div class="mr-1"><b>{{ auth::user()->lieu_naissance }}</b></div>
                    @endif
                </div>

                <div class="mt-0">
                    <div class="mr-3"><b>{{ __("Nom d'utilisateur") }}:</b> {{ auth::user()->username }}</div>
                    <div class="mr-3"><b>Adresse e-mail:</b> {{ auth::user()->email }}</div>
                    <div class="mr-3"><b>Téléphone:</b> {{ auth::user()->telephone }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
