<script>
    let lastActivityTime = Date.now();
    let lastMessageUpdate = 0;

    const messages = [
        "Please submit the form soon!",
        "Your session is inactive.",
        "Don't forget to submit your work!",
        "Submit before it’s too late!",
        "Hurry up and complete the form!",
        "Time is running out — submit now!",
        "Your data might be lost if you wait too long.",
        "Almost there! Finish your submission.",
        "Keep going! Submit your form.",
        "Don't leave your form hanging!",
        "Need help? Reach out before submitting.",
        "Remember to save your progress.",
        "Your input matters — submit soon!",
        "Waiting too long? Submit now to be safe.",
        "Submit before the session expires!",
        "Final reminder: complete your submission.",
        "Don't delay, submit today!",
        "Act fast — the timer is ticking!",
        "Submit your form to avoid losing changes.",
        "Complete your task before time runs out!"
    ];

    // Activity listener to reset state
    $(document.body).on("mousemove keypress click", () => {
        lastActivityTime = Date.now();
        lastMessageUpdate = 0;
        $('#inactive-time').text('0m 00s');
        updateMessageText('');
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

    function getRandomMessage() {
        const index = Math.floor(Math.random() * messages.length);
        return messages[index];
    }

    function updateMessageText(text) {
        $('#submit-warning').text(text);
    }

    function cycleMessages() {
        const now = Date.now();
        const inactivitySeconds = Math.floor((now - lastActivityTime) / 1000);

        if (inactivitySeconds >= 10) {
            showOverlay();

            // Change message every 5 seconds (if not the same as last update)
            if (inactivitySeconds % 5 === 0 && inactivitySeconds !== lastMessageUpdate) {
                updateMessageText(getRandomMessage());
                lastMessageUpdate = inactivitySeconds;
            }
        } else {
            hideOverlay();
            lastMessageUpdate = 0;
        }

        setTimeout(cycleMessages, 1000);
    }

    function updateInactiveTimeDisplay() {
        const now = Date.now();
        const inactivitySeconds = Math.floor((now - lastActivityTime) / 1000);

        const minutes = Math.floor(inactivitySeconds / 60);
        const seconds = inactivitySeconds % 60;
        const formatted = `${minutes}m ${seconds.toString().padStart(2, '0')}s`;

        const $timeEl = $('#inactive-time');
        $timeEl.text(formatted);

        $timeEl.removeClass('animated');
        void $timeEl[0].offsetWidth; // Force reflow to retrigger animation
        $timeEl.addClass('animated');

        setTimeout(updateInactiveTimeDisplay, 1000);
    }

    // Initialize
    updateInactiveTimeDisplay();
    cycleMessages();
</script>
