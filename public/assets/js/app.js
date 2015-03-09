/*jslint browser: true*/
/*jslint plusplus: true */
/*global $, jQuery, alert, google, init */

$(function () {
  "use strict";
  /* **************************** */
  /*  Smooth scrolling to anchor  */
  /* **************************** */


  $('a[href*=#]:not([href=#])').click(function () {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
      var target = $(this.hash),
        targetOffset = target.offset().top;

      // Change URL if possible
      if (history.pushState) {
        history.pushState(null, null, this.hash);
      }

      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          //scrollTop: target.offset().top
          scrollTop: targetOffset - 40
        }, 500);
        return false;
      }
    }
  });
});

/*
 * Skryjeme flash zprávy po nějaké době
 */

window.setTimeout(function () {
  "use strict";
  $(".flash").fadeTo(500, 0).slideUp(500, function () {
    $(this).remove();
  });
}, 5000);

