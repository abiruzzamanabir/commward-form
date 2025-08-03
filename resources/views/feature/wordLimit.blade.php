<script>
    $(document).ready(function() {
        const sections = [{
                id: "#background",
                displayId: "#display_backgroundcount",
                wordLeftId: "#backgroundword_left",
                countId: "#backgroundcount",
                maxLength: 150
            },
            {
                id: "#objectives",
                displayId: "#display_objectivescount",
                wordLeftId: "#objectivesword_left",
                countId: "#objectivescount",
                maxLength: 50
            },
            {
                id: "#core_idea",
                displayId: "#display_coreideacount",
                wordLeftId: "#coreideaword_left",
                countId: "#coreideacount",
                maxLength: 100
            },
            {
                id: "#execution",
                displayId: "#display_executioncount",
                wordLeftId: "#executionword_left",
                countId: "#executioncount",
                maxLength: 150
            },
            {
                id: "#result",
                displayId: "#display_resultcount",
                wordLeftId: "#resultword_left",
                countId: "#resultcount",
                maxLength: 150
            }
        ];

        sections.forEach(function(section) {
            $(section.id).on('input', function() {
                const wordsArray = this.value.match(/\S+/g) || [];
                let wordCount = wordsArray.length;

                if (wordCount > section.maxLength) {
                    // Trim the input to maxLength words
                    const trimmed = wordsArray.slice(0, section.maxLength).join(" ");
                    $(this).val(trimmed + " ");

                    // Show SweetAlert only once per limit exceed to avoid flooding alerts
                    if (!$(this).data('alertShown')) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Word Limit Exceeded!',
                            text: `You can only enter a maximum of ${section.maxLength} words.`,
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                        $(this).data('alertShown', true);
                    }
                    wordCount = section.maxLength; // Reset to max length for counter update
                } else {
                    // Reset alertShown flag when input is back within limit
                    $(this).data('alertShown', false);
                }

                $(section.displayId).text(wordCount);
                $(section.wordLeftId).text(section.maxLength - wordCount);

                if (wordCount > 1) {
                    $(section.countId).removeClass('d-none');
                } else {
                    $(section.countId).addClass('d-none');
                }
            });
        });

        // Auto-hide alerts (if any) after 3 seconds
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>
