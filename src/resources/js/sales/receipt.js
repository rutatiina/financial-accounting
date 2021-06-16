/**
 * Created by t on 9/9/2017.
 */
rg_receipt = function () {

    var txns = [];
    var notes = [];
    var txn_unpaid_msg = null;

    var datatable_sidebar = function () {

        var _table = $('.rg_datatable_sidebar');
        var txnId = _table.data('txn-id');

        var dtable = _table.DataTable({
            pagingType: "simple",
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            columnDefs: [
                {
                    'targets': [0,1],
                    "orderable": false
                }
            ],
            ordering: false,
            info: false,
            bLengthChange: false,
            //bFilter: false, //to allow search
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": "number", "sClass": "pointer" },
                { "mDataProp": "total", "sClass": "pointer " }
            ],
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

                if (aData.id == txnId) $(nRow).addClass('active');

                var column_two = '<h6 class="no-margin">' +
                    '<span>'+aData['contact_name']+'</span>' +
                    '<small class="display-block text-muted">' +
                    aData['number'] +
                    '</small>' +
                    '</h6>';

                var column_three = '<h6 class="no-margin text-right">' +
                    '<small>'+aData['quote_currency']+'</small> ' + rg_number_format(aData['total']) +
                    '<small class="display-block text-muted text-size-small">'+aData['date']+'</small>' +
                    '</h6>';

                $('td:eq(0)', nRow).html(column_two);
                $('td:eq(1)', nRow).html(column_three);

                $('td', nRow).click(function() {
                    document.location.href = aData['link_show'];
                });

                $(nRow).hover(
                    function() {
                        $(this).addClass('text-primary');
                    },
                    function() {
                        $(this).removeClass('text-primary');
                    }
                );
            }
        });

        $('.sidebar-secondary').on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            rutatiina.transaction_delete({
                datatable: dtable,
                url: url,
                data: { ids: ids },
            
                onSuccessCallback: function(dtable) {
                    dtable.ajax.reload();
                    $('.rg_datatable_onselect_btns').slideUp(100);
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },
            
                title: "Are you sure?",
                text: "You will not be able to recover the Receipt(s)!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });
                
        });

        $("#quick-sort").on('click', 'ul li a', function(){
            $(this).parents('#quick-sort').find('.dropdown-title').html($(this).html()).data('ajax', $(this).data('ajax'));
            dtable.ajax.url($(this).data('ajax')).load();
        });

        if (_table.is(':visible')) {
            $('#navbar_top_search').keypress(function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    dtable.search($(this).val()).draw() ;
                }
            });
        }

        return dtable;

    };

    var datatable_txns = function() {

        var jQ_body = $('body');

        var _table = $('.rg-datatable-txns-table');

        var dtable = _table.DataTable({
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
            iDisplayLength: 50,
            aLengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100]
            ],
            columnDefs: [
                {
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
                                $('.rg_datatable_onselect_btns').show();
                                $('.page-header').hide();
                            } else {
                                $('.rg_datatable_onselect_btns').hide();
                                $('.page-header').show();
                            }
                        }
                    },
                },
                {
                    'targets': [0, 4, 5, 6],
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
            processing: true,
            serverSide: true,
            //info: false,
            //bLengthChange: false,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": "date", "sClass": "pointer " },
                { "mDataProp": "number", "sClass": "pointer " },
                { "mDataProp": null, "sClass": "pointer " },
                { "mDataProp": "payment_mode", "sClass": "pointer " },
                { "mDataProp": "reference", "sClass": "pointer " },
                { "mDataProp": 'contact_name', "sClass": "pointer text-left" },
                //{ "mDataProp": 'status', "sClass": "pointer text-left" },
                { "mDataProp": 'total', "sClass": "pointer text-right text-semibold" }
                //{ "mDataProp": null, "sClass": "pointer text-left" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(3)', nRow).html(aData.debit_account.name);
                //$('td:eq(2)', nRow).html('<a href="'+aData['link_show']+'">' + aData['number'] + '</a>');
                $('td:eq(7)', nRow).html(rg_number_format(aData['total']) + ' ' + aData['base_currency']);

                if (!rg_empty(aData['app'])) {
                    $('td:eq(0)', nRow).find("input[type=checkbox]").attr("disabled", true);
                }

                /*
                var action = '<ul class="icons-list">\
                    <li><a href="#"><i class="icon-newspaper2"></i></a></li> \
                </ul>';
                $('td:eq(7)', nRow).html(action);
                */

                $('td:gt(0)', nRow).click(function() {
                    document.location.href = aData['link_show'];
                });

                $(nRow).hover(
                    function() {
                        $(this).addClass('text-primary');
                    },
                    function() {
                        $(this).removeClass('text-primary');
                    }
                );
            }
        });

        jQ_body.on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            rutatiina.transaction_delete({
                datatable: dtable,
                url: url,
                data: { ids: ids },
            
                onSuccessCallback: function(dtable) {
                    dtable.ajax.reload();
                    $('.rg_datatable_onselect_btns').slideUp(100);
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },
            
                title: "Are you sure?",
                text: "You will not be able to recover this Invoice(s)!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });
                
        });

        jQ_body.on('click', '.rg_datatable_selected_export_to_excel', function(ev) {

            console.log('export to excel');

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, rowId) {
                    ids['ids['+index+']'] = rowId;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            rg_js_post(url, ids, 'post');

        });

        if (_table.is(':visible')) {
            $('#navbar_top_search').keypress(function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    dtable.search($(this).val()).draw() ;
                }
            });
        }
        return dtable;

    }

    var on_submit = function (action) {

        //recepting_more();

        var form = $('#txn_form');

        //e.preventDefault();
        //e.stopPropagation();

        form.find('[name=on_submit]').val(action);

        var data = form.serializeArray();

        //console.log(items);

        //data.items = $.extend( {}, items);
        //data.taxes = $.extend( {}, taxes);
        //data.total = total;

        //console.log(data.on_submit);

        //delete data.items._index_;

        //Prepare the notification
        PNotify.removeAll();

        var notice = new PNotify({
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
        });

        var options = {
            buttons: {
                closer: true,
                sticker: true
            },
            width: "350px"
        };

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            dataType: "json",
            success: function(response, status, xhr, $form) {

                //Update the cross dite tocken
                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

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
                    var form = $('#txn_form');
                    $('#contact_txns').html(txn_unpaid_msg);
                    form.find("[name=number]").val(response.number);
                    form.find("[name=contact_id]").val(null).trigger('change');
                    $('#txn_allocated').addClass('hidden');
                    form.trigger("reset");

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

        return false;

    };

    var contact_txns = function() {

        //change of contact
        $('body').on('change', '[name="contact_id"]', function () {
            var selectField = $(this);
            var contact_id = selectField.val();
            //console.log('value: ' + contact_id);
            //console.log('Contact has been changed: ' + contact_id);

            //update the #invoice_contact_ids and trigger change
            $('#invoice_contact_ids').val([contact_id]); // Select the option with a value of '1'
            $('#invoice_contact_ids').trigger('change'); // Notify any JS components that the value changed

            /*

            if (rg_empty(txn_unpaid_msg)) {
                txn_unpaid_msg = $('#contact_txns').html();
            }

            if(contact_id == '') {
                htmlString = txn_unpaid_msg;
                $('#contact_txns').html(htmlString);
                $('#contact_currency').addClass('hidden');
                $('#txn_exchange_rate').hide();
                $('[name=total]').val('');
                clear_amounts();
                total_details();
                return false;
            }

            $('#contact_txns').html('... loading ...');

            $.ajax({
                url: selectField.data('invoices-url'),
                method: 'POST',
                data: {contact_id: contact_id},
                dataType: "json",
                success: function (response, status, xhr, $form) {

                    txns = response.txns;
                    notes = response.notes;
                    on_base_currency_change();

                    $('#change_of_contact').hide();
                    $('#contact_currency').removeClass('hidden');

                    $("#base_currency").html('');
                    $("#base_currency").select2("destroy");

                    $("#base_currency").select2({
                        minimumResultsForSearch: Infinity,
                        data: response.currencies
                    });

                    $('#base_currency').val(response.currencies[0].id).trigger('change'); //calls the on_base_currency_change fucntion
                    $('#txn_base_currency').html(response.currencies[0].id);

                    $('[name=base_currency]').val(response.currencies[0].id);
                    $('span.txn_currency').html(response.currencies[0].id);

                }
            });
            */

        });

        //change of #invoice_contact_ids
        $('body').on('change', '#invoice_contact_ids', function () {

            var selectField = $(this);
            var contact_ids = selectField.val();
            //console.log(contact_ids);

            //show the loading animation
            htmlString = '\
            <tr>\
                <td class="text-center" colspan="5"><h1><i class="icon-spinner2 spinner"></i></h1></td>\
            </tr>';
            $('#contact_txns').html(htmlString);

            //get the invoices of the selected contacts in #invoice_contact_ids
            $.ajax({
                url: selectField.data('invoices-url'),
                method: 'POST',
                data: {contact_ids: contact_ids},
                dataType: "json",
                success: function (response, status, xhr, $form) {

                    txns = response.txns;
                    notes = response.notes;

                    var htmlString = '';
                    var currency = $('#base_currency').val(); //get the selected base currency

                    if (txns.length == 0) {
                        //if no invoices are found, show error message
                        htmlString += '\
                        <tr>\
                            <td class="text-center text-danger" colspan="5"><h4>Oops: No invoices found</h4></td>\
                        </tr>';
                    } else {
                        //show invoices found
                        $.each(txns, function (index, value) {
                            if (value['base_currency'] == currency) {
                                var due_date = (rg_empty(value['due_date']) ? value['date'] : value['due_date']);
                                htmlString += '\
                                <tr>\
                                    <td class="">\
                                        <span class="text-semibold">' + value['date'] + '</span><br>\
                                        <span class="text-muted text-size-small">Due ' + due_date + '</span>\
                                    </td>\
                                    <td class="">\
                                        <div class="text-semibold text-nowrap">' + value['number'] + ' - ' + value['contact_name'] + '</div>\
                                        <div id="change_of_contact">\
                                            <div class="checkbox">\
                                                <label><input type="checkbox" class="paid_in_full"> Paid in full</label>\
                                            </div>\
                                        </div>\
                                    </td>\
                                    <td class="text-right">' + rg_number_format(value['total'], rg_decimal_places) + ' ' + value['base_currency'] + '</td>\
                                    <td class="text-right text-semibold">' + rg_number_format(value['balance'], rg_decimal_places) + ' ' + value['base_currency'] + '</td>\
                                    <td class="no-padding-top no-padding-bottom text-right">\
                                        <input type="hidden" name="items[' + value['id'] + '][txn_contact_id]" value="' + value['debit_contact_id'] + '" >\
                                        <input type="hidden" name="items[' + value['id'] + '][txn_number]" value="' + value['number'] + '" >\
                                        <input type="hidden" name="items[' + value['id'] + '][max_receipt_amount]" value="' + value['balance'] + '" class="item_row_max_receipt_amount" >\
                                        <input type="hidden" name="items[' + value['id'] + '][txn_exchange_rate]" value="' + value['exchange_rate'] + '" >\
                                        <div class="form-group clearfix">\
                                            <input type="text" name="items[' + value['id'] + '][rate]" value="" class="item_row_rate form-control input-roundless text-right" placeholder="0.00">\
                                        </div>\
                                    </td>\
                                </tr>';

                                /*
                                <select name="items['+value['id']+'][txn_entree_id]" class="bootstrap-select input-roundless" data-width="150px">\
                                    <option value="3">Receipt</option>\
                                    <option value="69">Forex Gain</option>\
                                    <option value="71">Forex Loss</option>\
                                </select>\
                                <input type="text" name="items['+value['id']+'][rate]" value="" class="item_row_rate form-control input-roundless text-right no-border-left" placeholder="0.00" aria-describedby="basic-addon1">\
                                */
                            }
                        });
                    }

                    $('#contact_txns').html(htmlString);

                }
            });

        });
    };

    var on_base_currency_change = function () {

        $('#base_currency').change(function () {

            $('[name=total]').val('');
            clear_amounts();
            total_details();

            var htmlString = '';

            var selected = $.extend({}, $(this).select2('data')[0]); //console.log(selected);

            $('#txn_base_currency').html(selected.id);

            var quote_currency = $('[name=quote_currency]').val();

            if ( quote_currency != selected.id ) {
                
                var selected = $.extend({}, $(this).select2('data')[0]);
                //console.log('EX rate is: ' + selected.exchange_rate);

                txn_exchange_rate = rg_number(selected.exchange_rate);
                $('#txn_exchange_rate').show();
                $('[name=exchange_rate]').val(txn_exchange_rate);

            } else {
                $('#txn_exchange_rate').hide();
                $('[name=exchange_rate]').val(selected.exchange_rate);
                txn_exchange_rate = selected.exchange_rate;
                //console.log('EX rate is: ' + selected.exchange_rate);
            }

            if (!rg_empty(notes)) {
                htmlString += '\
                <tr>\
                    <td class="text-center" colspan="5">' + notes + '</td>\
                </tr>';
            }
        
            //console.log(txns);
            //console.log(txns.length);

            $('.bootstrap-select').selectpicker('refresh');

            total_details();
            
        });

        return false;

    }
    
    var allocated_amount = function(amount) {
        var html = 'Total Amount received: ' + rg_number_format(amount);
        if (amount < 0 || amount > 0) {
            $('#txn_allocated').removeClass('hidden');
            $('#txn_allocated_message').html(html);
            $('[name=total]').val(amount);
        } else {
            $('#txn_allocated').addClass('hidden');
        }
    }

    var receipt_info = function() {

        var amount_total = rg_number($('[name="total"]').val());
        var amount_used = 0;

        $('body').on('keyup', '.item_row_rate, [name="total"]', function () {

            amount_total = rg_number($('[name="total"]').val());
            $('#txn_amount_total').html(rg_number_format(amount_total));

            var amount_used = 0;
            $('.item_row_rate').each(function (indexInArray, valueOfElement) { 
                amount_used = amount_used + rg_number($(valueOfElement).val());
            });

            $('#txn_amount_used').html(rg_number_format(amount_used));

            //var unallocated = amount_total - amount_used;
            allocated_amount(amount_used);

            //console.log(amount_total+'<>'+amount_used);
            
        });

        
    }

    var auto_pay = function() {
        $('#auto_pay').change(function() {
            if ($(this).is(':checked')) {
                $('.item_row_rate').val('');
                var amount_received = rg_number($('[name=total]').val()); //Amount in total field
                var amount_balance = 0; //Balance to be recived on invoice
                $.each($('#contact_txns tr'), function(index, tr) {
                    amount_balance = $(tr).find('.item_row_max_receipt_amount').val(); //console.log(amount_balance);
                    if (amount_received >= amount_balance) {
                        $(tr).find('.item_row_rate').val(amount_balance);
                    } else if (amount_received < amount_balance && amount_received > 0) {
                        $(tr).find('.item_row_rate').val(amount_received);
                    }
                    
                    amount_received = rg_number(rg_number(amount_received) - rg_number(amount_balance));
                });
                total_details();
            }
        });
    }

    var paid_in_full = function() {
        $('body').delegate('.paid_in_full', 'change', function() {
            var parent_tr = $(this).parents('tr');
            if($(this).is(':checked')) {
                parent_tr.find('.item_row_rate').val(parent_tr.find('.item_row_max_receipt_amount').val()).attr('readonly',true);
            } else {
                parent_tr.find('.item_row_rate').attr('readonly',false);
            }
            total_details();
        });
        
    }

    var clear_amounts = function() {
        $('.clear_amounts').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $('#auto_pay').attr('checked',false);
            $('.paid_in_full').attr('checked',false);
            $('.item_row_rate').attr('readonly',false);
            $('.item_row_rate').val('');
            total_details();
            return false;
        });
        
    }

    var pay_all_fully = function() {
        $('body').delegate('.pay_all_fully', 'click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var tatal_max = 0;
            $.each($('#contact_txns tr'), function(index, tr) {
                $(tr).find('.item_row_rate').val($(tr).find('.item_row_max_receipt_amount').val());
                tatal_max = rg_number(rg_number(tatal_max) + rg_number($(tr).find('.item_row_max_receipt_amount').val()));
            });
            $('[name=total]').val(tatal_max);
            total_details();

            return false;
        });
        
    }

    var rate_change = function() {
        $('body').delegate('.item_row_rate', 'change, keyup', function(e) {
            total_details();
        });
    };
    
    var total_change = function() {
        $('body').delegate('[name=total]', 'change, keyup', function(e) {
            total_details();
        });
    }

    var total_details = function() {
        var total_received = 0;
        var total_due = 0;
        var total_rate = 0;

        total_received = rg_number($('[name=total]').val());
        $('#txn_amount_received').html( rg_number_format(total_received, rg_decimal_places, '.', ',') );

        $.each($('.item_row_rate'), function(index, value) {
            total_rate = rg_number(rg_number(total_rate) + rg_number($(value).val()));
        });

        $.each($('.item_row_max_receipt_amount'), function(index, value) {
            total_due = rg_number(rg_number(total_due) + rg_number($(value).val()));
        });
        $('#txn_total_due').html( rg_number_format(total_due, rg_decimal_places, '.', ',') );

        if (rg_number_format(total_received, rg_decimal_places) == rg_number_format(total_rate, rg_decimal_places)) {
            $('#txn_amount_unallocated').html( rg_number_format(0, rg_decimal_places, '.', ',') ).parents('tr').hide();
            $('[name=total]').parents('.form-group').removeClass('has-error');
        } else {
            total_unallocated = rg_number(rg_number(total_received) - rg_number(total_rate));
            $('#txn_amount_unallocated').html( rg_number_format(total_unallocated, rg_decimal_places, '.', ',') ).parents('tr').show();
            
            if (!$('#no_txns').is(':checked')) {
                $('[name=total]').parents('.form-group').addClass('has-error');
            }
        }
        
        return true;
    }

    var no_txns = function() {
        $('#no_txns').change(function() {
            if ($(this).is(':checked')) {
                $('#contact_txns_table, #auto_pay_txns').hide();
            } else {
                $('#contact_txns_table, #auto_pay_txns').show();
            }
        });
    }

    var init = function() {
        var jQ_body = $('body');

        jQ_body.on('click', '.rg-ajax-accounting-sales-receipt-destroy', function (ev) {

            var _this = $(this);
            var callback = _this.data('callback');

            ev.stopPropagation();
            ev.preventDefault();

            rutatiina.transaction_delete({
                datatable: null,
                url: _this.attr('href'),
                method: 'POST',
                data: {_method: 'DELETE'},

                onSuccessCallback: function() {
                    if(callback) {
                        window.location.replace(callback);
                    }
                },
                onFailureCallback: function() {
                    //do nothing
                },

                title: "Are you sure?",
                text: "You will not be able to recover this Receipt!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });

        });
    };
    
    return {
        // public functions
        init: function() {

            init();
            contact_txns();
            //receipt_info();
            auto_pay();
            paid_in_full();
            clear_amounts();
            pay_all_fully();
            rate_change();
            total_change();
            total_details();
            on_base_currency_change();
            no_txns();

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
        on_submit: function (a) {
            on_submit(a);
        }
    };
}();

jQuery(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [5]
        }],
        //dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        dom: '<"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    rg_receipt.init();

});
