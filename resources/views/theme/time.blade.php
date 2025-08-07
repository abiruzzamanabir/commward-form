@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
    $envFilePath = base_path('.env');
    $envContents = file_get_contents($envFilePath);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form | {{ $theme->title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f2f2f2;
            background-image: url('{{ asset('assets/img/' . $theme->background) }}');
        }

        .container {
            max-width: 700px;
            padding: 20px;
            margin: 40px auto;
            background-color: #f2f2f2;
            border-radius: 15px;
            /* box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), -10px -10px 20px rgba(255, 255, 255, 0.5); */
        }

        .border {
            border-radius: 15px;
        }

        .form-control {
            background-color: #f2f2f2;
            border: none;
            border-radius: 10px;
            box-shadow: inset 6px 6px 6px rgba(0, 0, 0, 0.1), inset -6px -6px 6px rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            outline: none;
            box-shadow: inset 4px 4px 4px rgba(0, 0, 0, 0.1), inset -4px -4px 4px rgba(255, 255, 255, 0.5);
        }

        .btn-primary {
            background-color: #65a9e6;
            border-color: #65a9e6;
            border-radius: 10px;
            box-shadow: 6px 6px 6px rgba(0, 0, 0, 0.1), -6px -6px 6px rgba(255, 255, 255, 0.5);
        }

        .btn-primary:hover {
            background-color: #5593cd;
            border-color: #5593cd;
        }

        .card {
            background-color: #f2f2f2;
            border: none;
            border-radius: 15px;
            /* box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), -10px -10px 20px rgba(255, 255, 255, 0.5); */
        }

        .card-header {
            background-color: #f2f2f2;
            border-bottom: none;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            background-color: #f2f2f2;
            border-top: none;
            border-radius: 0 0 15px 15px;
        }

        h5 {
            color: #333;
        }

        label {
            color: #555;
        }

        .count {
            font-size: 10px;
            box-shadow: inset 6px 6px 6px rgba(0, 0, 0, 0.1), inset -6px -6px 6px rgba(255, 255, 255, 0.5);
            display: block;
            text-align: center;
            margin: 5px auto 20px !important;
            width: 30%;
            padding: 5px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container shadow">
        <div class="row justify-content-center align-items-center">
            @if (session('authenticatedTime'))
                <div class="col-md-12">
                    <div class="card-header text-center">
                        <h3><u>Settings</u></h3>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            @include('validate')
                            <form action="{{ route('theme.update', 1) }}" method="POST" class="was-validated"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="border p-3 shadow my-3">
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>App Name</b> <span class="text-danger">*</span></b>
                                        </label> --}}
                                        <input type="hidden" name="name" class="form-control"
                                            value="{{ $theme->name }}" required>
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>Title</b> <span class="text-danger">*</span></b>
                                        </label> --}}
                                        <input type="hidden" name="title" class="form-control"
                                            value="{{ $theme->title }}" required>
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>URL</b> <span class="text-danger">*</span></b>
                                        </label> --}}
                                        <input type="hidden" name="url" class="form-control"
                                            value="{{ $theme->url }}" required>
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>Amount</b> <span class="text-danger">*</span></b>
                                        </label> --}}
                                        <input type="hidden" name="amount" class="form-control"
                                            value="{{ $theme->amount }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="validationName" class="form-label">
                                            <b>Close</b> <span class="text-danger">*</span></b>
                                        </label>
                                        <input type="datetime-local" name="close" class="form-control"
                                            value="{{ $theme->close }}" required>
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>Footer</b> <span class="text-danger">*</span></b>
                                        </label> --}}
                                        <input type="hidden" name="footer" class="form-control"
                                            value="{{ $theme->footer }}" required>
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>Logo</b> <span class="text-danger">*</span></b>
                                        </label><br> --}}
                                        {{-- @if ($theme->logo == 'logo.png')
                                        <img class="mb-3" width="100px" src="{{ asset('assets/img/logo.png') }}" alt="">
                                        @else
                                        <img class="mb-3" width="100px" src="{{ asset('assets/img/'.$theme->logo)}}" alt="">
                                        @endif --}}
                                        <input type="hidden" name="old_logo" value="{{ $theme->logo }}"
                                            class="form-control">
                                        <input type="hidden" name="logo" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>Background</b> <span class="text-danger">*</span></b>
                                        </label><br> --}}
                                        {{-- @if ($theme->background == 'background.jpg')
                                        <img class="mb-3" width="200px" src="{{ asset('assets/img/background.jpg') }}" alt="">
                                        @else
                                        <img class="mb-3" width="200px" src="{{ asset('assets/img/'.$theme->background)}}" alt="">
                                        @endif --}}
                                        <input type="hidden" name="old_background" value="{{ $theme->background }}"
                                            class="form-control">
                                        <input type="hidden" name="background" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        {{-- <label for="validationName" class="form-label">
                                            <b>Favicon</b> <span class="text-danger">*</span></b>
                                        </label><br> --}}
                                        {{-- @if ($theme->favicon == 'favicon.ico')
                                        <img class="mb-3" width="50px" src="{{ asset('assets/img/favicon.ico') }}" alt="">
                                        @else
                                        <img class="mb-3" width="50px" src="{{ asset('assets/img/'.$theme->favicon)}}" alt="">
                                        @endif --}}
                                        <input type="hidden" name="old_favicon" value="{{ $theme->favicon }}"
                                            class="form-control">
                                        <input type="hidden" name="favicon" class="form-control">
                                    </div>
                                    <div class="mb-2 d-none">
                                        <label for="validationName" class="form-label">
                                            <b>Payment Live Mode</b> <span class="text-danger">*</span></b>
                                        </label><br>
                                        <div class="d-inline-block me-1">Off</div>
                                        <div class="form-check form-switch d-inline-block">
                                            <input type="checkbox"
                                                @if (strpos($envContents, 'SSLCZ_TESTMODE=true') == true && strpos($envContents, 'IS_LOCALHOST=true')) @else
