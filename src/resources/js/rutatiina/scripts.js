/**
 * Created by t on 9/9/2017. 
 */

//new PNotify(rg_pnotify_options.initiate);
rg_pnotify_options = {
    initiate: {
        //title: "Please wait",
        text: 'Please wait as perform some magic ...',
        addclass: 'bg-primary',
        type: 'info',
        icon: 'icon-spinner4 spinner',
        hide: false,
        buttons: {
            closer: true,
            sticker: false
        },
        opacity: .9,
        width: "350px"
    },
    success: {
        buttons: {
            closer: true,
            sticker: true
        },
        width: "350px",

        title: "Done!",
        text: '',
        addclass: "bg-success",
        type: "success",
        //hide: true,
        icon: 'icon-checkmark3',
        opacity: 1,
        width: PNotify.prototype.options.width
    },

    error: {
        buttons: {
            closer: true,
            sticker: true
        },
        width: "350px",

        title: "Error(s)!",
        text: '',
        addclass: "bg-danger",
        type: "danger",
        icon: 'icon-alert'
    },
};

rutatiina = function () {
   
    var testFunction = function() {
        console.log('Success: Load rutatiina > metronic js');
    }

    function js_ucfirst(string) {
        return string; //.charAt(0).toUpperCase() + string.slice(1);
    }

    var defaults = function() {
        
        $('body').on('click', '[data-href]', function (e) { 
            e.preventDefault();
            //alert('clicked here');
            window.location.href = $(this).data('href');
        });

    }

    var showResponse = function(form, type, msg) {

        var alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show ml-4 mr-4 mt-4" role="alert">\
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
            <span></span>\
        </div>');

        form.find('.alert').remove();
        alert.appendTo(form.find('.m-portlet__body'));
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    }

    var notifyResponse = function(type, msg) {

        $.notify(msg, {
            type: type,
            allow_dismiss: true,
            newest_on_top: true,
            //mouse_over:  $('#m_notify_pause').prop('checked'),
            //showProgressbar:  $('#m_notify_progress').prop('checked'),
            //spacing: $('#m_notify_spacing').val(),
            timer: $('#m_notify_timer').val(),
            placement: {
                from: 'top',
                align: 'right'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 1000,
            z_index: 10000,
            animate: {
                enter: 'animated bounce',
                exit: 'animated bounce'
            }
        });

    }

    var select2BasicInit = function () {
        $('.rg-select2-basic').select2();
        console.log('basic select2 inited');
    }

    var select2FieldInit = function () {

        $('#rg_select2_users').select2({
            ajax: {
                url: '/users/select2/',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            },
            minimumInputLength: 0,
            placeholder: "Choose user / client"
        });

        $('#rg_select2_asset').select2({
            ajax: {
                url: '/asset/select2/',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            },
            minimumInputLength: 0,
            placeholder: "Choose asset",
        });

        $('#rg_select2_asset_category').select2({
            ajax: {
                url: '/asset/category/select2/',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            },
            minimumInputLength: 0,
            placeholder: "Choose / enter asset category",
            tags: true
        });

    }

    var form_data_object = function(form) {
        /*var data = {};
        $.each(form.serializeArray(), function(_, kv) {
            data[kv.name] = kv.value;
        });*/
        return form.serializeArray();
    }

    var form_ajax_submit = function (form_id, form_reset) {
        //console.log(form_reset);

        form_reset = typeof form_reset !== 'undefined' ? form_reset : true;

        console.log('Ajax processing form: ' + form_id + ', form_reset: ' + form_reset);

        var form = $(form_id);

        //Prepare the notification
        PNotify.removeAll();
        rg_pnotify = new PNotify(rg_pnotify_options.initiate);

        var data = form_data_object(form);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            dataType: "json",
            success: function(response, status, xhr, $form) {

                //Update the cross dite tocken
                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                if (response.status === true) {
                    rg_pnotify_options.success.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.success);


                    if (form_reset === true) {

                        form.find('._remove_on_success_').remove();
                        
                        console.log('Form '+form_id+' has been reset');

                        form.trigger("reset");
                        form.find(".select-search, .select").val("").trigger('change');
                        //item_type_change('productxxx');

                        if (form_id === '#item_form') {
                            console.log('#item_type_'+data.type);
                            form.find('#item_type_'+data.type).trigger('click');
                            //form.find('#item_rates').removeClass('service_rates cost_center_rates');
                        }
                    }

                }
                else {
                    rg_pnotify_options.error.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.error);
                }

            }
        });

    }

    var hr_form_ajax_submit = function (form_id, form_reset) {

        form_reset = typeof form_reset !== 'undefined' ? form_reset : true;

        //console.log('Ajax processing form '+form_id);

        var form = $(form_id);

        //Prepare the notification
        PNotify.removeAll();

        rg_pnotify = new PNotify(rg_pnotify_options.initiate);

        var data = form_data_object(form);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            dataType: "json",
            success: function(response, status, xhr, $form) {

                //Update the cross dite tocken
                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                Ladda.stopAll(); //Stop all ladda spinners/animations

                if (!rg_empty(response.result)) {

                    rg_pnotify_options.success.text = response.result;
                    rg_pnotify.update(rg_pnotify_options.success);

                    //Reset form if suceccessful
                    if (form_reset === true) {
                        form.trigger("reset");
                        form.find(".select-search, .select").val("").trigger('change');
                    }

                } else {

                    rg_pnotify_options.error.text = response.error;
                    rg_pnotify.update(rg_pnotify_options.error);

                }

            }
        });

    }

    var hr_form_with_file_ajax_submit = function () {    
        $(".hr_form_with_file").submit(function(e){
            var fd = new FormData(this);
            var obj = $(this);
            var action = obj.attr('name');
            
            var description = $("#description").summernote('code');;
            fd.append("is_ajax", 1);
            fd.append("description", description);
            fd.append("form", action);
            e.preventDefault();
            $('.save').prop('disabled', true);
        
            PNotify.removeAll();
            rg_pnotify = new PNotify(rg_pnotify_options.initiate);
        
            $.ajax({
                url: e.target.action,
                type: "POST",
                data:  fd,
                contentType: false,
                cache: false,
                processData:false,
                success: function(JSON)
                {
                    Ladda.stopAll(); //Stop all ladda spinners/animations
                    
                    if (JSON.error != '') {

                        rg_pnotify_options.error.text = JSON.error;
                        rg_pnotify.update(rg_pnotify_options.error);
        
                        $('.save').prop('disabled', false);
                        $('.icon-spinner3').hide();

                    } else {

                        rg_pnotify_options.success.text = JSON.result;
                        rg_pnotify.update(rg_pnotify_options.success);
        
                        xin_table.api().ajax.reload(function(){}, true);
                        //$('.icon-spinner3').hide();
                        $('.add-form').fadeOut('slow');
                        $('#xin-form')[0].reset(); // To reset form fields
                        $('.save').prop('disabled', false);
                    }
        
                    Ladda.stopAll(); //Stop all ladda spinners/animations
                },
                error: function() 
                {
                    rg_pnotify_options.error.text = JSON.error;
                    rg_pnotify.update(rg_pnotify_options.error);
                    
                    $('.icon-spinner3').hide();
                    $('.save').prop('disabled', false);
                } 	        
        });
        });
    }

    var txn_comment_form_ajax_submit = function (form_id, form_reset) {

        form_reset = typeof form_reset !== 'undefined' ? form_reset : true;

        console.log('Ajax processing form: ' + form_id + ', form_reset: ' + form_reset);

        var form = $(form_id);

        //Prepare the notification
        PNotify.removeAll();
        rg_pnotify = new PNotify(rg_pnotify_options.initiate);

        var data = form_data_object(form);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            dataType: "json",
            success: function(response, status, xhr, $form) {

                //Update the cross dite tocken
                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                if (response.status === true) {
                    rg_pnotify_options.success.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.success);

                    var comment = '' +
                        '<tr>' +
                        '    <td class="col-lg-1 text-nowrap text-muted text-size-mini">' + response.data.created_on + '</td>' +
                        '    <td class="">' +
                        '        <span class="btn btn-icon btn-rounded border-green btn-xs text-green-600"><i class="icon-file-text2"></i></span>' +
                        '    </td>' +
                        '    <td class="col-lg-10">' + response.data.comment + '</td>' +
                        '</tr>';

                    $("#transaction_comments_table tbody").prepend(comment);

                    if (form_reset === true) {
                        //console.log('Form has been reset _rg_');
                        form.trigger("reset");
                    }

                }
                else {
                    rg_pnotify_options.error.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.error);
                }

            }
        });

    }

    var select2_tags_modal = function() {
        $('#rg_modal_counterparty').on('shown.bs.modal', function () {
            // basic
            $('#rg_select2_tags_modal').select2({
                tags: true
            });
        });
    }

    var select2_basic = function() {
        $('.rg_select2_basic').select2({
            //placeholder: "Select ..."
        });
    }
    
    var item_type_change = function(checkbox) { //console.log('called me' + $(checkbox).val());
        var form = $(checkbox).parents('.rg-item-form');

        if ( $(checkbox).val() == 'product') {
            //console.log('called here');
            $('#track_inventory').show();
        } else {
            //console.log('called there');
            $('#track_inventory').hide();
        }

        if(checkbox.checked) {
            form.find('#item_rates').removeClass('service_rates');
            form.find('#item_rates').removeClass('cost_center_rates');
            var val = $(checkbox).val(); //console.log(val);
            if ( val == 'cost_center') {
                form.find('#item_rates').addClass('cost_center_rates');
            } else if ( val == 'service') {
                form.find('#item_rates').addClass('service_rates');
            }
        }
    }

    var transaction_delete = function( options ) {
        
        var settings = $.extend({
            url: '/missing-url-parameter/',
            data: {},
            method: 'POST',

            onSuccessCallback: function() {},
            onFailureCallback: function() {},

            title: "Are you sure?",
            text: "You will not be able to recover this Invoice(s)!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }, options );

        //console.log(settings);

        swal({
                title: settings.title,
                text: settings.text,
                type: settings.type,
                showCancelButton: settings.showCancelButton,
                confirmButtonColor: settings.confirmButtonColor,
                confirmButtonText: settings.confirmButtonText,
                cancelButtonText: settings.cancelButtonText,
                closeOnConfirm: settings.closeOnConfirm,
                closeOnCancel: settings.closeOnCancel,
                showLoaderOnConfirm: settings.showLoaderOnConfirm
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        url: settings.url,
                        method: settings.method,
                        data: settings.data,
                        dataType: "json",
                        success: function(response, status, xhr, $form) {

                            //console.log('we are here');

                            //Update the cross dite tocken
                            //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                            if (response.status === true) {
                                swal({
                                    title: "Deleted!",
                                    text: response.message,
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 4000
                                });

                                //Redraw the the table
                                //dtable.ajax.reload();
                                $('.rg_datatable_onselect_btns').slideUp(100);

                                settings.onSuccessCallback(settings.datatable);

                            } else {

                                swal({
                                    title: "Failed!",
                                    text: response.message,
                                    confirmButtonColor: "#66BB6A",
                                    type: "error",
                                    timer: 6000
                                });

                                settings.onFailureCallback();

                            }

                        }
                    });

                }
        });

        return true;

    }
    
    /*
    var contact_modal = function () {
        $('#rg_modal_contact').on('show.bs.modal', function() {
            $(this).find('.modal-content').load('/contacts/modal_form', function() {
                // Init Select2 when loaded
                $('#rg_modal_contact .select').select2({
                    tags: true,
                    minimumResultsForSearch: Infinity
                });
            });
        });
    }
    */

    var new_contact_person = function(state) {

        var table_rows = $('#contact_person_field_rows tr');

        var rows = table_rows.length; //console.log(rows);
        var index = rows - 1;

        if (rows > 1 && state === false) {
            table_rows.not(".contact_person_row_template").find("select").select2({
                minimumResultsForSearch: Infinity
            });
            return true;
        }

        var rg_clone = $(".contact_person_row_template").clone();

        //console.log(rg_clone);
        //console.log(select2_items);

        //remove the item_row_template class
        rg_clone.removeClass('contact_person_row_template hidden');
        rg_clone.attr('id', 'row_'+index);

        rg_clone.find("[name^=contact_person]").each(function() {
            var myName = $(this).attr("name");
            $(this).attr("name", myName.replace("_index_", index));
            $(this).attr("data-row", index);
        });

        rg_clone.appendTo("#contact_person_field_rows");

        rg_clone.find("select").select2({
            minimumResultsForSearch: Infinity
        });
    }

    var import_data = function (action) {

        var rg_import = '';
        var rg_import_url = '/import/';

        $('body').delegate('.import_btn', 'click', function() {
            rg_import = $(this).data('import');
            rg_import_url = $(this).data('url');
            console.log($(this).data('import'));
        });

        Dropzone.options.rgDropzone = {

            uploadMultiple: false,
            parallelUploads: 5,
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1, 
            maxFilesize: 5, // MB
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',

            //new
            clickable : '.import_btn',
            createImageThumbnails: false,
          
            init: function() {
                
                var rgDropzone = this; // closure
                
                // You might want to show the submit button only when 
                // files are dropped here:
                rgDropzone.on("addedfile", function(file) {
                    setTimeout(function () {
                        //get_accepted_files = rgDropzone.getAcceptedFiles().length;
                    }, 10);
                });

                rgDropzone.on('sending', function(file, xhr, formData) {
                    formData.append('import', rg_import );
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content') );
                    formData.append('_method', 'post' );
                });

                rgDropzone.on("processing", function(file) {
                    rgDropzone.options.url = rg_import_url;
                });

                rgDropzone.on("success", function(file, response) {
                    //console.log(response);

                    rgDropzone.removeAllFiles();
                    //rgDropzone.removeFile(file);
                    
                    response = JSON.parse(response);

                    PNotify.removeAll();
                    rg_pnotify = new PNotify(rg_pnotify_options.initiate);

                    if (response.status === true) {
                        rg_pnotify_options.success.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.success);
                    } else {
                        rg_pnotify_options.error.text = response.message;
					    rg_pnotify.update(rg_pnotify_options.error);
                    }
                });

          
            }
          }
          
    }

    var _init = function () {

        var jQ_body = $('body');

        jQ_body.on('click', '.btn-update-text ul li a', function () {
            var _this = $(this);
            _this.parents('.btn-update-text').find('.btn-text').html(_this.data('text'));
        });

        //call a link via ajax
        jQ_body.on('click', '.rg_ajax_call', function (e) {

            var _this = $(this);
            e.preventDefault();

            //console.log('Ajax call to: ' + _this.attr('href'));
            method = typeof _this.data('method') !== 'undefined' ? _this.data('method') : 'POST';
            _method = typeof _this.data('_method') !== 'undefined' ? _this.data('_method') : 'POST';

            //prepare the notification
            PNotify.removeAll();
            rg_pnotify = new PNotify(rg_pnotify_options.initiate);

            $.ajax({
                url: _this.attr('href'),
                method: method,
                data: {_method: _method},
                dataType: "json",
                success: function(response, status, xhr, $form) {

                    if (response.status === true) {
                        rg_pnotify_options.success.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.success);
                    }
                    else {
                        rg_pnotify_options.error.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.error);
                    }

                    if (!rg_empty(response.redirect)) {
                        window.location.replace(response.redirect);
                    }

                }
            });

        });

        jQ_body.on('click', '#transaction_comment_add_link, #transaction_comment_form_cancel', function(ev) {
            ev.stopPropagation();
            ev.preventDefault();
            $('#transaction_comment_form_tr, #transaction_comment_add_link').toggleClass('hidden');
        });

    }

    return {
        // public functions
        init: function() {
            _init();
            defaults();
            testFunction();
            select2_basic();
            select2_tags_modal();
            //contact_modal();
            hr_form_with_file_ajax_submit();
            import_data(); 
        },
        showResponse: function(form, type, msg) {
            showResponse(form, type, msg);
        },
        testFunction: function() {
            testFunction();
        },
        js_ucfirst: function(string) {
            js_ucfirst(string);
        },
        notifyResponse: function(type, msg) {
            notifyResponse(type, msg);
        },
        select2BasicInit: function() {
            select2BasicInit();
        },
        select2FieldInit: function() {
            select2FieldInit();
        },
        form_ajax_submit: function(form_id,form_reset) {
            form_ajax_submit(form_id,form_reset);
        },
        hr_form_ajax_submit: function(form_id,form_reset) {
            hr_form_ajax_submit(form_id,form_reset);
        },
        txn_comment_form_ajax_submit: function(form_id,form_reset) {
            txn_comment_form_ajax_submit(form_id,form_reset);
        },
        item_type_change: function(checkbox) {
            item_type_change(checkbox);
        },
        transaction_delete: function(options) {
            transaction_delete(options);
        },
        new_contact_person: function(state) {
            new_contact_person(state);
        }

    };
}();

jQuery(document).ready(function () {
    rutatiina.init();
    rutatiina.new_contact_person(false);
    //rutatiina.transaction_delete({rutatiina: "#556b2f"}); //run a test
});
