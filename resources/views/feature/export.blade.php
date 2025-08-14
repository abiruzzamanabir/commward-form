<script>
    $(document).ready(function() {
        $('#dashboard').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    text: '<i class="fa fa-file-csv"></i> CSV',
                    className: 'btn btn-sm btn-outline-primary'
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    className: 'btn btn-sm btn-outline-success'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    className: 'btn btn-sm btn-outline-danger'
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    className: 'btn btn-sm btn-outline-secondary'
                }
            ],
            responsive: true,
            autoWidth: false,
            pageLength: 25,
        });
    });
</script>
