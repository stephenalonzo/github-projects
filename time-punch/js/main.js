// Vacation Leave
$("#leave_type").on("change", function (){

    // Annual Leave
    if (this.value == 1)
    {

        // Div Settings
        $("#default_leave").removeClass("flex").addClass("hidden");
        $("#secondary_leave").removeClass("hidden").addClass("flex");

        // Input Settings
        $("#leave_start_default").attr("disabled", true);
        $("#leave_end_default").attr("disabled", true);
        $("#leave_start_secondary").removeAttr("disabled", true);
        $("#leave_end_secondary").removeAttr("disabled", true);

    } else {

        $("#default_leave").removeClass("hidden").addClass("flex");
        $("#secondary_leave").removeClass("flex").addClass("hidden");

        // Input Settings
        $("#leave_start_default").removeAttr("disabled", true);
        $("#leave_end_default").removeAttr("disabled", true);
        $("#leave_start_secondary").attr("disabled", true);
        $("#leave_end_secondary").attr("disabled", true);

    }

});