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
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.css" />
    <script src="https://use.fontawesome.com/b477068b8c.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/'.$theme->favicon)}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <a href="{{ route('invoice.form') }}" class="btn btn-sm btn-success">Add Invoice</a>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-primary">Dashboard<span
                            class="badge bg-light text-dark ms-1">{{ $count }}</span></a>
                    </div>
                    <div class="card-body overflow-auto">
                        @include('validate')
                        <table style="text-align: center" id="dashboard" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">#</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Invoice Number</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Used</th>
                                    <th scope="col">Available</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_invoice as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                        <td class="text-capitalize">{{ $item->name }}</td>
                                        <td>{{ $item->invoice }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->used }}</td>
                                        <td>{{ $item->available }}</td>
                                        <td>@if ($item->available>0)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                        <span class="badge bg-danger">All Used</span>
                                        @endif</td>
                                        <td scope="col">
                                            <span class="d-flex">
                                            <a class="btn btn-sm btn-success me-1"
                                                href="{{ route('invoice.edit', $item->id) }}"><i
                                                    class="fa fa-edit" aria-hidden="true"></i></a>
                                            <form class="d-inline delete-form"
                                                action="{{ route('invoice.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"
                                                        aria-hidden="true"></i></button>
                                            </form>
                                        </span></td>
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
    @include('feature.kill')
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

    <script>
        $(document).ready(function() {
            $('#dashboard').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
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
