<script>
    let lastActivityTime = new Date().getTime();
    let alertShown = false;

    // Reset activity on user interaction
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

    function showOverlay() {
        $('#inactivity-overlay').css({
            opacity: 1,
            pointerEvents: 'auto'
        });
    }

    function updateInactiveTimeDisplay() {
        const currentTime = new Date().getTime();
        const inactivitySeconds = Math.floor((currentTime - lastActivityTime) / 1000);

        const minutes = Math.floor(inactivitySeconds / 60);
        const seconds = inactivitySeconds % 60;
        const formattedTime = `${minutes}m ${seconds.toString().padStart(2, '0')}s`;

        const $timeEl = $('#inactive-time');
        $timeEl.text(formattedTime);

        // Restart animation (if applicable)
        $timeEl.removeClass('animated');
        void $timeEl[0].offsetWidth; // Force reflow
        $timeEl.addClass('animated');

        if (inactivitySeconds >= 10) {
            showOverlay();
        }

        setTimeout(updateInactiveTimeDisplay, 1000);
    }

    function checkInactivity() {
        const currentTime = new Date().getTime();
        const inactivity = currentTime - lastActivityTime;

        // Reload after 5 minutes (300,000 ms)
        if (inactivity >= 300000) {
            window.location.reload(true);
        }
        // Warn at 4 minutes (240,000 ms)
        else if (inactivity >= 240000 && !alertShown) {
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
                        const left = Swal.getTimerLeft();
                        if (left !== null) {
                            b.textContent = Math.ceil(left / 1000);
                        }
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

    // Start timers
    updateInactiveTimeDisplay();
    checkInactivity();
</script>
