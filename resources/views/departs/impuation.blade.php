@extends('layout.default')
@section('title', 'ONFP - Modification des courriers arrivées')
@section('content')
    <div class="content mb-5">
        <div class="container col-8 col-md-8 col-lg-8 col-xl-8">
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
                <div class="row pb-2">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                                    href="{{ route('departs.index') }}"><i class="fas fa-undo-alt"></i>Retour</a></li>
                            <li class="breadcrumb-item active">Imputation courrier départ</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 pt-2">
                        <span class="card-category"><b>N° ordre </b>: {!! $depart->numero ?? '' !!}</span><br />
                        <span class="card-category"><b>Date départ </b>: {!! \Carbon\Carbon::parse($courrier->date_depart)->format('d/m/Y') !!}</span><br />
                        <span class="card-category"><b>Destinataire </b>: {!! $depart->destinataire !!}</span> <br />
                        <span class="card-category"><b>Objet </b>: {!! $courrier->objet !!}</span><br />
                        
                            @if ($depart->courrier->directions != '[]')
                            <span class="card-category"><b>Imputation </b>:
                            @foreach ($depart->courrier->directions as $imputation)
                                <span>{!! $imputation->sigle ?? 'Aucune' !!}, </span>
                            @endforeach
                            @else
                                
                            @endif
                        </span><br /><br />
                        <div class="card">
                            <div class="card-body custom-edit-service">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Imputation</label>
                                            <input type="text" placeholder="Imputation"
                                                class="form-control form-control-sm @error('product') is-invalid @enderror"
                                                name="product" id="product" value="">
                                            <div class="col-lg-6" id="productList">
                                            </div>
                                            @error('product')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Chef</label>
                                            <input type="text" placeholder="Entrer prix de vente"
                                                class="form-control form-control-sm @error('chef') is-invalid @enderror"
                                                name="chef" id="chef" value="">
                                            @error('chef')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" placeholder="ID"
                                        class="form-control form-control-sm @error('id_direction') is-invalid @enderror"
                                        name="id_direction" id="id_direction" value="0.0" min="0">
                                    <input type="hidden" placeholder="ID"
                                        class="form-control form-control-sm @error('id_employe') is-invalid @enderror"
                                        name="id_employe" id="id_employe" value="" min="0">
                                    <input type="hidden" placeholder="imp"
                                        class="form-control form-control-sm @error('imp') is-invalid @enderror"
                                        name="imp" id="imp" value="1">

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button id="addMore" class="btn btn-success btn-sm"><i class="fa fa-plus"
                                                aria-hidden="true"></i>&nbsp;Ajouter</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <small class="row form-row justify-content-center pb-4">
                        {{--  @foreach ($sales as $sale)
                                    <a href="{{ url('admin/sales/facture', ['$id' => $sale->id]) }}" class="showbtn"
                                        target="_blank" title="Télécharger la dernière facture"><button
                                            class="btn btn-outline-secondary btn-sm"><i class="fa fa-print"
                                                aria-hidden="true">&nbsp;Télécharger la facture de la dernière
                                                vente</i></button></a>
                                @endforeach  --}}
                    </small>
                    <div class="col-lg-12">
                        {{--  <form method="POST" action="{{ route('sales.store') }}">  --}}
                        {!! Form::open(['url' => 'departs/' . $depart->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered" style="display: none;">
                                <thead>
                                    <tr>
                                        <th style="width: 50%">Direction</th>
                                        <th>Responsable</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                </tbody>                            
                                <tbody>
                                    <tr>
                                        <td colspan="1" class="">
                                            {{--  <strong>Actions attendues </strong>  --}}
                                            {{--   <textarea type="text" placeholder="Instructions du DG"
                                                class="form-control form-control-sm @error('description') is-invalid @enderror"
                                                name="description" id="description" value="" required></textarea>  --}}
                                            <strong>{!! Form::label('Actions attendues') !!}</strong>
                                            {!! Form::select(
                                                'description',
                                                [
                                                    'Aucune' => 'Aucune',
                                                    'Urgent' => 'Urgent',
                                                    'M\'en parler' => 'M\'en parler',
                                                    'Etudes et Avis' => 'Etudes et Avis',
                                                    'Répondre' => 'Répondre',
                                                    'Suivi' => 'Suivi',
                                                    'Information' => 'Information',
                                                    'Diffusion' => 'Diffusion',
                                                    'Attribution' => 'Attribution',
                                                    'Classement' => 'Classement',
                                                ],
                                                $depart->courrier->description,
                                                [
                                                    'placeholder' => 'Instructions du DG',
                                                    'class' => 'form-control form-control-sm',
                                                    'required' => true,
                                                    'id' => 'description',
                                                ],
                                            ) !!}

                                            <small id="emailHelp" class="form-text text-muted">
                                                @if ($errors->has('description'))
                                                    @foreach ($errors->get('description') as $message)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @endforeach
                                                @endif
                                            </small>
                                        </td>
                                        <td colspan="1">
                                            <strong><label for="date_imp">{{ __('Date imputation') }}</label></strong>
                                            <input id="date_imp" {{ $errors->has('date_imp') ? 'is-invalid' : '' }}
                                                type="date"
                                                class="form-control form-control-sm @error('date_imp') is-invalid @enderror"
                                                name="date_imp" placeholder="Date imputation"
                                                value="{{ optional($depart->courrier->date_imp)->format('Y-m-d') ?? old('date_imp') }}"
                                                autocomplete="date_imp">
                                            @error('date_imp')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            {{--  <button type="submit" class="btn btn-success btn-sm">
                                                    Imputer</button>  --}}
                                            {!! Form::submit('Imputer', ['class' => 'btn btn-outline-primary pull-right']) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                    <script src="//code.jquery.com/jquery.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
                    <script id="document-template" type="text/x-handlebars-template">
                    <tr class="delete_add_more_item" id="delete_add_more_item">    
                        <td>
                            <input type="hidden" name="id_direction[]" value="@{{ id_direction }}" required placeholder="Id direction" class="form-control form-control-sm">
                            <input type="hidden" name="id_employe[]" value="@{{ id_employe }}" required placeholder="Id employe" class="form-control form-control-sm">
                            <input type="text" name="product[]" value="@{{ product }}" required placeholder="Direction" class="form-control form-control-sm">                            
                            <input type="hidden" name="imp" value="@{{ imp }}">
                        </td>
                        <td>
                        <input type="text" class="chef form-control form-control-sm" name="chef[]" value="@{{ chef }}" required min="1" placeholder="Le nom du responsable" readonly>
                      </td>
                        <td>
                        <i class="removeaddmore" style="cursor:pointer;color:red;" title="supprimer"><i class="fas fa-trash"></i></i>
                        </td>    
                    </tr>
                    </script>
                    <script type="text/javascript">
                        $(document).on('click', '#addMore', function() {
                            $('.table').show();
                            var product = $("#product").val();
                            var id_direction = $("#id_direction").val();
                            var id_employe = $("#id_employe").val();
                            var chef = $("#chef").val();
                            var imp = $("#imp").val();
                            var source = $("#document-template").html();
                            var template = Handlebars.compile(source);
                            var data = {
                                product: product,
                                id_direction: id_direction,
                                id_employe: id_employe,
                                chef: chef,
                                imp: imp,
                            }
                            var html = template(data);
                            $("#addRow").append(html)
                            total_ammount_price();
                        });
                        $(document).on('click', '.removeaddmore', function(event) {
                            $(this).closest('.delete_add_more_item').remove();
                            total_ammount_price();
                        });

                        $('#product').keyup(function() {
                            var query = $(this).val();
                            if (query != '') {
                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url: "{{ route('arrive.fetch') }}",
                                    method: "POST",
                                    data: {
                                        query: query,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#productList').fadeIn();
                                        $('#productList').html(data);
                                    }
                                });
                            }
                        });
                        $(document).on('click', 'li', function() {
                            $('#product').val($(this).text());
                            $('#id_direction').val($(this).data("id"));
                            $('#id_employe').val($(this).data("employeeid"));
                            $('#chef').val($(this).data("chef"));
                            $('#productList').fadeOut();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
