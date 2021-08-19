@extends('layout.default')

@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Modifier mon profile</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profiles.update', [$user]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            {{-- <div class="form-group row">
                                <label for="firstname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="col-md-6">
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                                </div>
                            </div> --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="civilite">{{ __('Civilité') }}</label>
                                    <select name="civilite" id="civilite"
                                        class="form-control @error('civilite') is-invalid @enderror">
                                        <option value="{{ Auth::user()->civilite }}">{{ Auth::user()->civilite }}
                                        </option>
                                        @foreach ($civilites as $civilite)
                                            <option value="{{ $civilite->civilite }}">{{ $civilite->civilite }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="firstname">{{ __('Prénom') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="firstname" type="text"
                                        class="form-control form-control-user @error('firstname') is-invalid @enderror"
                                        name="firstname" placeholder="Votre prénom"
                                        value="{{ old('firstname') ?? Auth::user()->firstname }}"
                                        autocomplete="firstname">
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="name">{{ __('Nom') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="name" type="text"
                                        class="form-control form-control-user @error('name') is-invalid @enderror"
                                        name="name" placeholder="Votre nom"
                                        value="{{ old('name') ?? Auth::user()->name }}" autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="date_naissance">{{ __('Date de naissance') }}</label>
                                    {{-- <div class="col-md-6"> --}}

                                    @if (Auth::user()->date_naissance !== null)
                                        <input id="date_naissance" type="date"
                                            class="form-control form-control-user @error('date_naissance') is-invalid @enderror"
                                            name="date_naissance" placeholder="Votre date de naissance"
                                            value="{{ old('date_naissance') ?? Auth::user()->date_naissance->format('Y-m-d') }}"
                                            autocomplete="date_naissance">
                                    @else
                                        <input id="date_naissance" type="date"
                                            class="form-control form-control-user @error('date_naissance') is-invalid @enderror"
                                            name="date_naissance" placeholder="Votre date de naissance"
                                            value="{{ old('date_naissance') ?? Auth::user()->date_naissance }}"
                                            autocomplete="date_naissance">
                                    @endif
                                    @error('date_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lieu_naissance">{{ __('Lieu de naissance') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="lieu_naissance" type="text"
                                        class="form-control form-control-user @error('lieu_naissance') is-invalid @enderror"
                                        name="lieu_naissance" placeholder="Votre lieu de naissance"
                                        value="{{ old('lieu_naissance') ?? Auth::user()->lieu_naissance }}"
                                        autocomplete="lieu_naissance">
                                    @error('lieu_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="telephone">{{ __('Téléphone') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="telephone" type="text"
                                        class="form-control form-control-user @error('telephone') is-invalid @enderror"
                                        name="telephone" placeholder="Votre numéro de téléphone"
                                        value="{{ old('telephone') ?? Auth::user()->telephone }}"
                                        autocomplete="telephone">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Télécharger</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="image" value="{{ old('image') }}"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="validatedCustomFile" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="validatedCustomFile">Choisir image de
                                                profil</label>

                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="pt-2">
                                    <img class="rounded-circle w-25 border border-secondary" src="{{ asset(Auth::user()->profile->getImage()) }}" width="50"
                                        height="auto">
                                    </div>
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
