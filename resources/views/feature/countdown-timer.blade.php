@php
    $databaseDatetime = strtotime($theme->close);
    $currentDatetime = time();
    $timeRemaining = max(0, $databaseDatetime - $currentDatetime); // ensure non-negative
@endphp

<script>
    let timeRemaining = {{ $timeRemaining }};

    function formatTimeUnit(unit) {
        return unit < 10 ? '0' + unit : unit;
    }

    function updateCountdown() {
        const countdownEl = document.getElementById('countdown');

        if (!countdownEl) return;

        if (timeRemaining <= 0) {
            location.reload(); // Or you can redirect or show an expired message
            return;
        }

        const hours = Math.floor(timeRemaining / 3600);
        const minutes = Math.floor((timeRemaining % 3600) / 60);
        const seconds = timeRemaining % 60;

        if (timeRemaining <= 86400) {
            countdownEl.innerHTML = `
                <p>Time Remaining:
                    <span>${formatTimeUnit(hours)} :</span>
                    <span>${formatTimeUnit(minutes)} :</span>
                    <span>${formatTimeUnit(seconds)}</span>
                    Until This Form Closes.
                </p>`;
        }

        timeRemaining--;
        setTimeout(updateCountdown, 1000);
    }

    updateCountdown();
</script>
