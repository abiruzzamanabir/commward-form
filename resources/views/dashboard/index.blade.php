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
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-size: 2.5em;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease-in-out;
            font-family: sans-serif;
            text-align: center;
        }

        .inactivity-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4em;
        }

        #inactive-time {
            font-family: 'Share Tech Mono', monospace;
            font-size: 1.5em;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        #inactive-time.animated {
            animation: tick 0.4s ease-in-out, fadeIn 1s forwards;
            display: inline-block;
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
                        <div class="label">Inactive for</div>
                        <div id="inactive-time" class="fade-in">0m 00s</div>
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
                        <table style="text-align: center" id="dashboard" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">#</th>
                                    <th scope="col">Submitted On</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Organization</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Campaign_name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Agency</th>
                                    <th scope="col">Production_house</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Type of Product Or Service</th>
                                    <th scope="col">Campaign Date</th>
                                    <th scope="col">Cost</th>
                                    <!--<th scope="col">Background</th>-->
                                    <!--<th scope="col">Objectives</th>-->
                                    <!--<th scope="col">Core Idea</th>-->
                                    <!--<th scope="col">Execution</th>-->
                                    <!--<th scope="col">Result</th>-->
                                    <th scope="col">Link</th>
                                    <!--<th scope="col">members</th>-->
                                    <th scope="col">Members Link</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Payment Method</th>
                                    @if ($page == 'pv')
                                        <th scope="col">Confirmation</th>
                                    @endif
                                    @if ($page == 'dashboard' || $page == 'trash')
                                        <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_nomination as $item)
                                    <tr>
                                        <th onclick="copyUserId('{{ $item->ukey }}')"
                                            @if (!empty($item->comment)) style="background-color: #fadbd8"
                                        @else @endif
                                            scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ date('l, F j, Y, g:i A', strtotime($item->created_at)) }}</td>
                                        <td class="text-capitalize">{{ $item->name }}</td>
                                        <td onclick="copyUserEmail('{{ $item->email }}')">{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->designation }}</td>
                                        <td>{{ $item->organization }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->campaign_name }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->agency }}</td>
                                        <td>{{ $item->production_house }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->cost }}</td>
                                        <!--<td>{{ $item->background }}</td>-->
                                        <!--<td>{{ $item->objectives }}</td>-->
                                        <!--<td>{{ $item->core_idea }}</td>-->
                                        <!--<td>{{ $item->execution }}</td>-->
                                        <!--<td>{{ $item->result }}</td>-->
                                        <td><a class="text-decoration-none" target="_blank"
                                                href="{{ $item->link }}">{{ $item->link }}</a></td>

                                        <!--<td>-->
                                        <!--    <ol>-->
                                        <!--        @if ($item->members)
-->
                                        <!--        @foreach (json_decode($item->members) as $member)
-->
                                        <!--        <li style="text-align: left;">-->
                                        <!--            {{ $member->member_name }} <br> {{ $member->member_designation }}-->
                                        <!--        </li>-->
                                        <!--
@endforeach-->
                                        <!--
