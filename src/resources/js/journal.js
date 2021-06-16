/**
 * Created by t on 9/9/2017.
 */

(function($){
    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
})(jQuery);

rg_txn = function () {

    var select2_items = [];
    var taxes = {};
    var items = {};
    var total = 0;
    var txn_number = '-NA-';
    var txn_exchange_rate = 1;

    var tax_value = function(tax_value, taxable_amount, inclusive ) {
        //console.log(tax_value);
        //console.log('type of tax: ' + inclusive);
        if (typeof tax_value === 'undefined') return 0;

        if (tax_value.length > 0) {

            if (tax_value.substr(-1, 1) == '%') {

                var tax = tax_value.substr(0, tax_value.length-1);

                if ( isNaN(tax) ) {
                    return 0;
                }

                if (inclusive === true) {
                    return (taxable_amount - (taxable_amount / (1 + (rg_number(tax) / 100)) ) );
                }

                return ( taxable_amount * (rg_number(tax)  / 100) );
            }
            else {
                return rg_number(tax_value);
            }

        }

        return 0;
    }

    var select2_item = function () { 
        var rg_item_selector = $('.rg_item_selector');

        if (typeof rg_item_selector.data('url') === 'undefined') {
            console.log('Will not get items. data-url: ' + rg_item_selector.data('url'));
            return false;
        }

        if (rg_item_selector.length) {
            $.ajax({
                url: rg_item_selector.data('url'),
                method: 'POST',
                //data: {ci_csrf_token: Cookies.get('ci_csrf_token')},
                dataType: "json",
                success: function (response, status, xhr, $form) {
                    select2_items = response;

                    $('#row_0 .rg_item_selector').select2({
                        data: response,
                        minimumInputLength: 0,
                        placeholder: "Choose item",
                        tags: true
                    }).on('change', function() {
                        //console.log('we are rocking the party');
                    });
                    
                    new_item(false);

                    if ( window.location.pathname.split( '/' )[2] === 'journal') {
                        new_item();
                    }

                }
            });

        } else {
            //do nothing
        }

        // Custom results color
        $('.select-results-color-danger').select2({
            containerCssClass: 'bg-danger-400'
        });
    }

    var new_item = function(manual) {

        manual = typeof manual !== 'undefined' ? manual : true;

        //console.log(e);
        //console.log('Cloning template');
        //console.log($('#items_field_rows tr').length);

        var table_rows = $('#items_field_rows tr');

        if (manual === false && table_rows.length > 1) {
            //This means the user is editing a txn so simply set the default values
            table_rows.each(function(index, row) {

                if (index === 0) return true;
                
                var _this_ = $(this);

                var item_selector = _this_.find(".rg_item_selector");

                item_selector.select2({
                    data: select2_items,
                    minimumInputLength: 0,
                    placeholder: "Choose item",
                    tags: true
                });

                _this_.find(".rg_tax_selector").select2({
                    allowClear: true
                });

                item_selector.val(item_selector.data('value')).trigger('change');

                _this_.find('.item_row_description').keyup(); //Auto size the description fields
            });

            return true;
        }

        var rows = table_rows.length; //console.log(rows);
        var index = rows - 1;

        var rg_clone = $(".items_row_template").clone();

        //console.log(rg_clone);
        //console.log(select2_items);

        //remove the item_row_template class
        rg_clone.removeClass('items_row_template hidden');
        rg_clone.attr('id', 'row_'+index);

        rg_clone.find("[name^=items]").each(function() {
            var myName = $(this).attr("name");
            $(this).attr("name", myName.replace("_index_", index));
            $(this).attr("data-row", index);
        });
        rg_clone.appendTo("#items_field_rows");

        rg_clone.find(".rg_item_selector").attr("data-row", index);
        rg_clone.find(".rg_tax_selector").attr("data-row", index);
        rg_clone.find(".item_row_delete").attr("data-row", index);

        rg_clone.find(".rg_item_selector").select2({
            data: select2_items,
            minimumInputLength: 0,
            placeholder: "Choose item",
            tags: true
        });

        rg_clone.find(".rg_item_selector").focus();

        rg_clone.find(".rg_tax_selector").select2({
            allowClear: true
        });

        rg_clone.find(".rg_contact_selector").select2({
            allowClear: true
        });

    }

    var item_total = function(row_id) {

        if (typeof row_id === 'undefined') {
            console.log('not calling this function. row_id: ' + row_id);
            return false;
        }

        //console.log(row_id);
        tax_id = 0;

        if (typeof items[row_id] === 'undefined') {
            items[row_id] = {
                taxable_amount : 0
            };
        }

        tr = $('#row_' + row_id);

        debit       = tr.find('.item_row_debit').val();
        credit      = tr.find('.item_row_credit').val();
        contact_id  = tr.find('.item_row_contact').val();
        taxable_amount = rg_number(debit) + rg_number(credit);

        items[row_id] = {
            contact_id: contact_id,
            type: null,
            type_id: 0,
            name: '',
            description: tr.find('.item_row_description').val(),
            debit: (rg_empty(debit) ? 0 : debit),
            credit: (rg_empty(credit) ? 0 : credit)
        };

        //get the details of the selected item
        item = tr.find('.rg_item_selector').select2('data');

        if (item.length === 0) {
            item = {tax_inclusive: false}
        } else {
            item = item[0];
            items[row_id].type = item.type;
            items[row_id].type_id = (isNaN(item.id) ? 0 : item.id);
            items[row_id].name = item.text;
        }
        
        //Display the sub total
        var sub_total = 0;
        var txn_total = 0;

        $.each(items, function(index, value) {
            sub_total = rg_number(sub_total) + rg_number(value.debit)
            txn_total = rg_number(txn_total) + rg_number(value.debit);
        });

        $('#txn_subtotal').html(rg_number_format(sub_total, 2, '.', ','));
        $('#txn_total').html(rg_number_format(txn_total, 2, '.', ','));

        total = txn_total;

        //$('#txn_exchange_amount').html( response.currency[0] + ' ' + rg_number_format((txn_exchange_rate * total), 2, '.', ',') );
        $('#txn_exchange_amount').html( rg_number_format((txn_exchange_rate * txn_total), 2, '.', ',') );

    }

    var item_row_update = function() {

        var jq_txn_form = $('#txn_form');

        jq_txn_form.on("change", ".rg_item_selector", function() {

            //Set the defaults
            element = $(this);
            item = {
                quantity: 1,
                rate: 0,
                id: 0,
                discount: 0, //MaTxnItemDiscount($("#TxnInsertForm_Item_Discount").val());
                total: 0
            };

            item.total = rg_number(item.rate) * rg_number(item.quantity);

            //TxnEntree = MATxnEntree();
            //console.log(TxnInsertForm_Item_Description.val());

            selected = $.extend({}, element.select2('data')[0]);

            if (typeof selected === 'undefined') {
                selected = {
                    rate: 0,
                    tax_id: 0
                };
            }

            item.rate = selected.rate;

            item.total = rg_number(item.rate) * rg_number(item.quantity);

            //console.log('#row_' + element.data('row'));

            var item_row_rate = $('#row_' + element.data('row')).find('.item_row_rate');

            /* Removed on 28th Feb 2018
            if (rg_empty(item_row_rate.val())) {
              //console.log('item rate is empty');
              item_row_rate.val(item.rate);
            } else {
              //console.log('item rate is: ' + item_row_rate.val());
            }
            */
            
            item_row_rate.val(item.rate); //alway update the rate field

            //$('#row_' + element.data('row')).find('.item_row_rate').val(item.rate);

            item_total(element.data('row'));

            //console.log(TxnItem);

        });

        jq_txn_form.on("keyup", ".item_row_debit, .item_row_credit", function(event) {

            //console.log('we are here');

            element = $(this);

            //console.log('#row_' + element.data('row'));

            item_total(element.data('row'));

        });

        jq_txn_form.on("change", ".rg_tax_selector", function(event) {
            element = $(this);
            item_total(element.data('row'));
        });

    }

    var item_row_delete = function() {

        $('#txn_form').on("click", ".item_row_delete", function(e) {

            element = $(this);
            row_id = element.data('row');

            e.preventDefault();
            e.stopPropagation();

            //Nulfy the row totals
            $('#row_' + row_id).find('.item_row_rate').val(0);
            item_total(row_id);
            delete  items[row_id];

            //Destroy the select2 fields
            $('#row_'+row_id).find(".rg_item_selector, .rg_tax_selector").select2("destroy");

            //Now remove the row
            $('#row_'+row_id).remove();

            console.log('Row #'+row_id+' deleted');

            return true;

        });
    }

    var reset_txn_form = function()
    {
        var form = $('#txn_form');

        var url = window.location.pathname.split( '/' ); //console.log(url);

        //form.find("[id^=row_] .rg_item_selector:not(#rg_item_selector_expense), [id^=row_] .rg_tax_selector").select2("destroy");
        form.find(".select-search, .select").val("").trigger('change');
        form.find("[name=internal_ref]").val('');
        //form.find(".item_row_description").val('').hide(); //Todo delete
        form.trigger("reset");

        $("[id^=row_]").remove(); //Remove all the details rows

        items = []; //delete all items

        new_item(); //Add a new item field
        new_item(); //Add a new item field

        $('#rg-num-of-attahed-files').html('');
        $('#rg-attahed-file-names').html('');
        $('#dropzone_remove_all_files').html('');

        $('#txn_totals').html('');
        $('#txn_subtotal').html('0.00');
        $('#txn_total').html('0.00');

        $('div.btn-group').removeClass('open'); //hide the options of the btn group
        $('#txn_exchange_rate').hide();
    }

    var form_reset = function ()
    {
        var form = $('#txn_form');
        
        $.each(items, function(row_id, value){
            //Nulfy the row totals
            $('#row_' + row_id).find('.item_row_rate').val(0);
            item_total(row_id);
            delete  items[row_id];

            //Destroy the select2 fields
            $('#row_'+row_id).find(".rg_item_selector, .rg_tax_selector").select2("destroy");

            //Now remove the row
            $('#row_'+row_id).remove();
        });

        form[0].reset();

        if (txn_number != '-NA-') {
            form.find("[name=number]").val(txn_number);
        }

        //clear the customer/supplier field
        $("[name=contact_id]").val('').trigger('change')
    }

    var attach_file = function (action) {

        Dropzone.options.rgDropzone = {

            // Prevents Dropzone from uploading dropped files immediately
            autoProcessQueue: false,
            
            addRemoveLinks: true,
            uploadMultiple: true,
            parallelUploads: 5,
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 5, 
            maxFilesize: 5, // MB
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',

            //new
            clickable : '#rg-txn-attache-files, #rg-dropzone',
            createImageThumbnails: false,
          
            init: function() {
                
                var submitButtons = document.querySelectorAll(".submit_txn_form");
                var rgDropzone = this; // closure
                var form = $('#txn_form');
                var rg_num_of_attahed_files = $('#rg-num-of-attahed-files');
                var rg_attahed_file_names = $('#rg-attahed-file-names');
                var dropzone_remove_all_files = $('#dropzone_remove_all_files');
                var onsuccess = null;
                
                
                for (var i = 0; i < submitButtons.length; i++) {
                    submitButtons[i].addEventListener("click", function(e) {

                        onsuccess = $(this).data('onsuccess'); //console.log(onsuccess);

                        e.preventDefault();
                        e.stopPropagation();

                        var processQueue = rgDropzone.processQueue(); // Tell Dropzone to process all queued files.

                        // To access all uploading files count
                        var getUploadingFiles = rgDropzone.getUploadingFiles().length;

                        //console.log(getUploadingFiles);
                        
                        if (getUploadingFiles === 0) {
                            //Post form with ajax
                            //console.log('Posting with ajax');

                            PNotify.removeAll();
            
                            var notice = new PNotify({
                                //title: "Please wait",
                                text: 'Please wait as perform some magic...',
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
                            });
                    
                            var options = {
                                buttons: {
                                    closer: true,
                                    sticker: true
                                },
                                width: "350px"
                            };

                            data = form.serializeObject();

                            data.items = $.extend( {}, items); //Overide the items values
                            data.taxes = $.extend( {}, taxes);
                            data.total = total;
                            data.onsuccess = onsuccess;

                            $.ajax({
                                url: form.attr('action'),
                                method: form.attr('method'),
                                data: data,
                                dataType: "json",
                                success: function(response, status, xhr, $form) {

                                    if (response.status === true) {

                                        options.title = "Done!";
                                        options.text = response.message;
                                        options.addclass = "bg-success";
                                        options.type = "success";
                                        //options.hide = true;
                                        options.icon = 'icon-checkmark3';
                                        options.opacity = 1;
                                        options.width = PNotify.prototype.options.width;
                    
                                        notice.update(options);
                    
                                        if (data.on_submit === 'view') {
                                            window.location.href = '/invoices/view/' + response.txn.id;
                                        } else if (data.on_submit === 'draft') {
                    
                                        } else if (data.on_submit === 'send') {
                    
                                        }
                    
                                        //Reset the form fields
                                        txn_number = response.number;
                                        reset_txn_form();
                    
                                    } else {
                    
                                        options.title = "Error(s)!";
                                        options.text = response.message;
                                        options.addclass = "bg-danger";
                                        options.type = "danger";
                                        options.icon = 'icon-alert';
                    
                                        notice.update(options);
                                    }

                                }
                            });
                        }

                    }) 
                };
                
                //console.log(dropzone_remove_all_files);

                dropzone_remove_all_files.click(function(e){
                    e.preventDefault();
                    e.stopPropagation();

                    //console.log('removeAllFiles');
                    rgDropzone.removeAllFiles();
                    rg_num_of_attahed_files.html('');
                    rg_attahed_file_names.html('');
                    dropzone_remove_all_files.hide();
                });

                // You might want to show the submit button only when 
                // files are dropped here:
                rgDropzone.on("addedfile", function(file) {

                    setTimeout(function () {

                        // Show submit button here and/or inform user to click it.

                        // To access all files count
                            //myDropzone.files.length
                        // To access only accepted files count
                            //myDropzone.getAcceptedFiles().length
                        // To access all rejected files count
                            //myDropzone.getRejectedFiles().length
                        // To access all queued files count
                            //myDropzone.getQueuedFiles().length
                        // To access all uploading files count
                            //myDropzone.getUploadingFiles().length
                        
                        //console.log(rgDropzone.getQueuedFiles());
                        //console.log(file);
                        //console.log('xxxxxxxx');

                        get_accepted_files = rgDropzone.getAcceptedFiles().length;
                        rg_num_of_attahed_files.html(get_accepted_files + ' file(s) attached.');
                        rg_attahed_file_names.append('<br>' + file.name);
                        dropzone_remove_all_files.show();

                    }, 10);
                });

                rgDropzone.on('sending', function(file, xhr, formData) {

                    PNotify.removeAll();
        
                    var notice = new PNotify({
                        //title: "Please wait",
                        text: 'Please wait as perform some magic xxx...',
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
                    });
                
                    $.each(form.serializeObject(), function(index, value) {
                        //console.log(index); //console.log(value);
                        if (index != 'items') {
                            formData.append(index, JSON.stringify(value));
                            //formData.append(index, value );
                        }
                    });                    
            
                    formData.append('items', JSON.stringify(items) );
                    formData.append('taxes', JSON.stringify(taxes) );
                    formData.append('total', JSON.stringify(total) );
                    formData.append('onsuccess', onsuccess );
                });

                rgDropzone.on("processing", function(file) {
                    rgDropzone.options.url = form.attr('action');
                });

                rgDropzone.on("success", function(file, response) {
                    //console.log(response);

                    rgDropzone.removeFile(file);
                    
                    var response = JSON.parse(response);

                    PNotify.removeAll();
        
                    var notice = new PNotify({
                        //title: "Please wait",
                        text: 'Please wait as perform some magic xxx...',
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
                    });

                    var options = {
                        buttons: {
                            closer: true,
                            sticker: true
                        },
                        width: "350px"
                    };

                    if (response.status === true) {

                        options.title = "Done!";
                        options.text = response.message;
                        options.addclass = "bg-success";
                        options.type = "success";
                        //options.hide = true;
                        options.icon = 'icon-checkmark3';
                        options.opacity = 1;
                        options.width = PNotify.prototype.options.width;
    
                        notice.update(options);
    
                        if (action.on_submit === 'view') {
                            window.location.href = '/invoices/view/' + response.txn.id;
                        } else if (action.on_submit === 'draft') {
    
                        } else if (action.on_submit === 'send') {
    
                        }
    
                        //Reset the form fields
                        txn_number = response.number;
                        reset_txn_form();
    
                    } else {
    
                        options.title = "Error(s)!";
                        options.text = response.message;
                        options.addclass = "bg-danger";
                        options.type = "danger";
                        options.icon = 'icon-alert';
    
                        notice.update(options);
                    }
                });

          
            }
          }
          
    }

    var datatable_sidebar = function() {

        $('.rg_datatable_sidebar').DataTable({
            columnDefs: [{
                    'targets': 0,
                    "orderable": false,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;
                            if (rows_selected > 0) {
                                $('.rg_datatable_onselect_btns').slideDown(100);
                            } else {
                                $('.rg_datatable_onselect_btns').slideUp(100);
                            }
                        }
                    },
                },
                {
                    'targets': [0],
                    "orderable": false 
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [0, false]
            ],
            ordering: false,
            info: false,
            bLengthChange: false,
            bFilter: false,
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": "number", "sClass": "pl-5" },
                { "mDataProp": "total", "sClass": "" }
            ],
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var column_two = '<h6 class="no-margin">' +
                    '<small class="display-block text-muted">' +
                    '<a href="/transaction/journals/'+aData['id']+'">View</a> | Date: ' + aData['date'] +
                    '</small>' +
                    '</h6>';

                var column_three = '<h6 class="no-margin text-right">' +
                    '<small>'+aData['quote_currency']+'</small> ' + rg_number_format(aData['total']) +
                    '</h6>';

                $('td:eq(1)', nRow).html(column_two);
                $('td:eq(2)', nRow).html(column_three);
            }
        });

    }
    
    var datatable_txns = function() {

        var dtable = $('.rg-datatable-txns-table').DataTable({
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-default'
                    }
                },
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-copy3"></i>'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-file-excel"></i>'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-file-pdf"></i>'
                    }
                ]
            },
            pagingType: "simple",
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 20,
            aLengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100]
            ],
            /*columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }
            ],*/
            columnDefs: [{
                    'targets': 0,
                    "orderable": false,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;
                            if (rows_selected > 0) {
                                $('.rg_datatable_onselect_btns').slideDown(100);
                            } else {
                                $('.rg_datatable_onselect_btns').slideUp(100);
                            }
                        }
                    },
                },
                {
                    'targets': [0, 4],
                    "orderable": false
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [0, false]
            ],
            ordering: false,
            //info: false,
            //bLengthChange: false,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": null, "sClass": "text-left no-padding-left" },
                { "mDataProp": "date", "sClass": "" },
                { "mDataProp": "reference", "sClass": "" },
                { "mDataProp": 'total', "sClass": "text-right" },
                { "mDataProp": null, "sClass": "text-left" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var action = '<ul class="icons-list">\
                    <li><a href="/transaction/journals/' + aData['id'] + '"><i class="icon-pencil7"></i></a></li> \
                </ul>';

                $('td:eq(1)', nRow).html(action);
                $('td:eq(4)', nRow).html(rg_number_format(aData['total']) + ' ' + aData['base_currency']);
                $('td:eq(5)', nRow).html('');
            }
        });

        $('body').on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });

            //console.log(ids);

            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the record(s)!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: { ids: ids },
                            dataType: "json",
                            success: function(response, status, xhr, $form) {

                                //Update the cross dite tocken
                                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                                if (response.status === true) {
                                    swal({
                                        title: "Deleted!",
                                        text: response.message,
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 2000
                                    });

                                    //Redraw the the table
                                    dtable.ajax.reload();

                                    $('.rg_datatable_onselect_btns').slideUp(100);

                                } else {
                                    swal({
                                        title: "Failed!",
                                        text: response.message,
                                        confirmButtonColor: "#66BB6A",
                                        type: "danger",
                                        timer: 2000
                                    });
                                }

                            }
                        });

                    }
                });
        });

        return dtable;

    }

    return {
        // public functions
        init: function() {
            select2_item();
            item_row_update();
            item_row_delete();
            attach_file('draft');

            try {
                datatable_sidebar();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_txns();
            } catch (e) {
                console.log(e);
            }

        },
        new_item: function() {
            new_item();
        },
        form_reset: function () {
            form_reset();
        }
    };
}();

jQuery(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    rg_txn.init();
    //rg_txn.new_item(); //this function is called after the select2 values are ajax loaded

});
