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

  var temp_id = 1;

  $(".enquete-container .enquete-element").each(function() {
    $(this).attr("onclick", "show_edit_question_modal("+temp_id+")");
    $(this).find("input, textarea, select").attr("data-temp-id", temp_id);
    temp_id = temp_id+1;
  });

  $(".enquete-container, .enquete-container *").on("focus, click", ".enquete-element", function(e) {
    $(".enquete-container *").blur();
    $("input, select, select *").blur();
    e.preventDefault();
  });

  show_edit_question_modal = function(id) {
    $("#edit-question-modal").modal();
    $("#edit-question-modal").attr("data-id", id);
    $(".modal-body").empty();

    var question = $("[data-temp-id="+id+"]").attr("data-question");
    var type = $("[data-temp-id="+id+"]").attr("data-type");
    var placeholder = $("[data-temp-id="+id+"]").attr("data-placeholder");
    var required = $("[data-temp-id="+id+"]").attr("data-required");
    var input_type = $("[data-temp-id="+id+"]").attr("data-input-type");

    var question_html = "<div class=\"form-group\"><label>Vraag</label><input class=\"form-control\" id=\"edit-question-question\" type=\"text\" value=\""+question+"\"></div>";
    var input_type_html = "<div class=\"form-group\"><label>Soort veld</label><select class=\"form-control\" id=\"edit-question-input-type\"><option>Tekst</option><option>URL</option><option>Mail</option><option>Nummer</option></select></div>";
    var placeholder_html = "<div class=\"form-group\"><label>Placeholder</label><input class=\"form-control\" id=\"edit-question-placeholder\" type=\"text\" value=\""+placeholder+"\"></div>";
    if(required == 1) {
      var required_html = "<div class=\"form-group\"><input type=\"checkbox\" id=\"edit-question-required\" checked> Required</div>";
    } else {
      var required_html = "<div class=\"form-group\"><input type=\"checkbox\" id=\"edit-question-required\"> Required</div>";
    }

    switch(type) {
      case "textfield":
        $(".modal-body").append(question_html);
        $(".modal-body").append(input_type_html);
        $(".modal-body").append(placeholder_html);
        $(".modal-body").append(required_html);
        break;
      case "textarea":
        $(".modal-body").append(question_html);
        $(".modal-body").append(input_type_html);
        $(".modal-body").append(placeholder_html);
        $(".modal-body").append(required_html);
        break;
      case "select":
        $(".modal-body").append(question_html);
        $(".modal-body").append(required_html);
        break;
    }

  }

  $("#save-question-modal").on("click", function() {
    var id = $("#edit-question-modal").attr("data-id");
    $("[data-temp-id="+id+"]").attr("data-question", $("#edit-question-question").val());
    $("[data-temp-id="+id+"]").attr("data-placeholder", $("#edit-question-placeholder").val());
    $("[data-temp-id="+id+"]").attr("placeholder", $("#edit-question-placeholder").val());
    $("[data-temp-id="+id+"]").attr("data-question", $("#edit-question-question").val());

    if($("#edit-question-required").is(':checked')) {
      console.log("checked");
      $("[data-temp-id="+id+"]").attr("data-required", 1);
    } else {
      console.log("niet checked, yo");
      $("[data-temp-id="+id+"]").attr("data-required", 0);
    }

    $("[data-temp-id="+id+"]").parent().find("label").text($("#edit-question-question").val());
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
  }).attr("data-temp-id", temp_id);
  $(".enquete-element").disableSelection();

});