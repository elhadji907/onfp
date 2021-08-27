@extends('layout.default')
@section('title', 'ONFP - Enregistrement utilisateur')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                        {{-- <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul> --}}
                    </div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('pcharges.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-header card-header-primary text-center border-success">
                        <h3 class="card-title">Enregistrement utilisateur</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'pcharges.store', 'method' => 'POST']) !!}
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('civilite') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'civilite']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('civilite'))
                                        @foreach ($errors->get('civilite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Prénom') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('firstname', null, ['placeholder' => 'Votre prénom', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('firstname'))
                                        @foreach ($errors->get('firstname') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Nom') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('name', null, ['placeholder' => 'Votre nom', 'class' => 'form-control', 'id' => 'nom']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('CIN') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('cin', null, ['placeholder' => 'Votre numéro de cin', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('cin'))
                                        @foreach ($errors->get('cin') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Date naissance') !!}(<span class="text-danger">*</span>)
                                {!! Form::date(
    'date',
    auth()->user()->date_naissance->format('Y-m-d'),
    ['placeholder' => 'Votre date de naissance', 'class' => 'form-control'],
) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('date'))
                                        @foreach ($errors->get('date') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Lieu naissance') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('lieu_naissance', null, ['placeholder' => 'Votre lieu de naissance', 'class' => 'form-control', 'id' => 'lieu_naissance']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('lieu_naissance'))
                                        @foreach ($errors->get('lieu_naissance') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Email') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('email', null, ['placeholder' => 'Numero de email', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                {!! Form::label('Adresse résidence') !!}(<span class="text-danger">*</span>)
                                {!! Form::textarea('adresse', null, ['placeholder' => 'Votre adresse de résidence', 'class' => 'form-control', 'id' => 'adresse', 'rows' => '1']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('adresse'))
                                        @foreach ($errors->get('adresse') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Telephone portable') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('telephone', null, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('telephone'))
                                        @foreach ($errors->get('telephone') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Telephone secondaire') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('fixe', null, ['placeholder' => 'Numero de secondaire', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('fixe'))
                                        @foreach ($errors->get('fixe') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Boite postale (BP)') !!}
                                {!! Form::text('bp', null, ['placeholder' => 'Numero de bp', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('bp'))
                                        @foreach ($errors->get('bp') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Etablissement') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('etablissement', $etablissements, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'etablissement']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('etablissement'))
                                        @foreach ($errors->get('etablissement') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Filière') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('module', $modules, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'module']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('module'))
                                        @foreach ($errors->get('module') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Ajouter filère') !!}
                                {!! Form::text('autre_filiere', null, ['placeholder' => 'ma filière de formation', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('autre_filiere'))
                                        @foreach ($errors->get('autre_filiere') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::hidden('username', null, ['placeholder' => 'Votre username', 'class' => 'form-control', 'id' => 'username']) !!}
                            <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Mot de passe">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
