<script>
    $(function() {
        const $dateInput = $('input[name="date"]');
        const start = moment('2024-06-01');
        const end = moment('2025-08-15');

        $dateInput.daterangepicker({
            opens: 'left',
            startDate: start,
            endDate: end,
            minDate: start,
            maxDate: end,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        $dateInput.on('apply.daterangepicker', function(ev, picker) {
            const selectedStart = picker.startDate.format('YYYY-MM-DD');
            const selectedEnd = picker.endDate.format('YYYY-MM-DD');
            console.log(`Date selected: ${selectedStart} to ${selectedEnd}`);
            // You can also update hidden inputs or trigger AJAX here
        });
    });
</script>