@endif-->

                                        <!--    </ol>-->
                                        <!--</td>-->
                                        <td><a class="text-decoration-none" target="_blank"
                                                href="{{ $item->members_link }}">{{ $item->members_link }}</a></td>

                                        <td class="align-top">
                                            <form action="{{ route('dashboard.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="comment" id="" cols="30" rows="3" placeholder="Enter Your Comment Here....">{{ $item->comment }}</textarea>
                                                <br>
                                                <button class="btn btn-info btn-sm btnsize" type="submit"><i
                                                        class="fa fa-check" aria-hidden="true"></i></button>
                                                <a class="btn btn-info btn-sm btnsize"
                                                    href="{{ route('comment.empty', $item->id) }}"><i
                                                        class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </form>
                                        </td>
                                        @php
                                            $order_details = DB::table('orders')
                                                ->where('transaction_id', $item->ukey)
                                                ->select(
                                                    'transaction_id',
                                                    'status',
                                                    'currency',
                                                    'amount',
                                                    'card_issuer',
                                                )
                                                ->orderBy('id', 'desc')
                                                ->first();
                                        @endphp
                                        <td style="font-size: 12px">
                                            @if ($item->category == 'Innovation By Student')
                                                @if ($item->pv == 1)
                                                    <p>Free<br><span class="badge bg-success">Free</span>
                                                    </p>
                                                    <a href="{{ route('payment.status.update', $item->ukey) }}"><span
                                                            class="badge bg-success">Verified</span></a>
                                                @elseif($item->pv == 0)
                                                    <p>Free<br><span class="badge bg-success">Free</span>
                                                    </p>
                                                    <a href="{{ route('payment.status.update', $item->ukey) }}"><span
                                                            class="badge bg-danger">Unverified</span></a>
                                                @else
                                                @endif
                                            @elseif ($item->payment == 2)
                                                <p>Paid Online<br><span
                                                        class="badge bg-success">Online</span><br><b>{{ $order_details->card_issuer }}</b>
                                                </p>
                                            @elseif ($item->invoice != null)
                                                @if ($item->pv == 0)
                                                    <p class="m-0">Cheque Payment<br>Invoice : <b
                                                            class="@if ($item->pv == 0) text-danger
                                                @elseif($item->pv == 1)
                                            text-success
                                                @else @endif">{{ $item->invoice }}</b><br><a
                                                            href="{{ route('payment.status.update', $item->ukey) }}"><span
                                                                class="badge bg-danger">Payment Unverified</span></a>
                                                    </p>
                                                    {{-- <a class="text-success btnsize" style="font-size: 16px !important" href="{{ route('payment.status.update',$item->ukey) }}"><i class="fa fa-check" aria-hidden="true"></i></a> --}}
                                                @else
                                                    <p class="m-0">Cheque Payment<br>Invoice : <b
                                                            class="@if ($item->pv == 0) text-danger
                                                                    @elseif($item->pv == 1)
                                            text-success
                                            @else @endif">{{ $item->invoice }}</b><br><a
                                                            href="{{ route('payment.status.update', $item->ukey) }}"><span
                                                                class="badge bg-success">Payment verified</span></a>
                                                    </p>
                                                    {{-- <a class="text-danger btnsize" style="font-size: 16px !important" href="{{ route('payment.status.update',$item->ukey) }}"><i class="fa fa-times" aria-hidden="true"></i></a> --}}
                                                @endif
                                            @else
                                                <form action="{{ route('dashboard.payment') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="name" readonly
                                                        value="{{ $item->name }}">
                                                    <input type="hidden" name="email" readonly
                                                        value="{{ $item->email }}">
                                                    <input type="hidden" name="phone" readonly
                                                        value="{{ $item->phone }}">
                                                    <input type="hidden" name="ukey" readonly
                                                        value="{{ $item->ukey }}">
                                                    <button type="submit" class="btn btn-info btn-sm">Send Mail For
                                                        Payment <span
                                                            class="badge bg-success">{{ $item->paymentLinkSend }}</span></button>
                                                </form>
                                            @endif
                                        </td>
                                        @if ($page == 'pv')
                                            <td>
                                                @if ($item->payment == '2')
                                                    <form action="{{ route('dashboard.payment.confirm') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="name" readonly
                                                            value="{{ $item->name }}">
                                                        <input type="hidden" name="email" readonly
                                                            value="{{ $item->email }}">
                                                        <input type="hidden" name="phone" readonly
                                                            value="{{ $item->phone }}">
                                                        <input type="hidden" name="ukey" readonly
                                                            value="{{ $item->ukey }}">
                                                        <button type="submit" class="btn btn-info btn-sm">Send Mail
                                                            For
                                                            Confirmation <span
                                                                class="badge bg-success">{{ $item->confirmLinkSend }}</span></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                        @if ($page == 'dashboard' || $page == 'trash')
                                            <td>
                                                @if ($item->trash)
                                                    <span class="d-flex">
                                                        <a class="btn btn-sm btn-success me-1"
                                                            href="{{ route('trash.update', $item->ukey) }}"><i
                                                                class="fa fa-undo" aria-hidden="true"></i></a>
                                                        <form class="d-inline delete-form"
                                                            action="{{ route('dashboard.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </span>
                                                @else
                                                    <span class="d-flex">
                                                        <a class="btn btn-sm btn-success me-1"
                                                            href="{{ route('form.edit', $item->id) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('trash.update', $item->ukey) }}"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </span>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

    <script>
        let lastActivityTime = new Date().getTime();
        let alertShown = false;

        // User activity hides overlay
        $(document.body).on("mousemove keypress click", function() {
            lastActivityTime = new Date().getTime();
            alertShown = false;
            $('#inactive-time').text('0m 00s');
            hideOverlay();
        });

        function hideOverlay() {
            $('#inactivity-overlay').css({
                opacity: 0,
                pointerEvents: 'none'
            });
        }

        function updateInactiveTimeDisplay() {
            const currentTime = new Date().getTime();
            const inactivitySeconds = Math.floor((currentTime - lastActivityTime) / 1000);

            const minutes = Math.floor(inactivitySeconds / 60);
            const seconds = inactivitySeconds % 60;
            const formattedTime = `${minutes}m ${seconds < 10 ? '0' : ''}${seconds}s`;

            const $timeEl = $('#inactive-time');
            $timeEl.text(formattedTime);

            $timeEl.removeClass('animated');
            void $timeEl[0].offsetWidth; // Force reflow to restart animation
            $timeEl.addClass('animated');

            if (inactivitySeconds >= 10) {
                $('#inactivity-overlay').css({
                    opacity: 1,
                    pointerEvents: 'auto'
                });
            }

            setTimeout(updateInactiveTimeDisplay, 1000);
        }

        function checkInactivity() {
            const currentTime = new Date().getTime();
            const inactivity = currentTime - lastActivityTime;

            if (inactivity >= 300000) {
                window.location.reload(true);
            } else if (inactivity >= 240000 && !alertShown) {
                alertShown = true;

                let timerInterval;
                Swal.fire({
                    title: 'Auto reload alert!',
                    html: 'The page will reload in <b></b> seconds.',
                    timer: 54000,
                    allowOutsideClick: true,
                    showCancelButton: true,
                    confirmButtonText: 'Stay!',
                    cancelButtonText: 'Dismiss',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const b = Swal.getHtmlContainer().querySelector('b');
                        timerInterval = setInterval(() => {
                            b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                        }, 500);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload(true);
                    } else {
                        lastActivityTime = new Date().getTime();
                        alertShown = false;
                        hideOverlay();
                    }
                });
            }

            setTimeout(checkInactivity, 10000);
        }

        // Start everything
        updateInactiveTimeDisplay();
        checkInactivity();

        setTimeout(refresh, 10000);
        $(document).ready(function() {
            $(".delete-form").submit(function(e) {
                e.preventDefault(); // Prevent form from submitting immediately

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Submit the form manually if confirmed
                    }
                });
            });

            $('#dashboard').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv"></i> CSV'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print'
                    }
                ],
                responsive: true,
                autoWidth: false,
                pageLength: 25,
                order: [
                    [1, 'desc']
                ]
            });
        });
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
    <script>
        function copyUserId(userId) {
            var dummyInput = document.createElement('input');
            document.body.appendChild(dummyInput);
            dummyInput.setAttribute('value', userId);
            dummyInput.select();
            document.execCommand('copy');
            document.body.removeChild(dummyInput);
            // alert('User ID copied to clipboard: ' + userId);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'User ID copied to clipboard: ' + userId,
                showConfirmButton: false,
                timer: 2000
            })
        }

        function copyUserEmail(userEmail) {
            var dummyInput = document.createElement('input');
            document.body.appendChild(dummyInput);
            dummyInput.setAttribute('value', userEmail);
            dummyInput.select();
            document.execCommand('copy');
            document.body.removeChild(dummyInput);
            // window.location.href = "mailto:"+ userEmail;
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'User Email copied to clipboard: ' + userEmail,
                showConfirmButton: false,
                timer: 2000
            })
            // alert('User Email copied to clipboard: ' + userEmail);
        }
    </script>

</body>

</html>