checked @endif
                                                class="form-check-input" id="site_state" name="live"
                                                style="cursor: pointer;">
                                            <label for="site_state" class="form-check-label">On</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <button style="width: 120px;" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        @include('footer')
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <div class="card-header text-center">
                        <h3><u>Settings</u></h3>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            @include('validate')
                            <form action="{{ route('authenticate.time') }}" method="POST" class="was-validated">
                                @csrf
                                <div class="border p-3 shadow my-3">
                                    <div class="mb-2">
                                        <label for="validationName" class="form-label">
                                            <b>Password</b> <span class="text-danger">*</span></b>
                                        </label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Password To View This Page" autofocus required>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <button style="width: 120px;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        @include('footer')
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('feature.kill')
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    </script>
    <script>
        $(document).ready(function() {
            var sections = [{
                    id: "#background",
                    displayId: "#display_backgroundcount",
                    wordLeftId: "#backgroundword_left",
                    countId: "#backgroundcount",
                    maxLength: 50
                },
                {
                    id: "#objective",
                    displayId: "#display_objectivecount",
                    wordLeftId: "#objectiveword_left",
                    countId: "#objectivecount",
                    maxLength: 50
                },
                {
                    id: "#vision",
                    displayId: "#display_visioncount",
                    wordLeftId: "#visionword_left",
                    countId: "#visioncount",
                    maxLength: 50
                },
                {
                    id: "#idea",
                    displayId: "#display_ideacount",
                    wordLeftId: "#ideaword_left",
                    countId: "#ideacount",
                    maxLength: 150
                },
                {
                    id: "#execution",
                    displayId: "#display_executioncount",
                    wordLeftId: "#executionword_left",
                    countId: "#executioncount",
                    maxLength: 150
                },
                {
                    id: "#value_addition",
                    displayId: "#display_value_additioncount",
                    wordLeftId: "#value_additionword_left",
                    countId: "#value_additioncount",
                    maxLength: 75
                },
                {
                    id: "#result",
                    displayId: "#display_resultcount",
                    wordLeftId: "#resultword_left",
                    countId: "#resultcount",
                    maxLength: 75
                }
            ];

            sections.forEach(function(section) {
                $(section.id).on('input', function() {
                    var words = this.value.match(/\S+/g).length;
                    if (words > section.maxLength) {
                        var trimmed = $(this).val().split(/\s+/, section.maxLength).join(" ");
                        $(this).val(trimmed + " ");
                    } else {
                        $(section.displayId).text(words);
                        $(section.wordLeftId).text(section.maxLength - words);
                        if (words > 1) {
                            $(section.countId).removeClass('d-none');
                        } else if (words < 1) {
                            $(section.countId).addClass('d-none');
                        } else {
                            $(section.countId).addClass('d-none');
                        }
                    }
                });
            });
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
</body>

</html>
