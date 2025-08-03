<script>
    $(function() {
        const container = $(".member-btn-opt-area");
        let memberCount = container.find(".btn-section").length + 1;

        // Function to generate a new member section
        function createMemberSection(index) {
            return `
<div class="btn-section">
    <div class="d-flex justify-content-between">
        <b>Member ${index}</b>
        <span class="remove-btn bg-danger px-2 py-1 rounded text-white" style="cursor:pointer">
            Remove <i class="fas fa-times"></i>
        </span>
    </div>
    <input name="member_name[]" required class="form-control my-3" type="text" placeholder="Team Member Name">
    <input name="member_designation[]" required class="form-control my-3" type="text" placeholder="Team Member Designation">
</div>`;
        }

        // Add new member
        $("#add-new-member-button").on("click", function(e) {
            e.preventDefault();
            container.append(createMemberSection(memberCount++));
        });

        // Remove member
        container.on("click", ".remove-btn", function() {
            $(this).closest(".btn-section").remove();

            // Re-number remaining members
            container.find(".btn-section").each(function(i) {
                $(this).find("b").text(`Member ${i + 1}`);
            });

            memberCount = container.find(".btn-section").length + 1;
        });
    });
</script>
