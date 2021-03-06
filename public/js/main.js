$(document).ready(function() {

    enquete = {};
    enquete["questions"] = {};
    enquete["deleted_question"] = [];
    enquete["deleted_attributes"] = [];


    /**
      * FORM VALIDATION
      * Fields with data-required="required" can not be empty
      */
    $('form').on('submit', function() {

        var number_of_invalid_fields = 0;

        $('[data-required=required], [data-required=1]').each(function() {

            var $parent_of_input = $(this);
            var $input = $(this).find('input').not('[type=hidden]');

            if ($input.length > 1) {

                var is_checked;
                $input.each(function() {
                    if (this.checked)
                        is_checked = true;
                });

                if (!is_checked) {

                    $parent_of_input.addClass('has-error');
                    number_of_invalid_fields++;

                } else {
                    if ($parent_of_input.hasClass('has-error')) {
                        $parent_of_input.removeClass('has-error');
                    }
                }
            } else {

                if ($input.val() === '') {
                    $parent_of_input.addClass('has-error');
                    number_of_invalid_fields++;
                } else if ($parent_of_input.hasClass('has-error')) {
                    $parent_of_input.removeClass('has-error');
                }

            }

        });

        if (number_of_invalid_fields !== 0) {
            return false;
        }

    });


    /**
       * 
       * @type Number
       */
    var temp_question_id = 1;
    var temp_option_id = 1;

    $(".enquete-container .enquete-element").each(function() {
        $(this).attr("data-temp-id", temp_question_id);
        $(this).find(".delete-question").attr("data-question-delete-id", temp_question_id);
        $(this).find(".add-option").attr("data-option-add-id", temp_question_id);
        temp_question_id++;
    });

    $(".input-group").each(function() {
        $(this).attr("data-option-temp-id", temp_option_id);
        $(this).find(".delete-option").attr("data-option-delete-id", temp_option_id);
        temp_option_id++;
    });

    $(".enquete-container").on("click", ".delete-question", function() {
        var delete_id = $(this).parent().parent().parent().parent().attr("data-id"); // GOEDE ID
        if (delete_id != null) {
            enquete["deleted_question"].push(delete_id);
        }

        var delete_temp_id = $(this).attr("data-question-delete-id");
        $(".panel[data-temp-id=" + delete_temp_id + "]").remove();
    });

    $(".enquete-container").on("click", ".add-option", function() {
        var add_id = $(this).attr("data-option-add-id");
        $(".enquete-element[data-temp-id=" + add_id + "] .option-group").append("<div class=\"input-group\" data-option-temp-id=\"" + temp_option_id + "\"><input class=\"form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default delete-option\" type=\"button\" data-option-delete-id=\"" + temp_option_id + "\">&times;</button></span></div>");
        temp_option_id++;
    });

    $(".enquete-container").on("click", ".delete-option", function() {
        var delete_id = $(this).parent().parent().attr("data-attribute-id");
        if (delete_id != null) {
            enquete["deleted_attributes"].push(delete_id);
        }

        var delete_temp_id = $(this).attr("data-option-delete-id");
        $(".input-group[data-option-temp-id=" + delete_temp_id + "]").remove();
    });

    // HTML for new questions
    question_html = [];
    question_html["textfield"] = "<div class=\"panel panel-default enquete-element\" style=\"height:209px\" data-type=\"textfield\" placeholder=\"\"><div class=\"panel-heading\"><input class=\"question-label\"></div><div class=\"panel-body\"><div class=\"form-group\"><label for=\"\">Plaatshouder</label><input class=\"form-control question-placeholder\"></div><div class=\"form-group col-md-6\"><label for=\"\">Verplicht</label><br><input class=\"question-required-checkbox\" type=\"checkbox\"> Verplicht</div><div class=\"col-md-6\"><div class=\"form-group\"><button class=\"btn btn-primary btn-sm pull-right delete-question\">&times;</button></div></div></div>";
    question_html["textarea"] = "<div class=\"panel panel-default enquete-element\" style=\"height:209px\" data-type=\"textarea\" placeholder=\"\"><div class=\"panel-heading\"><input class=\"question-label\"></div><div class=\"panel-body\"><div class=\"form-group\"><label for=\"\">Plaatshouder</label><input class=\"form-control question-placeholder\"></div><div class=\"form-group col-md-6\"><label for=\"\">Verplicht</label><br><input class=\"question-required-checkbox\" type=\"checkbox\"> Verplicht</div><div class=\"col-md-6\"><div class=\"form-group\"><button class=\"btn btn-primary btn-sm pull-right delete-question\">&times;</button></div></div></div>";
    question_html["checkbox"] = "<div class=\"panel panel-default enquete-element\" style=\"min-height:224px\" data-type=\"checkbox\"> <div class=\"panel-heading\"> <input class=\"question-label\"> </div> <div class=\"panel-body\"> <div class=\"option-group\"> </div> <button class=\"btn btn-default add-option\">Optie toevoegen</button> <hr> <div class=\"question-meta\"> <div class=\"form-group col-md-6\"> <label for=\"\">Type veld</label><br> <select class=\"form-control question-multiplechoice-type\"> <option value=\"checkbox\" selected>Checkbox</option> <option value=\"radio\">Keuzerondje</option> <option value=\"select\">Selectieveld</option> </select> </div> <div class=\"form-group col-md-3\"> <label for=\"\">Verplicht</label><br> <input class=\"question-required-checkbox\" type=\"checkbox\"> Verplicht </div><div class=\"col-md-3\"><button class=\"btn btn-primary btn-sm pull-right delete-question\">&times;</button></div></div> </div> </div> </div>";
    question_html["radio"] = "<div class=\"panel panel-default enquete-element\" style=\"min-height:224px\" data-type=\"radio\"> <div class=\"panel-heading\"> <input class=\"question-label\"> </div> <div class=\"panel-body\"> <div class=\"option-group\"> </div> <button class=\"btn btn-default add-option\">Optie toevoegen</button> <hr> <div class=\"question-meta\"> <div class=\"form-group col-md-6\"> <label for=\"\">Type veld</label><br> <select class=\"form-control question-multiplechoice-type\"> <option value=\"checkbox\">Checkbox</option> <option value=\"radio\" selected>Keuzerondje</option> <option value=\"select\">Selectieveld</option> </select> </div> <div class=\"form-group col-md-3\"> <label for=\"\">Verplicht</label><br> <input class=\"question-required-checkbox\" type=\"checkbox\"> Verplicht </div> <div class=\"col-md-3\"><button class=\"btn btn-primary btn-sm pull-right delete-question\">&times;</button></div></div> </div> </div>";
    question_html["select"] = "<div class=\"panel panel-default enquete-element\" style=\"min-height:224px\" data-type=\"select\"> <div class=\"panel-heading\"> <input class=\"question-label\"> </div> <div class=\"panel-body\"> <div class=\"option-group\"> </div> <button class=\"btn btn-default add-option\">Optie toevoegen</button> <hr> <div class=\"question-meta\"> <div class=\"form-group col-md-6\"> <label for=\"\">Type veld</label><br> <select class=\"form-control question-multiplechoice-type\"> <option value=\"checkbox\">Checkbox</option> <option value=\"radio\">Keuzerondje</option> <option value=\"select\" selected>Selectieveld</option> </select> </div> <div class=\"form-group col-md-3\"> <label for=\"\">Verplicht</label><br> <input class=\"question-required-checkbox\" type=\"checkbox\"> Verplicht </div> <div class=\"col-md-3\"><button class=\"btn btn-primary btn-sm pull-right delete-question\">&times;</button></div></div> </div> </div>";

    // Dragging new questions into .enquete-container
    $(".enquete-elements .enquete-new-question").draggable({
        connectToSortable: ".enquete-container",
        revert: "invalid",
        appendTo: document.body,
        helper: function(e, ui) {
            new_question_type = $(this).attr("data-add-type");
            return question_html[new_question_type];
        }
    });
    $(".enquete-container").droppable().sortable({
        tolerance: "pointer",
        placeholder: "drop-placeholder",
        receive: function(event, ui) {
            $(".enquete-container .enquete-new-question").empty().html(question_html[new_question_type]);
            $(".enquete-container .enquete-new-question").find(".panel").attr("data-temp-id", temp_question_id);
            $(".enquete-container .enquete-new-question").find(".panel").find(".add-option").attr("data-option-add-id", temp_question_id);
            $(".enquete-container .enquete-new-question").find(".panel").find(".delete-question").attr("data-question-delete-id", temp_question_id);
            $(".enquete-container .enquete-new-question").removeClass("enquete-element");
            $(".enquete-container .enquete-new-question").removeClass("enquete-new-question");
            temp_question_id++;
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

        var url = window.location.href;
        var id = url.split("/");
        var id = id[id.length-1];
        enquete["id"] = id;
        enquete["name"] = $(".enquete-title").val();
        enquete["introduction"] = $(".enquete-introduction").val();
        enquete["start_date"] = $(".enquete-startdate").val();
        enquete["end_date"] = $(".enquete-enddate").val();

        var current_question = 0;
        var current_attribute = 0;

        $(".enquete-container .enquete-element").each(function() {

            enquete["questions"][current_question] = {};
            enquete["questions"][current_question]["id"] = $(this).attr("data-id");
            enquete["questions"][current_question]["question"] = $(this).find(".panel-heading .question-label").val();
            enquete["questions"][current_question]["order"] = current_question + 1;

            if ($(this).attr("data-type") == "textfield" || $(this).attr("data-type") == "textarea") {
                enquete["questions"][current_question]["type"] = $(this).attr("data-type");
            } else {
                console.log($(this).find(".question-multiplechoice-type:selected").val());
                enquete["questions"][current_question]["type"] = $(this).find(".question-multiplechoice-type").val();
            }

            if ($(this).find(".question-required-checkbox").is(':checked')) {
                enquete["questions"][current_question]["required"] = 1;
            } else {
                enquete["questions"][current_question]["required"] = 0;
            }

            enquete["questions"][current_question]["attributes"] = {};

            if ($(this).attr("data-type") == "textfield" || $(this).attr("data-type") == "textarea") {

                enquete["questions"][current_question]["attributes"][current_attribute] = {}
                enquete["questions"][current_question]["attributes"][current_attribute]["id"] = $(this).attr("data-placeholder-id")
                enquete["questions"][current_question]["attributes"][current_attribute]["type"] = "placeholder";
                enquete["questions"][current_question]["attributes"][current_attribute]["attribute"] = $(this).find(".question-placeholder").val();

            }

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
        url = window.location.origin + "/questionmark/enquete/run";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                type: "edit",
                json: json 
            }
        })
        .done(function( msg ) {
            // $("body").append("<pre style=\"margin-top: 100px; clear:both; position:absolute; z-index:2000;\">"+msg+"</pre>");
            location.reload();
        });

        // enquete = {};
        // enquete["questions"] = {};
        // enquete["deleted_question"] = [];
        // enquete["deleted_attributes"] = [];

    });



    // Are you sure you want to do this?
    $(".sure").on("click", function() {

        if (confirm("Weet je zeker dat je deze actie wilt uitvoeren?")) {
} else {
            return false;
        }

    });




});
