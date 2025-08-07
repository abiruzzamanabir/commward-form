@php
    use Carbon\Carbon;
    $close = Carbon::parse($theme->close);
@endphp

@if (Carbon::now() <= $close)
    <script>
        function startSessionTimeout() {
            const sessionLifetimeMinutes = {{ config('session.lifetime', 30) }};
            const warningOffsetMinutes = 5; // Initial warning 5 minutes before timeout
            const finalWarningMinutes = 5; // Last 5 minutes warning

            let countdownSeconds = (sessionLifetimeMinutes - warningOffsetMinutes) * 60;
            let intervalId = null;
            let finalWarningShown = false;

            function formatTime(seconds) {
                const min = Math.floor(seconds / 60);
                const sec = seconds % 60;
                return `${min}:${sec < 10 ? '0' : ''}${sec}`;
            }

            function updateTimeDisplay() {
                const el = document.getElementById('sessionTime');
                if (el) {
                    el.innerHTML = `<span>${formatTime(countdownSeconds)}</span>`;
                }
            }

            function startCountdown() {
                intervalId = setInterval(() => {
                    countdownSeconds--;
                    updateTimeDisplay();

                    if (countdownSeconds === finalWarningMinutes * 60 && !finalWarningShown) {
                        finalWarningShown = true;
                        clearInterval(intervalId); // Pause countdown

                        Swal.fire({
                            icon: 'warning',
                            title: 'Only 5 Minutes Left!',
                            html: `Your session will expire in 5 minutes. Please save your work.`,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Resume countdown after OK pressed
                            startCountdown();
                        });
                    }

                    if (countdownSeconds <= 0) {
                        clearInterval(intervalId);
                        Swal.fire({
                            icon: 'error',
                            title: 'Session Timeout',
                            text: 'Your session has timed out.',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            willClose: () => window.location.reload()
                        });
                    }
                }, 1000);
            }

            Swal.fire({
                icon: 'warning',
                title: 'Session Time Notice',
                html: `You have <strong>${sessionLifetimeMinutes - warningOffsetMinutes} minutes</strong> left to complete and submit your work.<br><br>Time remaining: <span id="sessionTime">${formatTime(countdownSeconds)}</span>`,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'Start Countdown'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateTimeDisplay();
                    startCountdown();
                }
            });
        }

        startSessionTimeout();
    </script>
@endif
