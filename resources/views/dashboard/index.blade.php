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
    <title>
        @if ($page == 'dashboard')
            Dashboard
        @elseif($page == 'trash')
            Trash
        @else
            Payment Verified
        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.css" />
    <script src="https://use.fontawesome.com/b477068b8c.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            background-color: #f1f1f1;
            background-image: url('{{ asset(' assets/img/' . $theme->background) }}');
        }

        .container-fluid {
            background-color: #f1f1f1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            box-shadow: 8px 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: none;
        }

        .card-header {
            background-color: #f1f1f1;
            border-radius: 10px;
            border-bottom: 1px solid #e1e1e1;
        }

        .card-body {
            background-color: #f1f1f1;
            border-radius: 10px;
        }

        .btn {
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            border-radius: 10px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btnsize {
            width: 20px;
            height: 20px;
            padding: 0;
            border-radius: 50%;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        textarea {
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .btn-info {
            background-color: #58a3f7;
            color: #fff;
        }

        .btn-danger {
            background-color: #f15151;
            color: #fff;
        }

        .btn-success {
            background-color: #4caf50;
            color: #fff;
        }

        .btn-info:hover,
        .btn-info:focus {
            background-color: #4f93d6;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #e04343;
        }

        .btn-success:hover,
        .btn-success:focus {
            background-color: #47a847;
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
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-12">
                <div id="inactivity-overlay">
                    <div class="inactivity-wrapper">
                        <div class="label">You've been inactive</div>
                        <div id="inactive-time">0m 00s</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-center">
                        @if ($page == 'dashboard')
                            <a href="{{ route('trash.index') }}" class="btn btn-sm btn-danger">Trash<span
                                    class="badge bg-light text-dark ms-1">{{ $count }}</span></a>
                            <a href="{{ route('paymentverified.index') }}" class="btn btn-sm btn-success">Payment
                                Verified<span class="badge bg-light text-dark ms-1">{{ $countpv }}</span></a>
                        @elseif($page == 'trash')
                            <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-info">Dashboard<span
                                    class="badge bg-light text-dark ms-1">{{ $count }}</span></a>
                            <a href="{{ route('paymentverified.index') }}" class="btn btn-sm btn-success">Payment
                                Verified<span class="badge bg-light text-dark ms-1">{{ $countpv }}</span></a>
                        @elseif($page == 'pv')
                            <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-info">Dashboard<span
                                    class="badge bg-light text-dark ms-1">{{ $count }}</span></a>
                            <a href="{{ route('trash.index') }}" class="btn btn-sm btn-danger">Trash<span
                                    class="badge bg-light text-dark ms-1">{{ $count1 }}</span></a>
                        @endif
                        <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-primary">Invoice<span
                                class="badge bg-light text-dark ms-1">{{ $invoice }}</span></a>
                    </div>
                    <div class="card-body overflow-auto">
                        @include('validate')
                        @include('dashboard.table.table')
                    </div>
                    <div class="card-footer text-center">@include('footer')</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('feature.inactivity-warning-dashboard')
    @include('feature.delete')
    @include('feature.export')
    @include('feature.copy-to-clipboard')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>

</body>

</html>
