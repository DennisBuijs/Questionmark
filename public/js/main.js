$(document).ready(function() {

  // This function shows an alert
  // type: the type of alert, has the be one of: succes, info, warning, danger
  // message: the message the alert will say
  show_alert = function(type, message) {

    $(".alert-fixed-top").remove();
    $("body").prepend("<div class=\"alert alert-" + type + " alert-dismissable alert-fixed-top\"><button type=\"button\" class=\"close close-alert-fixed-top\" aria-hidden=\"true\">&times;</button>" + message + "</div>");
    $(".alert-fixed-top").slideDown();

    $(".close-alert-fixed-top").on("click", function() {

      $(".alert-fixed-top").slideUp();

    });

  }

  $('form').on('submit', function() {
    var iNumOfInvalidValues = 0;
    $('[data-required=required]').each(function() {
      var $this = $(this);

      if (this.value === '') {
        $this.parent().addClass('has-error');

        iNumOfInvalidValues++;

      }
      else if ($this.hasClass('invalid-value')) {
        $this.removeClass('invalid-value');
        $('+ div', this).remove();
      }
    });

    if (iNumOfInvalidValues !== 0)

      show_alert("danger", "De logingegevens zijn niet correct.");
      return false;

  });



});