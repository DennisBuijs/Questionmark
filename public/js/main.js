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
      //show_alert("danger", "De logingegevens zijn niet correct.");
    return false;

  });

  // Functionaliteit voor het slepen van formulierelementen naar het formulier
  $(".enquete-elements .enquete-element").draggable({
      connectToSortable: ".enquete-container",
      revert: "invalid",
      ghosting: true, 
      appendTo: document.body,
      helper: function(e, ui) {
        return $(this).clone().css('width', $(".enquete-container").width()-40);
      }
  });
  $(".enquete-container").droppable().sortable({
    placeholder: "drop-placeholder",
    start: function (event, ui) {
      ui.placeholder.height(ui.helper.height());
    }
  });
  $(".enquete-element").disableSelection();

  $(".enquete-container, .enquete-container *").on("focus, click", ".enquete-element", function(e) {
    $(".enquete-container *").blur();
    $("input, select, select *").blur();
    e.preventDefault();
  });

  show_edit_question_modal = function(id) {
    $("#edit-question-modal").modal();
    $(".modal-body").empty();

    var question = $("[data-temp-id="+id+"]").attr("data-question");
    var type = $("[data-temp-id="+id+"]").attr("data-type");
    var placeholder = $("[data-temp-id="+id+"]").attr("data-placeholder");
    var required = $("[data-temp-id="+id+"]").attr("data-required");
    var input_type = $("[data-temp-id="+id+"]").attr("data-input-type");

    console.log(required);

    var question_html = "<div class=\"form-group\"><label>Vraag</label><input class=\"form-control\" type=\"text\" value=\""+question+"\"></div>";
    var input_type_html = "<div class=\"form-group\"><label>Soort veld</label><select class=\"form-control\"><option>Tekst</option><option>URL</option><option>Mail</option><option>Number</option></select></div>";
    var placeholder_html = "<div class=\"form-group\"><label>Placeholder</label><input class=\"form-control\" type=\"text\" value=\""+placeholder+"\"></div>";
    if(required == 1) {
      var required_html = "<div class=\"form-group\"><input type=\"checkbox\" checked=\"checked\"> Required</div>";
    } else {
      var required_html = "<div class=\"form-group\"><input type=\"checkbox\"> Required</div>";
    }

    switch(type) {
      case "textfield":
        $(".modal-body").append(question_html);
        $(".modal-body").append(input_type_html);
        $(".modal-body").append(placeholder_html);
        $(".modal-body").append("<div class=\"form-group\"><input type=\"checkbox\"> Required</div>");
        break;
      case "textarea":
        $(".modal-body").append("<div class=\"form-group\"><label>Vraag</label><input class=\"form-control\" type=\"text\" value=\""+question+"\"></div>");
        $(".modal-body").append("<div class=\"form-group\"><label>Placeholder</label><input class=\"form-control\" type=\"text\" value=\""+placeholder+"\"></div>");
        $(".modal-body").append("<div class=\"form-group\"><input type=\"checkbox\"> Required</div>");
        break;
    }

  }

});