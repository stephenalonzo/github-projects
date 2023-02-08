// Vacation Leave
$("#vacationLeave").on("change", function (){
    // Secondary Leave settings
    $("#secondaryLeave").removeClass("d-none").addClass("d-flex");
    $("#leaveFromDateSecondary").removeAttr("disabled", true);
    $("#leaveToDateSecondary").removeAttr("disabled", true);
    $("#leaveReason").removeAttr("disabled", true);

    // Standard Leave settings
    $("#standardLeave").addClass("d-none");
    $("#leaveFromDate").attr("disabled", true);
    $("#leaveToDate").attr("disabled", true);
});

// Annual Leave
$("#annualLeave").on("change", function (){
    // Secondary Leave settings
    $("#secondaryLeave").removeClass("d-none").addClass("d-flex");
    $("#leaveFromDateSecondary").removeAttr("disabled", true);
    $("#leaveToDateSecondary").removeAttr("disabled", true);
    $("#leaveReason").removeAttr("disabled", true);

    // Standard Leave settings
    $("#standardLeave").addClass("d-none");
    $("#leaveFromDate").attr("disabled", true);
    $("#leaveToDate").attr("disabled", true);
});

// Sick Leave
$("#sickLeave").on("change", function (){
    // Secondary Leave settings
    $("#secondaryLeave").addClass("d-none").remove("d-flex");
    $("#leaveFromDateSecondary").attr("disabled", true);
    $("#leaveToDateSecondary").attr("disabled", true);
    $("#leaveReason").attr("disabled", true);

    // Standard Leave settings
    $("#standardLeave").removeClass("d-none");
    $("#leaveFromDate").removeAttr("disabled", true);
    $("#leaveToDate").removeAttr("disabled", true);
})