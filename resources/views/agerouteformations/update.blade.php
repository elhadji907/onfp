@extends('layout.default')
@section('title', 'ONFP - Enregistrement formation individuelle')
@section('content')
    <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
        <div class="container-fluid">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            <div class="row justify-content-center pb-2">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-outline-success" href="{{ route('agerouteformations.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
            <div class="card border-success">
                <div class="card card-header text-center bg-gradient-default border-success">
                    <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">FORMULAIRE DE MODIFICATION DE FORMATION DU CODE : </span>
                        <span style="color: red"> {{ $findividuelle->formation->code }} </span>
                    </h1>
                </div>
                <div class="card-body">
                    <div>
                        <p>
                            <b><u>Opérateur choisi </u>: </b>
                            {{ $findividuelle->formation->operateur->name ?? 'Non disponible' }}<br />
                            <b><u>N° agrément </u> </b>
                            {{ $findividuelle->formation->operateur->numero_agrement ?? 'Aucun numéro' }}
                        </p>
                    </div>
                    {!! Form::open(['url' => 'agerouteformations/' . $findividuelle->id, 'method' => 'PATCH', 'files' => true]) !!}
                    @csrf
                    <div class="form-row">
                        {{-- <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="code">{{ __('CODE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    placeholder="Code formation" value="{{ old('code') }}"
                                    autocomplete="code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div> --}}
                        {{-- <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('Type de formation:') !!}(<span class="text-danger">*</span>) --}}
                        {!! Form::hidden('types_formations', $types_formations, null, ['placeholder' => 'types_formations', 'class' => 'form-control', 'id' => 'types_formations', 'data-width' => '100%']) !!}
                        {!! Form::hidden('code', $findividuelle->formation->code, ['placeholder' => 'types_formations', 'class' => 'form-control', 'id' => 'types_formations', 'data-width' => '100%']) !!}
                        {{-- <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('types_formations'))
                                        @foreach ($errors->get('types_formations') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small> 
                            </div> --}}
                        <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            {!! Form::label('module :') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('modules', $modules, $findividuelle->module->name, ['placeholder' => 'module', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'moduleageroute']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('modules'))
                                    @foreach ($errors->get('modules') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            {!! Form::label('convention :') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('conventions', $conventions, $findividuelle->formation->convention->numero ?? '', ['placeholder' => 'convention', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'convention']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('conventions'))
                                    @foreach ($errors->get('conventions') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            <label for="beneficiaire">{{ __('Bénéficiaires') }}(<span
                                    class="text-danger">*</span>)</label>
                            <textarea class="form-control  @error('beneficiaire') is-invalid @enderror" name="beneficiaire" id="beneficiaire"
                                rows="1"
                                placeholder="Ex : Jeune de la région de dakar">{{ $findividuelle->formation->beneficiaires ?? old('beneficiaire') }}</textarea>
                            @error('beneficiaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Programme :') !!}
                                {!! Form::select('programme', $programmes, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'programme', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('programme'))
                                        @foreach ($errors->get('programme') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            <label for="adresse">{{ __('Localisation') }}(<span class="text-danger">*</span>)</label>
                            <textarea class="form-control  @error('adresse') is-invalid @enderror" name="adresse" id="adresse" rows="1"
                                placeholder="Votre adresse complète">{{ $findividuelle->formation->adresse ?? old('adresse') }}</textarea>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-16 col-xs-12 col-sm-12">
                            {!! Form::label('Localité:') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('localite', $localites, $findividuelle->formation->localite->nom ?? '', ['placeholder' => 'localite', 'class' => 'form-control', 'id' => 'localite', 'data-width' => '100%']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('localite'))
                                    @foreach ($errors->get('localite') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            {!! Form::label('Choix opérateur:') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('choixoperateur', $choixoperateur, $findividuelle->formation->choixoperateur->trimestre ?? '', ['placeholder' => 'choix operateur', 'class' => 'form-control', 'id' => 'choixoperateur', 'data-width' => '100%']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('choixoperateur'))
                                    @foreach ($errors->get('choixoperateur') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            {!! Form::label('Opérateur:') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('operateur', $operateurs, $findividuelle->formation->operateur->name ?? '', ['placeholder' => ' operateur', 'class' => 'form-control', 'id' => 'operateur', 'data-width' => '100%']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('operateur'))
                                    @foreach ($errors->get('operateur') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            {!! Form::label('Projet:') !!}
                            {!! Form::select('projet', $projets, $findividuelle->projet->name ?? '', ['placeholder' => 'projet', 'class' => 'form-control', 'id' => 'projet', 'data-width' => '100%']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('projet'))
                                    @foreach ($errors->get('projet') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            {!! Form::label('Programme:') !!}
                            {!! Form::select('programme', $programmes, $findividuelle->programme->name ?? '', ['placeholder' => 'programme', 'class' => 'form-control', 'id' => 'programme', 'data-width' => '100%']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('programme'))
                                    @foreach ($errors->get('programme') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        @if (isset($findividuelle->formation->date_debut))
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_debut">{{ __('Début') }}</label>
                                <input id="date_debut" {{ $errors->has('date_debut') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_debut') is-invalid @enderror" name="date_debut"
                                    placeholder="Votre date de debutance"
                                    value="{{ $findividuelle->formation->date_debut->format('Y-m-d') ?? old('date_debut') }}"
                                    autocomplete="username">
                                @error('date_debut')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        @else
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_debut">{{ __('Début') }}</label>
                                <input id="date_debut" {{ $errors->has('date_debut') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_debut') is-invalid @enderror" name="date_debut"
                                    placeholder="Votre date de debutance" value="{{ old('date_debut') }}"
                                    autocomplete="username">
                                @error('date_debut')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        @endif
                        @if (isset($findividuelle->formation->date_fin))
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_fin">{{ __('Fin') }}</label>
                                <input id="date_fin" {{ $errors->has('date_fin') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_fin') is-invalid @enderror" name="date_fin"
                                    placeholder="Votre date de finance"
                                    value="{{ $findividuelle->formation->date_fin->format('Y-m-d') ?? old('date_fin') }}"
                                    autocomplete="username">
                                @error('date_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        @else
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_fin">{{ __('Fin') }}</label>
                                <input id="date_fin" {{ $errors->has('date_fin') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_fin') is-invalid @enderror" name="date_fin"
                                    placeholder="Votre date de finance" value="{{ old('date_fin') }}"
                                    autocomplete="username">
                                @error('date_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                            {!! Form::label('statut:') !!}
                            {!! Form::select('statut', $statuts, $findividuelle->formation->statut->name ?? '', ['placeholder' => 'statut', 'class' => 'form-control', 'id' => 'statut', 'data-width' => '100%']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('statut'))
                                    @foreach ($errors->get('statut') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-outline-primary"><i
                                class="far fa-paper-plane"></i>&nbsp;Modifier</button>
                        {{-- {!! Form::submit('Modifier', ['class' => 'btn btn-outline-primary pull-right']) !!} --}}
                    </div>
                    {!! Form::close() !!}
                    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                        saisies svp</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if ($errors->any())
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger mt-2">
                                                <strong>Oups!</strong> Il y a eu quelques problèmes avec vos
                                                entrées.
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @push('scripts')
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $("#error-modal").modal({
                                                        'show': true,
                                                    })
                                                });
                                            </script>
                                        @endpush
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
