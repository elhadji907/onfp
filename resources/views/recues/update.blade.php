@extends('layout.default')
@section('title', 'ONFP - Modification des courriers reçus')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('recues.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="row pt-5"></div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">FORMULAIRE DE MODIFICATION COURRIERS ARRIVEES</span></h1>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        {!! Form::open(['url' => 'recues/' . $recue->id, 'method' => 'PATCH', 'files' => true]) !!}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="date_recep">{{ __('DATE D\'ARRIVEE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_recep" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_recep') is-invalid @enderror" name="date_recep"
                                    placeholder="Votre date dépôt"
                                    value="{{ Carbon\Carbon::parse($recue->courrier->date_recep)->format('Y-m-d') ?? old('date_recep') }}"
                                    autocomplete="date_recep">
                                @error('date_recep')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                {{--  {!! Form::label('DATE D\'ARRIVEE', null, ['class' => 'control-label']) !!}  --}}
                                {{--  {!! Form::date('date_recep', $date_r->format('Y-m-d'), ['placeholder'=>"La date de reception du courrier", 'class'=>'form-control']) !!}                      --}}
                                {{--   {!! Form::date('date_recep', null, [
                                    'placeholder' => 'La date de reception du courrier',
                                    'class' => 'form-control',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date_cores">{{ __('DATE CORRESPONDANCE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_cores" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_cores') is-invalid @enderror" name="date_cores"
                                    placeholder="Votre date dépôt"
                                    value="{{ Carbon\Carbon::parse($recue->courrier->date_cores)->format('Y-m-d') ?? old('date_cores') }}"
                                    autocomplete="date_cores">
                                @error('date_cores')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--  {!! Form::label('DATE CORRESPONDANCE', null, ['class' => 'control-label']) !!}  --}}
                                {{--  {!! Form::date('date_cores', $date_r->format('Y-m-d'), ['placeholder'=>"La date de correspondance du courrier", 'class'=>'form-control']) !!}                      --}}
                                {{--  {!! Form::date('date_cores', null, [
                                    'placeholder' => 'La date de correspondance du courrier',
                                    'class' => 'form-control',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-4">

                                <label for="numero_cores">{{ __('NUMERO CORRESPONDANCE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="numero_cores" type="number" min="1"
                                    class="form-control @error('numero_cores') is-invalid @enderror" name="numero_cores"
                                    placeholder="NUMERO CORRESPONDANCE"
                                    value="{{ $recue->courrier->numero ?? old('numero_cores') }}"
                                    autocomplete="numero_cores">
                                @error('numero_cores')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--    {!! Form::label('NUMERO CORRESPONDANCE') !!}
                                {!! Form::number('numero_cores', null, [
                                    'placeholder' => 'Numéro de correspondance',
                                    'class' => 'form-control',
                                    'min' => '1',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-12">
                                {{--  {!! Form::label('EXPEDITEUR') !!}
                                {!! Form::text('expediteur', null, ['placeholder' => 'Expéditeur du courrier', 'class' => 'form-control']) !!}  --}}
                                <label for="expediteur">{{ __('EXPEDITEUR') }}(<span class="text-danger">*</span>)</label>
                                <input id="expediteur" type="text"
                                    class="form-control @error('expediteur') is-invalid @enderror" name="expediteur"
                                    placeholder="Votre et expediteur"
                                    value="{{ $recue->courrier->expediteur ?? old('expediteur') }}"
                                    autocomplete="expediteur">
                                @error('expediteur')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-12">
                                <label for="objet">{{ __('OBJET') }}(<span class="text-danger">*</span>)</label>
                                <input id="objet" type="text"
                                    class="form-control @error('objet') is-invalid @enderror" name="objet"
                                    placeholder="Votre et objet" value="{{ $recue->courrier->objet ?? old('objet') }}"
                                    autocomplete="objet">
                                @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--  {!! Form::label('OBJET') !!}
                                {!! Form::text('objet', null, [
                                    'placeholder' => 'Objet du courrier',
                                    'class' => 'form-control',
                                    'id' => 'objet',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('NUMERO REPONSE') !!}
                                {!! Form::number('numero_reponse', $recue->courrier->name ?? old('numero_reponse'), [
                                    'placeholder' => 'Numéro réponse',
                                    'class' => 'form-control',
                                    'min' => '1',
                                ]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('DATE REPONSE', null, ['class' => 'control-label']) !!}
                                {{--  {!! Form::date('date_cores', $date_r->format('Y-m-d'), ['placeholder'=>"La date de correspondance du courrier", 'class'=>'form-control']) !!}                      --}}
                                {!! Form::date('date_reponse', Carbon\Carbon::parse($recue->courrier->date_imp)->format('Y-m-d') ?? old('date_reponse'), [
                                    'placeholder' => 'La date réponse du courrier',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('INFORMATIONS COMPLEMENTAIRES') !!}
                                {!! Form::textarea('message', $recue->courrier->message ?? old('message'), [
                                    'placeholder' => 'Informations complémentaires...',
                                    'rows' => 2,
                                    'class' => 'form-control',
                                    'id' => 'message',
                                ]) !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('Imputation') !!}
                                {!! Form::select('imputations[]', $imputations, null, [
                                    'multiple' => 'multiple',
                                    'class' => 'form-control',
                                    'id' => 'imputation',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                {!! Form::file('file', null, ['class' => 'form-control-file']) !!}
                                @if ($recue->courrier->file !== '')
                                    <a class="btn btn-outline-secondary mt-2" title="télécharger le fichier joint"
                                        target="_blank" href="{{ asset($recue->courrier->getFile()) }}">
                                        <i class="fas fa-download">&nbsp;Télécharger le courrier</i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary pull-right']) !!}
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
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Fermer</button>
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

@section('javascripts')
    <script type="text/javascript">
        $('#imputation').select2().val({!! json_encode($recue->courrier->imputations()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection
