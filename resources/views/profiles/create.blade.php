@extends('layout.default')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier mon profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('add-profiles') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="civilite"
                                        class="col-form-label text-md-right">{{ __('Civilité') }}</label>
                                    <select name="civilite" id="civilite" class="custom-select @error('name') is-invalid @enderror">
                                        <option value=""></option>
                                        @foreach ($civilites as $civilite)
                                            <option value="{{ $civilite->civilite }}">{{ $civilite->civilite }}</option>
                                        @endforeach
                                    </select>                                    
                                    @error('civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="firstname"
                                        class="col-form-label text-md-right">{{ __('Prénom') }}</label>
                                    <input id="firstname" type="text"
                                        class="form-control form-control-user @error('firstname') is-invalid @enderror"
                                        name="firstname" placeholder="Votre prénom" value="{{ old('firstname') }}"
                                        autocomplete="firstname" autofocus>
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Nom') }}</label>
                                    <input id="name" type="text"
                                        class="form-control form-control-user @error('name') is-invalid @enderror"
                                        name="name" placeholder="Votre nom" value="{{ old('name') }}" autocomplete="name"
                                        autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="username" class="col-form-label text-md-right">{{ __('Username') }}</label>
                                    <input id="username" type="text"
                                        class="form-control form-control-user @error('username') is-invalid @enderror"
                                        name="username" placeholder="Votre nom" value="{{ old('username') }}" autocomplete="username"
                                        autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="date_naissance"
                                        class="col-form-label text-md-right">{{ __('Date de naissance') }}</label>
                                    <input id="date_naissance" type="date"
                                        class="form-control form-control-user @error('date_naissance') is-invalid @enderror"
                                        name="date_naissance" placeholder="Votre date de naissance"
                                        value="{{ old('date_naissance') }}" autocomplete="date_naissance" autofocus>

                                    @error('date_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="lieu_naissance"
                                        class="col-form-label text-md-right">{{ __('Lieu de naissance') }}</label>
                                    <input id="lieu_naissance" type="text"
                                        class="form-control form-control-user @error('lieu_naissance') is-invalid @enderror"
                                        name="lieu_naissance" placeholder="Votre lieu de naissance"
                                        value="{{ old('lieu_naissance') }}" autocomplete="lieu_naissance" autofocus>
                                    @error('lieu_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="telephone"
                                        class="col-form-label text-md-right">{{ __('Téléphone') }}</label>
                                    <input id="telephone" type="text"
                                        class="form-control form-control-user @error('telephone') is-invalid @enderror"
                                        name="telephone" placeholder="Votre numéro de téléphone"
                                        value="{{ old('telephone') }}" autocomplete="telephone" autofocus>
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image"
                                    class="col-form-label text-md-right">{{ __('Photo de profil') }}</label>
                                <div class="custom-file col-md-12">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                        name="image" value="{{ old('image') }}" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Chisir une image...</label>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Modifier mon profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
