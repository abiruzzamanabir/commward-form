@php
    use Carbon\Carbon;
    $close = Carbon::parse($theme->close);
@endphp

@if (Carbon::now() <= $close)
    <script>
        function startSessionTimeout() {
            // Session timeout in minutes (from config) minus 5 minutes warning time
            const sessionLifetimeMinutes = {{ config('session.lifetime', 30) }};
            let timeoutSeconds = (sessionLifetimeMinutes * 60);
            const warningSeconds = 300; // 5 minutes before timeout

            function formatTime(seconds) {
                const min = Math.floor(seconds / 60);
                const sec = seconds % 60;
                return `${min}:${sec < 10 ? '0' : ''}${sec}`;
            }

            function updateTimeDisplay() {
                const el = document.getElementById('sessionTime');
                if (el) {
                    el.innerHTML = `<span>${formatTime(timeoutSeconds)}</span>`;
                }
            }

            // Show initial session time warning
            Swal.fire({
                icon: 'warning',
                title: 'Session Time Notice',
                text: `Your time is set to ${sessionLifetimeMinutes} minutes. Please fill and submit within this time.`,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateTimeDisplay();

                    const intervalId = setInterval(() => {
                        timeoutSeconds--;

                        updateTimeDisplay();

                        // Show 5-minute warning alert once
                        if (timeoutSeconds === warningSeconds) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Session Expiring Soon',
                                text: 'Your session will expire in 5 minutes. Please finalize and submit your work promptly.',
                                timer: 10000,
                                timerProgressBar: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });
                        }

                        // When session expires
                        if (timeoutSeconds <= 0) {
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
            });
        }

        // Start countdown on page load
        startSessionTimeout();
    </script>
@endif
