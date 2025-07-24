(function ($) {
    $(document).ready(function () {
        $(".delete-form").submit(function (e) {
            let conf = confirm("Are you sure?");

            if (conf) {
                return true;
            } else {
                e.preventDefault();
            }
        });

        let btn_no = 1;

        $("#add-new-vision-button").click(function (e) {
            e.preventDefault();

            $(".vision-btn-opt-area").append(`
                            <div class="btn-section">
                            <div class="d-flex justify-content-between">
                            <span>Button ${btn_no}</span>
                            <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i class="fa fa-close" aria-hidden="true"></i></span>
                            </div>
                            <input name="vision_name[]" class="form-control my-3" type="text" placeholder="Vision Name">
                            <input name="vision_desc[]" class="form-control my-3" type="text" placeholder="Vision Description">
                            </div>
                    `);
            btn_no++;
        });

        $(document).on("click", ".remove-btn", function () {
            $(this).closest(".btn-section").remove();
        });

    });
})(jQuery);
