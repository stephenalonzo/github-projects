$(document).ready(function () {

  $("#inputColor").on("input change", function () {
    $("#inputColor").attr("value", $(this).val());
  })

  // This reference remains available to the following functions
  // even when the ID is removed.
  var all_day = $("#all_day");

  $("#allDayT").click(function () {
    all_day.removeAttr("disabled", true);
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  });

  $("#createEvent").click(function () {
    $("#calendarDropdown").addClass("active");
  })

  $("#allDayT").change(function () {
    if ($(this).prop("checked")) {
      $("#allDayF").prop("checked", false);
      $("#defaultDate").hide();
      $("#allDayDate").show();
      $("#allDayStart").removeAttr("disabled", true);
      $("#allDayEnd").removeAttr("disabled", true);
      $("#defaultStart").attr("disabled", true);
      $("#defaultEnd").attr("disabled", true);
      setTimeout(function () {
        $("#result").remove();
      }, 00001);
    } else {
      $("#defaultDate").show();
      $("#allDayDate").hide();
      $("#allDayStart").attr("disabled", true);
      $("#allDayEnd").attr("disabled", true);
      $("#defaultStart").removeAttr("disabled", true);
      $("#defaultEnd").removeAttr("disabled", true);
      setTimeout(function () {
        $("#result").remove();
      }, 00001);
    }
  })

  $("#createBlogPost").change(function () {
    if ($(this).prop("checked")) {
      $("#blogForm").css("display", "block");
    } else {
      $("#blogForm").css("display", "none");
    }
  })

  $("#toggleRFP").click(function () {
    $("#createUser").css("display", "none");
    $("#jobDB").css("display", "none");
    $("#rfpPost").css("display", "block");
    $("#calendarPost").css("display", "none");
    $("#textarea").attr("disabled", true);
    $("#enable_allday").attr("disabled", true);
    $("#all_day").attr("disabled", true);
    $("#defaultStart").attr("disabled", true);
    $("#defaultEnd").attr("disabled", true);
    $("#allDayStart").attr("disabled", true);
    $("#allDayEnd").attr("disabled", true);
    $("#area1").attr("disabled", true);
    $("#rfpTitle").removeAttr("disabled", true);
    $("#rfpType").removeAttr("disabled", true);
    $("#itbType").removeAttr("disabled", true);
    $("#rfpNum").removeAttr("disabled", true);
    $("#file").removeAttr("disabled", true);
    $("#dateQuestions").removeAttr("disabled", true);
    $("#dateRFP").removeAttr("disabled", true);
    $("#uploadSubmit").removeAttr("disabled", true);
    $("#rfpTable").css("display", "none");
    $("#jobPosting").css("display", "none");
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  });

  $("#toggleEvent").click(function () {
    $("#createUser").css("display", "none");
    $("#jobDB").css("display", "none");
    $("#rfpPost").css("display", "none");
    $("#calendarPost").css("display", "block");
    $("#textarea").removeAttr("disabled", true);
    $("#enable_allday").removeAttr("disabled", true);
    $("#all_day").removeAttr("disabled", true);
    $("#defaultStart").removeAttr("disabled", true);
    $("#defaultEnd").removeAttr("disabled", true);
    $("#allDayStart").removeAttr("disabled", true);
    $("#allDayEnd").removeAttr("disabled", true);
    $("#area1").removeAttr("disabled", true);
    $("#rfpTitle").attr("disabled", true);
    $("#rfpType").attr("disabled", true);
    $("#itbType").attr("disabled", true);
    $("#rfpNum").attr("disabled", true);
    $("#file").attr("disabled", true);
    $("#dateQuestions").attr("disabled", true);
    $("#dateRFP").attr("disabled", true);
    $("#uploadSubmit").attr("disabled", true);
    $("#eventDB").css("display", "none");
    $("#calendarDisplay").css("display", "none");
    $("#jobPosting").css("display", "none");
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  });

  $("#toggleJob").click(function () {
    $("#createUser").css("display", "none");
    $("#jobDB").css("display", "none");
    $("#department").removeAttr("disabled", true);
    $("#position").removeAttr("disabled", true);
    $("#opening").removeAttr("disabled", true);
    $("#closing").removeAttr("disabled", true);
    $("#jobDesc").removeAttr("disabled", true);
    $("#post").removeAttr("disabled", true);
    $("#jobPosting").css("display", "block");
    $("#rfpPost").css("display", "none");
    $("#calendarPost").css("display", "none");
    $("#textarea").attr("disabled", true);
    $("#enable_allday").attr("disabled", true);
    $("#all_day").attr("disabled", true);
    $("#defaultStart").removeAttr("disabled", true);
    $("#defaultEnd").attr("disabled", true);
    $("#allDayStart").attr("disabled", true);
    $("#allDayEnd").attr("disabled", true);
    $("#area1").attr("disabled", true);
    $("#rfpTitle").attr("disabled", true);
    $("#rfpType").attr("disabled", true);
    $("#itbType").attr("disabled", true);
    $("#rfpNum").attr("disabled", true);
    $("#file").attr("disabled", true);
    $("#dateQuestions").attr("disabled", true);
    $("#dateRFP").attr("disabled", true);
    $("#uploadSubmit").attr("disabled", true);
    $("#eventDB").css("display", "none");
    $("#calendarDisplay").css("display", "none");
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  });

  $("#toggleEventDB").click(function () {
    $("#createUser").css("display", "none");
    $("#jobDB").css("display", "none");
    $("#eventDB").css("display", "block");
    $("#calendarPost").css("display", "none");
    $("#calendarDisplay").css("display", "none");
    $("#jobPosting").css("display", "none");
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  })

  $("#toggleRFPDB").click(function () {
    $("#createUser").css("display", "none");
    $("#jobDB").css("display", "none");
    $("#rfpTable").css("display", "block");
    $("#rfpPost").css("display", "none");
    $("#jobPosting").css("display", "none");
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  })

  $("#toggleCalendar").click(function () {
    $("#createUser").css("display", "none");
    $("#jobDB").css("display", "none");
    $("#calendarDisplay").css("display", "block");
    $("#calendarPost").css("display", "none");
    $("#eventDB").css("display", "none");
    $("#jobPosting").css("display", "none");
    setTimeout(function () {
      $("#result").remove();
    }, 00001);
  })

  $("#toggleUsers").click(function () {
    $("#createUser").css("display", "none");
    $("#usersDB").css("display", "block");
  })

  $("#toggleJobDB").click(function () {
    $("#createUser").css("display", "none");
    $("#jobPosting").css("display", "none");
    $("#jobDB").css("display", "block");
  })

  $("#toggleUserCreation").click(function () {
    $("#createUser").css("display", "block");
    $("#jobDB").css("display", "none");
    $("#rfpPost").css("display", "none");
    $("#calendarPost").css("display", "none");
    $("#textarea").attr("disabled", true);
    $("#enable_allday").attr("disabled", true);
    $("#all_day").attr("disabled", true);
    $("#defaultStart").attr("disabled", true);
    $("#defaultEnd").attr("disabled", true);
    $("#allDayStart").attr("disabled", true);
    $("#allDayEnd").attr("disabled", true);
    $("#area1").attr("disabled", true);
    $("#rfpTitle").attr("disabled", true);
    $("#rfpType").attr("disabled", true);
    $("#itbType").attr("disabled", true);
    $("#rfpNum").attr("disabled", true);
    $("#file").attr("disabled", true);
    $("#dateQuestions").attr("disabled", true);
    $("#dateRFP").attr("disabled", true);
    $("#uploadSubmit").attr("disabled", true);
    $("#eventDB").css("display", "none");
    $("#calendarDisplay").css("display", "none");
    $("#jobPosting").css("display", "none");
  })

  var text_max = 60;
  $('#textarea_feedback').html(text_max + ' characters remaining');

  $('#textarea').keyup(function () {
    var text_length = $('#textarea').val().length;
    var text_remaining = text_max - text_length;

    if (text_remaining == 0) {

      $('#textarea_feedback').html('<span style="color: red;">Reached maximum characters allowed</span>');

    } else {

      $('#textarea_feedback').html(text_remaining + ' characters remaining');

    }
  });

  var originalLeave = $.fn.tooltip.Constructor.prototype.leave;
  $.fn.tooltip.Constructor.prototype.leave = function (obj) {
    var self = obj instanceof this.constructor ?
      obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type)
    var container, timeout;

    originalLeave.call(this, obj);

    if (obj.currentTarget) {
      container = $(obj.currentTarget).siblings('.tooltip')
      timeout = self.timeout;
      container.one('mouseenter', function () {
        clearTimeout(timeout);
        container.one('mouseleave', function () {
          $.fn.tooltip.Constructor.prototype.leave.call(self, self);
        });
      })
    }
  };
});