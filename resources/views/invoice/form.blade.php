@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f0f0f0;
        }

        .card {
            background-color: #f0f0f0;
            border-radius: 20px;
            padding: 20px;
        }

        .form-control {
            background-color: #f0f0f0;
            border: none;
            border-radius: 10px;
            box-shadow: inset 5px 5px 10px #d9d9d9, inset -5px -5px 10px #ffffff;
        }

        .btn-primary {
            background-color: #1877f2;
            border: none;
            border-radius: 10px;
            box-shadow: 5px 5px 10px #b0b0b0, -5px -5px 10px #ffffff;
        }

        .btn-primary:hover {
            background-color: #145da0;
        }
    </style>
</head>

<body>
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5 py-3 my-3">
            <div class="card shadow">
                <div class="card-header text-center">
                    <a href="{{ $theme->url }}">
                        <img width="150px" src="{{ asset('assets/img/' . $theme->logo) }}" alt="">
                    </a>
                </div>

                <div class="card-body">
                    @include('validate')
                    @if ($form_type == 'store')
                        <form action="{{ route('invoice.store') }}" method="POST" class="was-validated">
                            @csrf
                            <div class="text-center">
                                <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-primary">View
                                    Invoice</a>
                            </div>
                            <div class="border p-3 shadow my-3">
                                <div class="mb-2">
                                    <label for="validationName" class="form-label"><b>Company Name<span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" required>
                                    <div class="invalid-feedback">Enter Company Name</div>
                                    <label for="validationName" class="form-label"><b>Invoice Number<span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="invoice" class="form-control"
                                        value="{{ old('invoice') }}" required>
                                    <div class="invalid-feedback">Enter Invoice Number</div>
                                    <label for="validationName" class="form-label"><b>Quantity<span
                                                class="text-danger">*</span></b></label>
                                    <input type="number" id="value" min="1" name="total"
                                        class="form-control" value="{{ old('total') }}" required>
                                    <div class="invalid-feedback">Enter Quantity Number</div>
                                    <label for="validationName" class="form-label"><b>Total Amount (Including 15%
                                            VAT)<span class="text-danger">*</span></b></label>
                                    <input type="hidden" id="rate" class="form-control"
                                        value="{{ $theme->amount }}">
                                    <input type="text" id="amount" name="amount" class="form-control"
                                        value="15000" required readonly>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <button style="width: 100%" class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('invoice.update', $edit->id) }}" method="POST" class="was-validated">
                            @csrf
                            @method('PATCH')
                            <div class="text-center">
                                <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-primary">View Invoice</a>
                            </div>
                            <div class="border p-3 shadow my-3">
                                <div class="mb-2">
                                    <label for="validationName" class="form-label"><b>Company Name<span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $edit->name }}" required>
                                    <div class="invalid-feedback">Enter Company Name</div>
                                    <label for="validationName" class="form-label"><b>Invoice Number<span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="invoice" class="form-control"
                                        value="{{ $edit->invoice }}" required>
                                    <div class="invalid-feedback">Enter Invoice Number</div>
                                    <label for="validationName" class="form-label"><b>Quantity<span
                                                class="text-danger">*</span></b></label>
                                    <input type="number" id="value" min="1" name="total"
                                        class="form-control" value="{{ $edit->total }}" required>
                                    <div class="invalid-feedback">Enter Quantity Number</div>
                                    <label for="validationName" class="form-label"><b>Total Amount (Including 15%
                                            VAT)<span class="text-danger">*</span></b></label>
                                    <input type="hidden" id="rate" class="form-control"
                                        value="{{ $theme->amount }}">
                                    <input type="text" id="amount" name="amount" class="form-control"
                                        value="15000" required readonly>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <button style="width: 100%" class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="card-footer text-center">
                    @include('footer')
                </div>
            </div>
        </div>
    </div>
    @include('feature.kill')
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            function getAmount() {
                var value = $('#value').val();
                var percent = $('#rate').val();
                var total = value * percent;
                $('#amount').val(total + (total * 0.15));
            }
            getAmount();
            $('#value').on('change', getAmount);
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
</body>

</html>
