// $(window).resize(function () {
//   if (window.innerWidth < 576) {
//     $('#calendar').fullCalendar('changeView', 'listMonth');
//   } else {
//     $('#calendar').fullCalendar('changeView', 'month');
//   }
// });

$(document).ready(function () {
  $('input[class=event_filter_box]').change(function () {
    $('#calendar').fullCalendar('rerenderEvents');
  });

  var options = {
    events: 'load.php',
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaDay,agendaWeek,month'
    },
    // eventBackgroundColor: 'transparent',
    // eventBorderColor: '#08c',
    eventTextColor: 'black',
    height: 'auto',
    defaultView: 'agendaWeek',
    allDaySlot: false,
    eventClick: function(event) {
      if (event.url) {
        window.open(event.url);
        return false;
      }
    },
    // editable: false,
    eventRender: function eventRender(event, element, view) {
      // $(element).tooltip({
      //   title: event.description,
      // });
      var display = true;
      var status = [];
      var pavilion = [];
      // Find all checkbox that are event filters that are enabled
      // and save the values.
      $("input[name='event_filter_select']:checked").each(function () {
        // I specified data-type attribute in above HTML to differentiate
        // between locations and kinds of events.

        // Saving each type separately
        if ($(this).data('type') == 'status') {
          status.push($(this).val());
        } else if ($(this).data('type') == 'pavilion') {
          pavilion.push($(this).val());
        }

      });

      // If there are locations to check
      if (pavilion.length) {
        display = display && pavilion.indexOf(event.title) >= 0;
      }

      // If there are specific types of events
      if (status.length) {
        display = display && status.indexOf(event.status) >= 0;
      }

      return display;
    }
};

var $fc = $("#calendar").fullCalendar(options);

function recreateFC(screenWidth) {
    if (screenWidth < 576) {
        options.header = {
            left: 'prev,next today',
            center: 'title',
            right: ''
        };
        options.defaultView = 'listMonth';
    } else {
        options.header = {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaDay,agendaWeek,month'
        };
        options.defaultView = 'month';
    }
    $fc.fullCalendar('destroy');
    $fc.fullCalendar(options);
}

$(window).resize(function () {
    recreateFC($(window).width());
});

recreateFC($(window).width());

});