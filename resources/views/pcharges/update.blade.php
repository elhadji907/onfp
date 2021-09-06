@extends('layout.default')
@section('title', 'ONFP - Enregistrement utilisateur')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a class="btn btn-outline-primary" href="{{ route('pcharges.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    <a class="btn btn-outline-primary" href="{{ route('filieres.create') }}" target="_blank"> <i
                            class="fas fa-plus"></i>&nbsp;Ajouter filière</i></a>
                    {{-- <a class="btn btn-outline-primary" href="{{ route('specialites.create') }}" target="_blank"> <i
                            class="fas fa-plus"></i>&nbsp;Ajouter spécialité</i></a> --}}

                </div>
                <div class="card border-success">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pcharges.update', [$pcharge->id]) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH" />

                            {!! Form::hidden('nombre_de_piece', 3, ['placeholder' => 'Le nombre de pièces fournis', 'class' => 'form-control', 'min' => '3', 'max' => '20']) !!}

                            {!! Form::hidden('date_depot', $date_depot->format('Y-m-d'), ['placeholder' => 'La date de dépot', 'class' => 'form-control']) !!}

                            <div class="form-row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    {!! Form::label('Etablissement') !!}
                                    {!! Form::select('etablissement', $etablissements, $pcharge->etablissement->name, ['placeholder' => '', 'class' => 'form-control', 'id' => 'etablissements']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('etablissement'))
                                            @foreach ($errors->get('etablissement') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Scolarité') !!}
                                    {!! Form::select('scolarite', $scolarites, $pcharge->scolarite->annee, ['placeholder' => '', 'class' => 'form-control', 'id' => 'scolarite']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('scolarite'))
                                            @foreach ($errors->get('scolarite') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Type demande') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('typedemande', ['Nouvelle demande' => 'Nouvelle demande', 'Renouvellement' => 'Renouvellement'], $pcharge->statut, ['placeholder' => 'Type de demande', 'class' => 'form-control', 'id' => 'typedemande']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('typedemande'))
                                            @foreach ($errors->get('typedemande') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Filière') !!}
                                    {!! Form::select('filiere', $filieres, $pcharge->filiere->name, ['placeholder' => '', 'class' => 'form-control', 'id' => 'filiere']) !!}
                                    <small id="emailHelp" class="form-text text-muted">{{ __('Merci de ') }}
                                        <a href="{{ route('filieres.create') }}" target="_blank">cliquer ici</a>
                                        {{ __('pour ajouter une nouvelle filière') }}
                                    </small>
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('filiere'))
                                            @foreach ($errors->get('filiere') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Montant demandé') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('montant', $pcharge->montant, ['placeholder' => 'Montant demandé', 'class' => 'form-control', 'id' => 'montant']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('montant'))
                                            @foreach ($errors->get('montant') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Montant accordé') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('avis_dg', $pcharge->avis_dg, ['placeholder' => 'Montant accordé', 'class' => 'form-control', 'id' => 'avis_dg']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('avis_dg'))
                                            @foreach ($errors->get('avis_dg') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Spécialité') !!}
                                    {!! Form::text('specialite', $pcharge->specialisation, ['placeholder' => 'La spécialité de la filière choisie', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('specialite'))
                                            @foreach ($errors->get('specialite') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('CIN') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('cin', $pcharge->cin, ['placeholder' => 'Votre numéro de cin', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('cin'))
                                            @foreach ($errors->get('cin') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Prénom') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('firstname', $pcharge->demandeur->user->firstname, ['placeholder' => 'Votre prénom', 'class' => 'form-control']) !!}
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
                                    {!! Form::text('name', $pcharge->demandeur->user->name, ['placeholder' => 'Votre nom', 'class' => 'form-control', 'id' => 'nom']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('name'))
                                            @foreach ($errors->get('name') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Date naissance') !!}(<span class="text-danger">*</span>)
                                    {!! Form::date('date', $pcharge->demandeur->user->date_naissance->format('Y-m-d'), ['placeholder' => 'Votre date de naissance', 'class' => 'form-control']) !!}
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
                                    {!! Form::text('lieu_naissance', $pcharge->demandeur->user->lieu_naissance, ['placeholder' => 'Votre lieu de naissance', 'class' => 'form-control', 'id' => 'lieu_naissance']) !!}
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
                                    {!! Form::text('email', $pcharge->demandeur->user->email, ['placeholder' => 'Numero de email', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('email'))
                                            @foreach ($errors->get('email') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('civilite') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], $pcharge->demandeur->user->civilite, ['placeholder' => '', 'class' => 'form-control', 'id' => 'civilite']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('civilite'))
                                            @foreach ($errors->get('civilite') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Situation familiale :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('familiale', $familiale, $pcharge->demandeur->user->situation_familiale, ['placeholder' => 'Votre situation familiale', 'class' => 'form-control', 'id' => 'familiale', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('familiale'))
                                            @foreach ($errors->get('familiale') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Situation professionnelle:') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('professionnelle', $professionnelle, $pcharge->demandeur->user->situation_professionnelle, ['placeholder' => 'Dernier dipôme', 'class' => 'form-control', 'id' => 'professionnelle', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('professionnelle'))
                                            @foreach ($errors->get('professionnelle') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Telephone portable') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('telephone', $pcharge->demandeur->user->telephone, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('telephone'))
                                            @foreach ($errors->get('telephone') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    {!! Form::label('Adresse résidence') !!}(<span class="text-danger">*</span>)
                                    {!! Form::textarea('adresse', $pcharge->demandeur->user->adresse, ['placeholder' => 'Votre adresse de résidence', 'class' => 'form-control', 'id' => 'adresse', 'rows' => '1']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('adresse'))
                                            @foreach ($errors->get('adresse') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Commune résidence') !!}
                                    {!! Form::select('commune', $communes, $pcharge->commune->nom, ['placeholder' => '', 'class' => 'form-control', 'id' => 'commune']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('commune'))
                                            @foreach ($errors->get('commune') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Telephone secondaire') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('fixe', $pcharge->demandeur->user->fixe, ['placeholder' => 'Numero de secondaire', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('fixe'))
                                            @foreach ($errors->get('fixe') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Téléphone fax') !!}
                                    {!! Form::text('fax', $pcharge->demandeur->user->fax, ['placeholder' => 'Numero de fax', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('fax'))
                                            @foreach ($errors->get('fax') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Boite postale (BP)') !!}
                                    {!! Form::text('bp', $pcharge->demandeur->user->bp, ['placeholder' => 'Numero de bp', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('bp'))
                                            @foreach ($errors->get('bp') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Inscription') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('inscription', $pcharge->inscription, ['placeholder' => 'Montant inscription', 'class' => 'form-control', 'id' => 'inscription']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('inscription'))
                                            @foreach ($errors->get('inscription') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Montant') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('montant', $pcharge->montant, ['placeholder' => 'Montant annuelle de la formation', 'class' => 'form-control', 'id' => 'montant']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('montant'))
                                            @foreach ($errors->get('montant') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Durée') !!}(<span class="text-danger">*</span>)
                                    {!! Form::number('duree', $pcharge->duree, ['placeholder' => 'Durée de la formation', 'class' => 'form-control', 'id' => 'duree', 'min' => '1', 'max' => '3']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('duree'))
                                            @foreach ($errors->get('duree') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Niveau entrée') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('niveauentree', $pcharge->niveauentree, ['placeholder' => 'Niveau entrée de la formation', 'class' => 'form-control', 'id' => 'niveauentree']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('niveauentree'))
                                            @foreach ($errors->get('niveauentree') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    {!! Form::label('Niveau sortie') !!}(<span class="text-danger">*</span>)
                                    {!! Form::text('niveausortie', $pcharge->niveausortie, ['placeholder' => 'Niveau sortie de la formation', 'class' => 'form-control', 'id' => 'niveausortie']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('niveausortie'))
                                            @foreach ($errors->get('niveausortie') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <label
                                        for="motivation">{{ __('Quelles sont vos motivations pour cette formation ?') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control  @error('motivation') is-invalid @enderror"
                                        name="motivation" id="motivation" rows="3"
                                        placeholder="Décrire en quelques lignes votre motivation à faire cette formation">{{ $pcharge->demandeur->motivation ?? old('motivation') }}</textarea>
                                    @error('motivation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    {!! Form::label('Niveau :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('niveau_etude', ['Aucun' => 'Aucun', 'Elémentaire' => 'Elémentaire', 'Moyen' => 'Moyen', 'Secondaire' => 'Secondaire', 'Supérieur' => 'Supérieur'], $pcharge->niveau_etude, ['placeholder' => 'Niveau d\'étude', 'class' => 'form-control', 'id' => 'niveau_etude', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('niveau_etude'))
                                            @foreach ($errors->get('niveau_etude') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    {!! Form::label('Dernier diplôme :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('diplome', $diplomes, $pcharge->demandeur->diplome->name, ['placeholder' => 'Dernier dipôme', 'class' => 'form-control', 'id' => 'diplome', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('diplome'))
                                            @foreach ($errors->get('diplome') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                {!! Form::hidden('username', $pcharge->demandeur->user->username, ['placeholder' => 'Votre nom', 'class' => 'form-control']) !!}
                                {!! Form::hidden('numero', $pcharge->demandeur->numero, ['placeholder' => '', 'class' => 'form-control']) !!}
                                <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mot de passe">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="far fa-paper-plane"></i>&nbsp;Modifier</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
