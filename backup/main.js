// TODO //
// input[type]

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
    var option_temp_id = 1;
    $(this).attr("onclick", "show_edit_question_modal("+temp_id+")");
    $(this).attr("data-temp-id", temp_id);
    $(this).find("select option, input[type=\"radio\"]").each(function() {
      $(this).attr("data-qid", temp_id);
      $(this).attr("data-temp-option-id", option_temp_id);
      option_temp_id = option_temp_id+1;
    });
    temp_id = temp_id+1;
  });

  $(".enquete-container, .enquete-container *").on("focus, click", ".enquete-element", function(e) {
    $(".enquete-container *").blur();
    $("input, select, select *").blur();
    e.preventDefault();
  });

  // Options arrays
  var options_delete_array = []; // send to json
  var options_delete_temp_array = []; // delete from frontend
  var options_add_array = []; // send to json
  var options_add_temp_array = []; // delete from frontend

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
        $(".modal-body").append(placeholder_html);
        $(".modal-body").append(required_html);
        break;
      case "radio":
        $(".modal-body").append(question_html);
        $(".modal-body").append(required_html);
        $(".modal-body").append("<div class=\"form-group options-group\"><strong>Opties</strong><br>");
        $("[data-qid="+id+"]").each(function() {
          var temp_option_id = $(this).attr("data-temp-option-id");
          $(".modal-body .options-group").append("<div class=\"input-group question-options-edit\" data-option-id=\"\"><input class=\"form-control\" value=\""+$(this).text()+"\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" id=\"delete-option\" type=\"button\" data-delete-option-id=\""+temp_option_id+"\">&times;</button></span></div></div>");
        });
        $(".modal-body").append("<input class=\"btn btn-primary\" id=\"add-option\" type=\"button\" value=\"Toevoegen\">")
        break;
      case "select":
        $(".modal-body").append(question_html);
        $(".modal-body").append(required_html);
        $(".modal-body").append("<div class=\"form-group options-group\"><strong>Opties</strong><br>");
        $("[data-qid="+id+"]").each(function() {
          var temp_option_id = $(this).attr("data-temp-option-id");
          $(".modal-body .options-group").append("<div class=\"input-group question-options-edit\" data-option-id=\""+qid+"\"><input class=\"form-control\" value=\""+$(this).text()+"\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" id=\"delete-option\" type=\"button\" data-delete-option-id=\""+temp_option_id+"\">&times;</button></span></div></div>");
        });
        $(".modal-body").append("<input class=\"btn btn-primary\" id=\"add-option\" type=\"button\" value=\"Toevoegen\">")
        break;
    }

    $(".modal-body").on("click", "#delete-option", function() {
      $(this).parent().parent().remove();
      options_delete_temp_array.push($(this).attr("data-delete-option-id"));
    });

  }

  $(".modal-body").on("click", "#add-option", function() {
    $(".modal-body .options-group").append("<div class=\"input-group question-options-edit\" data-option-id=\""+$("[data-temp-id="+id+"]")+"\"><input class=\"form-control\" value=\""+$(this).text()+"\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" id=\"delete-option\" type=\"button\">&times;</button></span></div></div>");
  });

  $("#save-question-modal").on("click", function() {
    var id = $("#edit-question-modal").attr("data-id");
    $("[data-temp-id="+id+"]").attr("data-question", $("#edit-question-question").val());
    $("[data-temp-id="+id+"]").attr("data-placeholder", $("#edit-question-placeholder").val());
    $("[data-temp-id="+id+"]").find("input, textarea").attr("placeholder", $("#edit-question-placeholder").val());
    // $("[data-temp-id="+id+"]").attr("data-type", $("#edit-question-type").val());
    // $("[data-temp-id="+id+"]").find("input[type='text'], input[type='mail]', input[type='number'], input[type='url']").attr("type", $("#edit-question-type").val());

    if($("#edit-question-required").is(':checked')) {
      $("[data-temp-id="+id+"]").attr("data-required", 1);
    } else {
      $("[data-temp-id="+id+"]").attr("data-required", 0);
    }

    $("[data-temp-id="+id+"]").find("label").text($("#edit-question-question").val());

    for(var i=0; i<options_delete_temp_array.length; i++) {
      options_delete_array.push(options_delete_temp_array[i]);
      $("[data-temp-id="+id+"]").find("[data-temp-option-id="+options_delete_temp_array[i]+"]").remove();
    }

    var options_to_add = 0;
    $(".options-group .question-options-edit").each(function() {
      options_add_temp_array[options_to_add] = [];
      options_add_temp_array[options_to_add]['id'] = $(this).find("select option").attr("data-option-id");
      options_add_temp_array[options_to_add]['type'] = "option";
      options_add_temp_array[options_to_add]['value'] = $(this).find("input").val();
      console.log($(this).find("select option").attr("data-option-id"));
      options_to_add++;
    });

    $("[data-temp-id="+id+"]").find("select").empty();
    for(var i=0; i<options_add_temp_array.length; i++) {
      $("[data-temp-id="+id+"]").find("select").append("<option data-option-id=\""+options_add_temp_array[i]['id']+"\">"+options_add_temp_array[i]['value']+"</option>")
    }

  });

  $("#edit-question-modal [data-dismiss]").on("click", function() {
    options_add_temp_array = [];
    options_delete_temp_array = [];
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















  /**
   * Link dat formulier submit.
   * '.run-form' is class van de link die een bepaald formulier moet submitten
   * '$(this).attr("data-action")' is een class van het formulier wat gesubmit moet worden door de link
   */
  $(".run-form").on("click", function(e) {
    $("." + $(this).attr("data-action")).submit();
    e.preventDefault();
  });
});