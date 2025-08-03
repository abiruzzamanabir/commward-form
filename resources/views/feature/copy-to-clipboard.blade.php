<script>
    // Generic copy function using Clipboard API with fallback
    function copyToClipboard(text, label) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showSuccess(label + ' copied to clipboard: ' + text);
            }).catch(() => {
                fallbackCopy(text, label);
            });
        } else {
            fallbackCopy(text, label);
        }
    }

    // Fallback for older browsers
    function fallbackCopy(text, label) {
        const input = document.createElement('input');
        document.body.appendChild(input);
        input.value = text;
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        showSuccess(label + ' copied to clipboard: ' + text);
    }

    // SweetAlert success message
    function showSuccess(message) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 2000
        });
    }

    // Wrapper functions
    function copyUserId(userId) {
        copyToClipboard(userId, 'User ID');
    }

    function copyUserEmail(userEmail) {
        copyToClipboard(userEmail, 'User Email');
    }
</script>
