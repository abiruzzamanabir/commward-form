@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);

    use Carbon\Carbon;
    $time = Carbon::parse($theme->close);
    $close = $time;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form | {{ $theme->title }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f2f2f2;
            background-image: url("{{ asset('assets/img/' . $theme->background) }}");
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

        .session-info {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background-color: #f2f2f2;
            padding: 5px 10px 0px;
            color: black;
            border-radius: 10px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');

        #inactivity-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            font-size: 2em;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease-in-out;
            font-family: 'Share Tech Mono', monospace;
            text-align: center;
        }

        .inactivity-wrapper {
            background: rgba(0, 0, 0, 0.6);
            padding: 2rem;
            border-radius: 12px;
            border: 2px solid #ffffff30;
            box-shadow: 0 0 20px #00000070;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            max-width: 90%;
        }

        #inactive-time {
            font-size: 1.5em;
            color: #00ffcc;
            animation: fadeIn 1s forwards;
        }

        #inactive-time.animated {
            animation: tick 0.4s ease-in-out, fadeIn 1s forwards;
        }

        #submit-warning {
            font-size: 0.8em;
            color: #ffc107;
            transition: opacity 0.5s ease-in-out;
            opacity: 1;
        }

        @keyframes tick {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container shadow">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div id="inactivity-overlay">
                    <div class="inactivity-wrapper">
                        <div class="label">You've been inactive</div>
                        <div id="inactive-time">0m 00s</div>
                        <div id="submit-warning">Please submit the form soon!</div>
                    </div>
                </div>

                <div class="card-header text-center">
                    <a href="{{ $theme->url }}">
                        <img width="150px" src="{{ asset('assets/img/' . $theme->logo) }}" alt="">
                    </a>
                    <!-- <div class="time py-1" id="countdown"></div> -->
                    @if (Carbon::now() <= $close)
                        <div class="session-info shadow-sm">
                            <h1 id="sessionTime"></h1>
                        </div>
                    @endif
                </div>
                <div class="card shadow">
                    @if ($form_type == 'store')
                        @if (Carbon::now() <= $close)
                            <div class="card-body">
                                @include('validate')
                                @include('nomination.form.form')
                            </div>
                        @else
                            <div class="card-body">
                                <h3 class="text-center text-danger">
                                    Nomination submission window is now closed.
                                </h3>
                            </div>
                        @endif
                    @endif
                    @if ($form_type == 'edit')
                        @include('nomination.edit')
                    @endif
                </div>
                <div class="card-footer text-muted text-center">
                    @include('footer')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @include('feature.addRemoveMembers')
    @include('feature.wordLimit')
    @include('feature.countdown-timer')
    @include('feature.date-range-picker')
    @include('feature.session-timeout-warning')
    @include('feature.kill')
    @include('feature.inactivity-warning')


    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
