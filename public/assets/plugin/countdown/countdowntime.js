(function ($) {
    "use strict";

    $.fn.extend({

      countdown100: function(options) {
        var defaults = {
          timeZone: "",
          timeZone2: "",
          endtimeYear: 0,
          endtimeMonth: 0,
          endtimeDate: 0,
          endtimeHours: 0,
          endtimeMinutes: 0,
          endtimeSeconds: 0,
          fullEndDateTime: new Date(),
          reloadPage: false
        }
        var options =  $.extend(defaults, options);

        return this.each(function() {
          var obj = $(this);
          var timeNow = new Date();

          var tZ = options.timeZone; //console.log(tZ);
          var tZ2 = options.timeZone2;
          var endYear = options.endtimeYear;
          var endMonth = options.endtimeMonth;
          var endDate = options.endtimeDate;
          var endHours = options.endtimeHours;
          var endMinutes = options.endtimeMinutes;
          var endSeconds = options.endtimeSeconds;
          var fullEndDateTime = options.fullEndDateTime;
          var reloadPage = options.reloadPage;

          if(fullEndDateTime == ''){
            if(tZ == "") {
              var deadline = new Date(endYear, endMonth - 1, endDate, endHours, endMinutes, endSeconds);
            }else {
              var deadline = moment.tz(new Date(endYear, endMonth - 1, endDate, endHours, endMinutes, endSeconds), tZ).format();
            }
            if(Date.parse(deadline) < Date.parse(timeNow)) {
              var deadline = new Date(Date.parse(new Date()) + endDate * 24 * 60 * 60 * 1000 + endHours * 60 * 60 * 1000);
            }
          }else{

            if(tZ2 != "") {
             // var deadline = moment.tz(fullEndDateTime, tZ2).format();
              var deadline = fullEndDateTime;
               // alert(fullEndDateTime);
            }else if(tZ == ""){
              var deadline = new Date(fullEndDateTime);
            }else {
              var deadline = moment.tz(new Date(fullEndDateTime), tZ).format();
            }
          }

          initializeClock(deadline, reloadPage);

          function getTimeRemaining(endtime) {
            if(tZ2 == ""){
              var t = Date.parse(endtime) - Date.parse(new Date());
            }else{
              var current = moment.tz(new Date(), tZ2).format();
              var t = Date.parse(endtime) - Date.parse(current);
            }

            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
              'total': t,
              'days': days,
              'hours': hours,
              'minutes': minutes,
              'seconds': seconds
            };
          }

          function initializeClock(endtime, reloadPage) {
            var daysSpan = $(obj).find('.days');
            var hoursSpan = $(obj).find('.hours');
            var minutesSpan = $(obj).find('.minutes');
            var secondsSpan = $(obj).find('.seconds');

            function updateClock() {
              var t = getTimeRemaining(endtime);

              daysSpan.html(t.days);
              hoursSpan.html(('0' + t.hours).slice(-2));
              minutesSpan.html(('0' + t.minutes).slice(-2));
              secondsSpan.html(('0' + t.seconds).slice(-2))

              if (t.total <= 0) {
                clearInterval(timeinterval);
                if(reloadPage == true){
                  window.location.reload();
                }
              }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
          }

        });
      }
    });

})(jQuery);
