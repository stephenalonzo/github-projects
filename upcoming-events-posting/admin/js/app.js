$(document).ready(function () {
  $("#keyword").on("change", function () {
    $("#calendar").fullCalendar("rerenderEvents");
  });
  $("#filterEvent").on("change", function () {
    $("#calendar").fullCalendar("rerenderEvents");
  });
  var calendar = $("#calendar").fullCalendar({
    displayEventTime: false,
    editable: false,
    header: {
      left: "prev,next today",
      center: "title",
      right: "listMonth, month,agendaWeek,agendaDay",
    },
    eventRender: function (event, element, view) {
      $(element).tooltip({
        title: event.description,
      });
      return (
        event.category.indexOf($("#filterEvent").val()) >= 0 && event.keywords.indexOf($("#keyword").val()) >= 0 ||
        event.title.indexOf($("#keyword").val()) >= 0 || event.keywords.indexOf($("#keyword").val()) >= 0 || event.category.indexOf($("#filterEvent").val()) >= 0
      );
    },
    events: "load.php",
  });
});