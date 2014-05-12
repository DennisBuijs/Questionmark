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

  var temp_question_id = 1;
  var temp_option_id = 1;

  $(".enquete-container .enquete-element").each(function() {
    $(this).attr("data-temp-id", temp_question_id);
    $(this).find(".add-option").attr("data-option-add-id", temp_question_id);
    temp_question_id++;
  });

  $(".input-group").each(function() {
    $(this).attr("data-option-temp-id", temp_option_id);
    $(this).find(".delete-option").attr("data-option-delete-id", temp_option_id);
    temp_option_id++;
  });

  $(".add-option").on("click", function() {
    var add_id = $(this).attr("data-option-add-id");
    $(".enquete-element[data-temp-id="+add_id+"] .option-group").append("<div class=\"input-group\" data-option-temp-id=\""+temp_option_id+"\"><input class=\"form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default delete-option\" type=\"button\" data-option-delete-id=\""+temp_option_id+"\">&times;</button></span></div>");
    temp_option_id++;
  });

  $(".enquete-container").on("click", ".delete-option", function() {
    var delete_id = $(this).attr("data-option-delete-id");
    $(".input-group[data-option-temp-id="+delete_id+"]").remove();
  });

  // $(".enquete-container, .enquete-container *").on("focus, click", ".enquete-element", function(e) {
  //   $(".enquete-container *").blur();
  //   $("input, select, select *").blur();
  //   e.preventDefault();
  // });

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

  /**
   * Link dat formulier submit.
   * '.run-form' is class van de link die een bepaald formulier moet submitten
   * '$(this).attr("data-action")' is een class van het formulier wat gesubmit moet worden door de link
   */
  $(".run-form").on("click", function(e) {
    $("." + $(this).attr("data-action")).submit();
    e.preventDefault();
  });














$(".enquete-save").on("click", function() {
  
  /* THE LOOP */

enquete = {};

var url = window.location.href;
var id = url.split("/");
var id = id[id.length-1];
enquete["id"] = id;
enquete["name"] = $(".enquete-title").val();
enquete["introduction"] = $(".enquete-introduction").val();

enquete["questions"] = {};
enquete["deleted_question"] = {};
enquete["deleted_attributes"] = {};

var current_question = 0;
var current_attribute = 0;

$(".enquete-container .enquete-element").each(function() {

  enquete["questions"][current_question] = {};
  enquete["questions"][current_question]["id"] = $(this).attr("data-id");
  enquete["questions"][current_question]["question"] = $(this).find(".panel-heading .question-label").val();
  enquete["questions"][current_question]["order"] = current_question+1;
  enquete["questions"][current_question]["type"] = $(this).attr("data-type");
  enquete["questions"][current_question]["required"] = $(this).attr("data-required");

  enquete["questions"][current_question]["attributes"] = {};

  enquete["questions"][current_question]["attributes"][current_attribute] = {}
  enquete["questions"][current_question]["attributes"][current_attribute]["id"] = $(this).attr("data-placeholder-id")
  enquete["questions"][current_question]["attributes"][current_attribute]["type"] = "placeholder";
  enquete["questions"][current_question]["attributes"][current_attribute]["attribute"] = $(this).attr("data-placeholder");

  $(this).find(".input-group").each(function() {
    enquete["questions"][current_question]["attributes"][current_attribute] = {}
    enquete["questions"][current_question]["attributes"][current_attribute]["id"] = $(this).attr("data-attribute-id");
    enquete["questions"][current_question]["attributes"][current_attribute]["type"] = "option";
    enquete["questions"][current_question]["attributes"][current_attribute]["attribute"] = $(this).find("input").val();

    current_attribute++;
  });

  current_question++;

});

  json = JSON.stringify(enquete);

  $.ajax({
    type: "POST",
    url: "http://localhost:8888/Questionmark/enquete/run",
    data: { type: "edit", json: json }
  })
  // .done(function( msg ) {
  //   $("body").append("<pre style=\"margin-top: 100px; clear:both; position:absolute; z-index:2000;\">"+msg+"</pre>");
  // });
});








});