$(document).ready(function () {

    $("#selectStatus").on("change", function () {
        if (this.value == "RF") {
            $("#advTitle").on("change", function () {
                if (this.value == 1) {
                    // RF
                    $("#swRF").css("display", "block");
                    $("#swGF").css("display", "none");

                    // etc GF, RF
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 2) {
                    // RF
                    $("#seRF").css("display", "block");
                    $("#seGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 3) {
                    // RF
                    $("#tRF").css("display", "block");
                    $("#tGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 4) {
                    // RF
                    $("#rRF").css("display", "block");
                    $("#rGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 5) {
                    // RF
                    $("#mRF").css("display", "block");
                    $("#mGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                }
            })
        } else {
            $("#advTitle").on("change", function () {
                if (this.value == 1) {
                    // GF
                    $("#swGF").css("display", "block");
                    $("#swRF").css("display", "none");

                    // etc GF, RF
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 2) {
                    // GF
                    $("#seGF").css("display", "block");
                    $("#seRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 3) {
                    // GF
                    $("#tGF").css("display", "block");
                    $("#tRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 4) {
                    // GF
                    $("#rGF").css("display", "block");
                    $("#rRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else if (this.value == 5) {
                    // GF
                    $("#mGF").css("display", "block");
                    $("#mRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                }
            })
        }
    })

    $("#advTitle").on("change", function () {
        if (this.value == 1) {

            // Saipan West

            $("#selectStatus").on("change", function () {
                if (this.value == "RF") {
                    // RF
                    $("#swRF").css("display", "block");
                    $("#swGF").css("display", "none");

                    // etc GF, RF
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else {
                    // GF
                    $("#swGF").css("display", "block");
                    $("#swRF").css("display", "none");

                    // etc GF, RF
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                }
            })

        } else if (this.value == 2) {

            // Saipan East

            $("#selectStatus").on("change", function () {
                if (this.value == "RF") {
                    // RF
                    $("#seRF").css("display", "block");
                    $("#seGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else {
                    // GF
                    $("#seGF").css("display", "block");
                    $("#seRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                }
            })

        } else if (this.value == 3) {

            // Tinian

            $("#selectStatus").on("change", function () {
                if (this.value == "RF") {
                    // RF
                    $("#tRF").css("display", "block");
                    $("#tGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else {
                    // GF
                    $("#tGF").css("display", "block");
                    $("#tRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                }
            })

        } else if (this.value == 4) {

            // Rota

            $("#selectStatus").on("change", function () {
                if (this.value == "RF") {
                    // RF
                    $("#rRF").css("display", "block");
                    $("#rGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                } else {
                    // GF
                    $("#rGF").css("display", "block");
                    $("#rRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#mRF").css("display", "none");
                    $("#mGF").css("display", "none");
                }
            })
        } else if (this.value == 5) {

            // Managaha

            $("#selectStatus").on("change", function () {
                if (this.value == "RF") {
                    // RF
                    $("#mRF").css("display", "block");
                    $("#mGF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                } else {
                    // GF
                    $("#mGF").css("display", "block");
                    $("#mRF").css("display", "none");

                    // etc GF, RF
                    $("#swRF").css("display", "none");
                    $("#swGF").css("display", "none");
                    $("#seRF").css("display", "none");
                    $("#seGF").css("display", "none");
                    $("#tRF").css("display", "none");
                    $("#tGF").css("display", "none");
                    $("#rRF").css("display", "none");
                    $("#rGF").css("display", "none");
                }
            })
        }
    })

    $("#selectStatus").on("change", function () {
        if (this.value == "RF") {

            // if status is a red flag
            // do all this
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "block");

            $("#locOne").removeAttr("disabled", true);
            $("#locTwo").removeAttr("disabled", true);
            $("#locThree").removeAttr("disabled", true);
            $("#locFour").removeAttr("disabled", true);
            $("#locFive").removeAttr("disabled", true);
            $("#locSix").removeAttr("disabled", true);
            $("#locSeven").removeAttr("disabled", true);
            $("#locEight").removeAttr("disabled", true);
            $("#locNine").removeAttr("disabled", true);
            $("#locTen").removeAttr("disabled", true);
            $("#locEleven").removeAttr("disabled", true);
            $("#locTwelve").removeAttr("disabled", true);
            $("#locThirteen").removeAttr("disabled", true);
            $("#locFourteen").removeAttr("disabled", true);
            $("#locFifteen").removeAttr("disabled", true);
            $("#locSixteen").removeAttr("disabled", true);
            $("#locSeventeen").removeAttr("disabled", true);
            $("#locEighteen").removeAttr("disabled", true);

        } else {

            // if status is not a red flag
            // do all this
            $("#trioOne").css("display", "none");
            $("#initOne").css("display", "none");
            $("#locOne").attr("disabled", true);
            $("#locOne").attr("disabled", true);
            $("#locTwo").attr("disabled", true);
            $("#locThree").attr("disabled", true);
            $("#locFour").attr("disabled", true);
            $("#locFive").attr("disabled", true);
            $("#locSix").attr("disabled", true);
            $("#locSeven").attr("disabled", true);
            $("#locEight").attr("disabled", true);
            $("#locNine").attr("disabled", true);
            $("#locTen").attr("disabled", true);
            $("#locEleven").attr("disabled", true);
            $("#locTwelve").attr("disabled", true);
            $("#locThirteen").attr("disabled", true);
            $("#locFourteen").attr("disabled", true);
            $("#locFifteen").attr("disabled", true);
            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
            $(this).closest('form').find("input[type=text]").val("");
        }
    });

    // checkbox to add second trio
    $("#addTrioTwo").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioTwo").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "block");
            $("#addTrioTwo").prop("checked", false);

            $("#locFour").removeAttr("disabled", true);
            $("#locFive").removeAttr("disabled", true);
            $("#locSix").removeAttr("disabled", true);
            $("#locSeven").removeAttr("disabled", true);
            $("#locEight").removeAttr("disabled", true);
            $("#locNine").removeAttr("disabled", true);
            $("#locTen").removeAttr("disabled", true);
            $("#locEleven").removeAttr("disabled", true);
            $("#locTwelve").removeAttr("disabled", true);
            $("#locThirteen").removeAttr("disabled", true);
            $("#locFourteen").removeAttr("disabled", true);
            $("#locFifteen").removeAttr("disabled", true);
            $("#locSixteen").removeAttr("disabled", true);
            $("#locSeventeen").removeAttr("disabled", true);
            $("#locEighteen").removeAttr("disabled", true);
        }
    })

    // checkbox to add third trio
    $("#addTrioThree").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioThree").css("display", "block");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "block");
            $("#addTrioThree").prop("checked", false);

            $("#locSeven").removeAttr("disabled", true);
            $("#locEight").removeAttr("disabled", true);
            $("#locNine").removeAttr("disabled", true);
            $("#locTen").removeAttr("disabled", true);
            $("#locEleven").removeAttr("disabled", true);
            $("#locTwelve").removeAttr("disabled", true);
            $("#locThirteen").removeAttr("disabled", true);
            $("#locFourteen").removeAttr("disabled", true);
            $("#locFifteen").removeAttr("disabled", true);
            $("#locSixteen").removeAttr("disabled", true);
            $("#locSeventeen").removeAttr("disabled", true);
            $("#locEighteen").removeAttr("disabled", true);
        }
    })

    // checkbox to add fourth trio
    $("#addTrioFour").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioFour").css("display", "block");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "block");
            $("#addTrioFour").prop("checked", false);

            $("#locTen").removeAttr("disabled", true);
            $("#locEleven").removeAttr("disabled", true);
            $("#locTwelve").removeAttr("disabled", true);
            $("#locThirteen").removeAttr("disabled", true);
            $("#locFourteen").removeAttr("disabled", true);
            $("#locFifteen").removeAttr("disabled", true);
            $("#locSixteen").removeAttr("disabled", true);
            $("#locSeventeen").removeAttr("disabled", true);
            $("#locEighteen").removeAttr("disabled", true);
        }
    })

    // checkbox to add fifth trio
    $("#addTrioFive").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioFive").css("display", "block");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "block");
            $("#addTrioFive").prop("checked", false);

            $("#locThirteen").removeAttr("disabled", true);
            $("#locFourteen").removeAttr("disabled", true);
            $("#locFifteen").removeAttr("disabled", true);
            $("#locSixteen").removeAttr("disabled", true);
            $("#locSeventeen").removeAttr("disabled", true);
            $("#locEighteen").removeAttr("disabled", true);
        }
    })

    // checkbox to add sixth trio
    $("#addTrioSix").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioSix").css("display", "block");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "block");
            $("#addTrioSix").prop("checked", false);

            $("#locSixteen").removeAttr("disabled", true);
            $("#locSeventeen").removeAttr("disabled", true);
            $("#locEighteen").removeAttr("disabled", true);
        }
    })

    // checkbox to add seventh trio
    $("#addTrioSeven").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioSeven").css("display", "block");
            $("#initSix").css("display", "none");
            $("#initSeven").css("display", "block");
            $("#addTrioSeven").prop("checked", false);

            $("#locNineteen").removeAttr("disabled", true);
            $("#locTwenty").removeAttr("disabled", true);
            $("#locTwentyOne").removeAttr("disabled", true);
        }
    })

    // checkbox to add eighth trio
    $("#addTrioEight").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioEight").css("display", "block");
            $("#initSeven").css("display", "none");
            $("#initEight").css("display", "block");
            $("#addTrioEight").prop("checked", false);

            $("#locTwentyTwo").removeAttr("disabled", true);
            $("#locTwentyThree").removeAttr("disabled", true);
            $("#locTwentyFour").removeAttr("disabled", true);
        }
    })

    // checkbox to add ninth trio
    $("#addTrioNine").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioNine").css("display", "block");
            $("#initEight").css("display", "none");
            $("#initNine").css("display", "block");
            $("#addTrioNine").prop("checked", false);

            $("#locTwentyFive").removeAttr("disabled", true);
            $("#locTwentySix").removeAttr("disabled", true);
            $("#locTwentySeven").removeAttr("disabled", true);
        }
    })

    // checkbox to add tenth trio
    $("#addTrioTen").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioTen").css("display", "block");
            $("#initNine").css("display", "none");
            $("#initTen").css("display", "block");
            $("#addTrioTen").prop("checked", false);

            $("#locTwentyEight").removeAttr("disabled", true);
            $("#locTwentyNine").removeAttr("disabled", true);
            $("#locThirty").removeAttr("disabled", true);
        }
    })

    // checkbox to add eleventh trio
    $("#addTrioEleven").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioEleven").css("display", "block");
            $("#initTen").css("display", "none");
            $("#initEleven").css("display", "block");
            $("#addTrioEleven").prop("checked", false);

            $("#locThirtyOne").removeAttr("disabled", true);
            $("#locThirtyTwo").removeAttr("disabled", true);
            $("#locThirtyThree").removeAttr("disabled", true);
        }
    })

    // checkbox to add eleventh trio
    $("#addTrioTwelve").on("change", function () {
        if ($(this).prop("checked")) {
            $("#trioTwelve").css("display", "block");
            $("#initEleven").css("display", "none");
            $("#initTwelve").css("display", "block");
            $("#addTrioTwelve").prop("checked", false);

            $("#locThirtyFour").removeAttr("disabled", true);
            $("#locThirtyFive").removeAttr("disabled", true);
            $("#locThirtySix").removeAttr("disabled", true);
        }
    })

    // checkbox to clear 1st batch initialized input boxes
    $("#clearSecond").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "block");
            $("#initTwo").css("display", "none");
            $("#addTrioTwo").prop("checked", false);

            $("#trioTwo").css("display", "none");
            $("#clearSecond").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locFour").attr("disabled", true);
            $("#locFive").attr("disabled", true);
            $("#locSix").attr("disabled", true);
            $("#locSeven").attr("disabled", true);
            $("#locEight").attr("disabled", true);
            $("#locNine").attr("disabled", true);
            $("#locTen").attr("disabled", true);
            $("#locEleven").attr("disabled", true);
            $("#locTwelve").attr("disabled", true);
            $("#locThirteen").attr("disabled", true);
            $("#locFourteen").attr("disabled", true);
            $("#locFifteen").attr("disabled", true);
            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
        }
    })

    // checkbox to clear 2nd batch initialized input boxes
    $("#clearThird").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initTwo").css("display", "block");
            $("#initThree").css("display", "none");
            $("#addTrioThree").prop("checked", false);

            $("#trioThree").css("display", "none");
            $("#clearThird").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locSeven").attr("disabled", true);
            $("#locEight").attr("disabled", true);
            $("#locNine").attr("disabled", true);
            $("#locTen").attr("disabled", true);
            $("#locEleven").attr("disabled", true);
            $("#locTwelve").attr("disabled", true);
            $("#locThirteen").attr("disabled", true);
            $("#locFourteen").attr("disabled", true);
            $("#locFifteen").attr("disabled", true);
            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
        }
    })

    // checkbox to clear 3rd batch initialized input boxes
    $("#clearFourth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "block");
            $("#initFour").css("display", "none");
            $("#addTrioFour").prop("checked", false);

            $("#trioFour").css("display", "none");
            $("#clearFourth").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locTen").attr("disabled", true);
            $("#locEleven").attr("disabled", true);
            $("#locTwelve").attr("disabled", true);
            $("#locThirteen").attr("disabled", true);
            $("#locFourteen").attr("disabled", true);
            $("#locFifteen").attr("disabled", true);
            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
        }
    })

    // checkbox to clear 4th batch initialized input boxes
    $("#clearFifth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "block");
            $("#initFive").css("display", "none");
            $("#addTrioFive").prop("checked", false);

            $("#trioFive").css("display", "none");
            $("#clearFifth").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locThirteen").attr("disabled", true);
            $("#locFourteen").attr("disabled", true);
            $("#locFifteen").attr("disabled", true);
            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearSixth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "block");
            $("#initSix").css("display", "none");
            $("#addTrioSix").prop("checked", false);

            $("#trioSix").css("display", "none");
            $("#clearSixth").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearSeventh").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "block");
            $("#addTrioSeven").prop("checked", false);

            $("#trioSeven").css("display", "none");
            $("#clearSeventh").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locNineteen").attr("disabled", true);
            $("#locTwenty").attr("disabled", true);
            $("#locTwentyOne").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearEighth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "none");
            $("#initSeventh").css("display", "block");
            $("#addTrioEight").prop("checked", false);

            $("#trioEight").css("display", "none");
            $("#clearEight").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locTwentyTwo").attr("disabled", true);
            $("#locTwentyThree").attr("disabled", true);
            $("#locTwentyFour").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearNinth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "none");
            $("#initSeventh").css("display", "none");
            $("#initEight").css("display", "block");
            $("#addTrioNine").prop("checked", false);

            $("#trioNine").css("display", "none");
            $("#clearNinth").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locTwentyFive").attr("disabled", true);
            $("#locTwentySix").attr("disabled", true);
            $("#locTwentySeven").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearTenth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "none");
            $("#initSeventh").css("display", "none");
            $("#initEight").css("display", "none");
            $("#initNinth").css("display", "block");
            $("#addTrioTen").prop("checked", false);

            $("#trioTen").css("display", "none");
            $("#clearTenth").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locTwentyEight").attr("disabled", true);
            $("#locTwentyNine").attr("disabled", true);
            $("#locThirty").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearEleventh").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "none");
            $("#initSeventh").css("display", "none");
            $("#initEight").css("display", "none");
            $("#initNinth").css("display", "none");
            $("#initTenth").css("display", "block");
            $("#addTrioEleven").prop("checked", false);

            $("#trioEleven").css("display", "none");
            $("#clearEleventh").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locThirtyOne").attr("disabled", true);
            $("#locThirtyTwo").attr("disabled", true);
            $("#locThirtyThree").attr("disabled", true);
        }
    })

    // checkbox to clear 5th batch initialized input boxes
    $("#clearTwelfth").on("change", function () {
        if ($(this).prop("checked")) {

            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "none");
            $("#initSeventh").css("display", "none");
            $("#initEight").css("display", "none");
            $("#initNinth").css("display", "none");
            $("#initTenth").css("display", "none");
            $("#initEleventh").css("display", "block");
            $("#addTrioTwelve").prop("checked", false);

            $("#trioTwelve").css("display", "none");
            $("#clearTwelfth").prop("checked", false);

            $(this).closest('form').find("input[type=text]").val("");

            $("#locThirtyFour").attr("disabled", true);
            $("#locThirtyFive").attr("disabled", true);
            $("#locThirtySix").attr("disabled", true);
        }
    })

    // checkbox to clear sixth batch initialized input boxes
    $("#clearAll").on("change", function () {
        if ($(this).prop("checked")) {
            // clears the first trio
            $("#trioOne").css("display", "block");
            $("#initOne").css("display", "block");

            $("#trioTwo").css("display", "none");
            $("#trioThree").css("display", "none");
            $("#trioFour").css("display", "none");
            $("#trioFive").css("display", "none");
            $("#trioSix").css("display", "none");
            $("#trioSeven").css("display", "none");
            $("#trioEight").css("display", "none");
            $("#trioNine").css("display", "none");
            $("#trioTen").css("display", "none");
            $("#trioEleven").css("display", "none");
            $("#trioTwelve").css("display", "none");
            $("#initTwo").css("display", "none");
            $("#initThree").css("display", "none");
            $("#initFour").css("display", "none");
            $("#initFive").css("display", "none");
            $("#initSix").css("display", "none");
            $("#initSeven").css("display", "none");
            $("#initTwelve").css("display", "none");

            $(this).closest('form').find("input[type=text]").val("");

            $("#locFour").attr("disabled", true);
            $("#locFive").attr("disabled", true);
            $("#locSix").attr("disabled", true);
            $("#locSeven").attr("disabled", true);
            $("#locEight").attr("disabled", true);
            $("#locNine").attr("disabled", true);
            $("#locTen").attr("disabled", true);
            $("#locEleven").attr("disabled", true);
            $("#locTwelve").attr("disabled", true);
            $("#locThirteen").attr("disabled", true);
            $("#locFourteen").attr("disabled", true);
            $("#locFifteen").attr("disabled", true);
            $("#locSixteen").attr("disabled", true);
            $("#locSeventeen").attr("disabled", true);
            $("#locEighteen").attr("disabled", true);
            $("#locNineteen").attr("disabled", true);
            $("#locTwenty").attr("disabled", true);
            $("#locTwentyOne").attr("disabled", true);
            $("#locTwentyTwo").attr("disabled", true);
            $("#locTwentyThree").attr("disabled", true);
            $("#locTwentyFour").attr("disabled", true);
            $("#locTwentyFive").attr("disabled", true);
            $("#locTwentySix").attr("disabled", true);
            $("#locTwentySeven").attr("disabled", true);
            $("#locTwentyEight").attr("disabled", true);
            $("#locTwentyNine").attr("disabled", true);
            $("#locThirty").attr("disabled", true);
            $("#locThirtyOne").attr("disabled", true);
            $("#locThirtyTwo").attr("disabled", true);
            $("#locThirtyThree").attr("disabled", true);
            $("#locThirtyFour").attr("disabled", true);
            $("#locThirtyFive").attr("disabled", true);
            $("#locThirtySix").attr("disabled", true);
        }
    })

    $("#checkAll").on("change", function () {
        if ($(this).prop("checked")) {
            $('input:checkbox').not(this).prop('checked', this.checked);
            // $('input:checkbox').not(this).removeAttr("disabled", true);
        } else {
            $('input:checkbox').not(this).prop('checked', false);
            // $('input:checkbox').not(this).attr("disabled", true);
        }
    })
});