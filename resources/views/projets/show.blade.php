@extends('layout.default')
@section('title', 'ONFP - ' .$projet->sigle)
@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <div class="row justify-content-center pb-2">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-outline-success" href="{{ route('projets.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
            <div class="card border-success">
                <div class="card card-header text-center bg-gradient-default border-success">
                    <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">INFORMATIONS</span></h1>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Projet :</strong>
                                {{ $projet->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Localites :</strong>
                                @if (!empty($projetLocalites))
                                    @foreach ($projetLocalites as $v)
                                        <label class="badge badge-success">{{ $v->nom }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Zones :</strong>
                                @if (!empty($projetZones))
                                    @foreach ($projetZones as $v)
                                        <label class="badge badge-success">{{ $v->nom }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Modules :</strong>
                                @if (!empty($projetModules))
                                    @foreach ($projetModules as $v)
                                        <label class="badge badge-success">{{ $v->name }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
