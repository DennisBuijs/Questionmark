$(document).ready(function() {

  $('form').on('submit', function() {
    var iNumOfInvalidValues = 0;
    $('[required=required]').each(function() {
      var $this = $(this);

      if (this.value === '') {
        if (!$this.hasClass('invalid-value')) {
          $this.after('<p>' + $this.attr('placeholder') + ' is verplicht</p>');
        }
        $this.addClass('invalid-value');

        iNumOfInvalidValues++;

      }
      else if ($this.hasClass('invalid-value')) {
        $this.removeClass('invalid-value');
        $('+ p', this).remove();
      }
    });

    if (iNumOfInvalidValues !== 0)
      return false;
  });



});