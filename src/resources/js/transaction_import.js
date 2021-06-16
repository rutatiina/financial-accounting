/**
 * Created by rutatiina on 9/9/2017.
 */
rg_transaction_import = function () {

    var datatable_bank_accounts = function() {

        var dtable = $('.rg_datatable').DataTable({
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
            ajax: '/datatable/bank_accounts/',
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
            //info: false,
            //bLengthChange: false,
            //bFilter: false,
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": null, "sClass": "text-center" },
                { "mDataProp": "bank", "sClass": "" },
                { "mDataProp": "name", "sClass": "" },
                { "mDataProp": "number", "sClass": "" },
                { "mDataProp": 'code', "sClass": "text-left" },
                { "mDataProp": 'currency', "sClass": "text-left" },
                { "mDataProp": 'balance', "sClass": "text-right" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var action = '<ul class="icons-list">\
                    <li><a href="/banking/account/' + aData['id'] + '" title="Edit"><i class="icon-pencil7"></i></a></li> \
                </ul>';

                $('td:eq(1)', nRow).html(action);
            }
        });

        $('.navbar-fixed-top').on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

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

        return dtable;

    }

    var datatable_reconcile = function() {

        var dtable = $('.rg_datatable_reconcile').DataTable({
            pagingType: "simple",
            serverSide: true,
            fixedHeader: true,
            ajax: '/datatable/banking_reconciliations/',
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 50,
            aLengthMenu: [
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400],
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400]
            ],
            columnDefs: [
                {
                    'targets': 0,
                    "orderable": true,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;

                        }
                    },
                },
                /*{
                    'targets': [4, 5, 6],
                    "orderable": false
                }*/
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            aaSorting: [[0, 'asc']],
            order: [
                [0, 'asc']
            ],
            ordering: true,
            info: true,
            bLengthChange: true,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": "id", "sClass": "" },
                { "mDataProp": null, "sClass": "" },
                //{ "mDataProp": "status", "sClass": "" },
                { "mDataProp": "date", "sClass": "" },
                { "mDataProp": "value_date", "sClass": "" },
                { "mDataProp": "description", "sClass": "" },
                { "mDataProp": "reference", "sClass": "" },
                { "mDataProp": "debit", "sClass": "text-right" },
                { "mDataProp": "credit", "sClass": "text-right" },
                { "mDataProp": "balance", "sClass": "text-right" },
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(1)', nRow).html(
                    '<ul class="icons-list">' +
                        '<li><a href="#/'+aData['id']+'" class="accouting_add" title="Add transaction"><i class="icon-file-plus"></i></a></li>' +
                        '<li><a href="#/'+aData['id']+'" title="Search for transaction"><i class="icon-search4"></i></a></li>' +
                        '<li><a href="#/'+aData['id']+'" title="Re-auto reconsile"><i class="icon-loop3"></i></a></li>' +
                    '</ul> '
                );

                aData['_debit']      = (aData['debit'] > 0 ? rg_number_format(aData['debit'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');
                aData['_credit']     = (aData['credit'] > 0 ? rg_number_format(aData['credit'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');
                aData['_balance']    = (aData['balance'] > 0 ? rg_number_format(aData['balance'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');

                $('td:eq(6)', nRow).html(aData['_debit']);
                $('td:eq(7)', nRow).html(aData['_credit']);
                $('td:eq(8)', nRow).html(aData['_balance']);
            }
        });

        $('body').delegate('.accouting_add', 'click', function() {
            $("#modal_accouting_add").modal()
        });

        return dtable;

    }

    var datatable_que = function() {

        var dtable = $('.rg_datatable_que').DataTable({
            pagingType: "simple",
            processing: true,
            serverSide: true,
            fixedHeader: true,
            ajax: '/datatable/empty/',
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 25,
            aLengthMenu: [
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400],
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400]
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
                /*{
                    'targets': [4, 5, 6],
                    "orderable": false
                }*/
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            aaSorting: [[0, 'asc']],
            ordering: false,
            info: true,
            bLengthChange: true,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": "id", "sClass": "" },
                { "mDataProp": "status", "sClass": "text-semibold" },
                { "mDataProp": "txn_type_name", "sClass": "" },
                { "mDataProp": "number", "sClass": "" },
                { "mDataProp": "date", "sClass": "" },
                { "mDataProp": "total", "sClass": "text-right" },
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                aData['_total'] = rg_number_format(aData['total'], rg_decimal_places) + ' ' + aData['base_currency'];

                $('td:eq(4)', nRow).html(aData['_total']);

            },
            /*drawCallback : function(settings) {
                if ($(this).find('tbody tr').length<=1) {
                    //$(this).parent().hide(); console.log('Hide table');
                    $(this).parents('.dataTables_wrapper').hide(); //Hide the datatable  if not data is found
                }
            }*/
        });

        $('body').delegate('.accouting_add', 'click', function() {
            $("#modal_accouting_add").modal()
        });

        $('body').delegate('.banking_txn_sorting', 'click', function() {
            console.log('re drawing the table');
            var _url = $(this).data('ajax');
            dtable.ajax.url(_url).load();
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

                                    $('.rg_datatable_onselect_btns').hide();
                                    $('.page-header').show();

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

    var datatable_transaction_rules = function() {

        var dtable = $('#rg_import_rules').DataTable({
            pagingType: "simple",
            //serverSide: true,
            //fixedHeader: true,
            //ajax: '/datatable/banking_transaction_rules/',
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 25,
            aLengthMenu: [
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400],
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400]
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
                                $('.rg_transaction_import_rules_onselect_btns').slideDown(100);
                                $('.page-header').slideUp(100);
                            } else {
                                $('.rg_transaction_import_rules_onselect_btns').slideUp(100);
                                $('.page-header').slideDown(100);
                            }

                        }
                    },
                },
                /*{
                    'targets': [4, 5, 6],
                    "orderable": false
                }*/
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            aaSorting: [[0, 'asc']],
            ordering: false,
            info: true,
            bLengthChange: true,
            //bFilter: false,
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
                                    //dtable.ajax.reload();

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

        /*
        $('body').delegate('.accouting_add', 'click', function() {
            $("#modal_accouting_add").modal();
        });

        $('body').delegate('.banking_txn_sorting', 'click', function() {
            console.log('re drawing the table');
            var _url = $(this).data('ajax');
            dtable.ajax.url(_url).load();
        });
        */

        return dtable;

    }

    var criteria_add = function() {

        var template = $('#transaction_rule_criteria_fields');

        var key = $('.transaction_rule_criteria_fields').length; //console.log(key);

        var rg_clone = template.clone();

        //remove the item_row_template class
        rg_clone.removeAttr('id');
        rg_clone.removeClass('hidden');
        rg_clone.attr('data-key', 'row_'+key);

        rg_clone.find("select, input").each(function() {
            var _name = $(this).attr("name");
            $(this).attr("name", _name.replace("[_]", '['+key+']'));
        });

        $("#transaction_rule_criteria_add").before(rg_clone);

        rg_clone.find("select").select2({});

    }

    var form_ajax_submit = function (form_id, form_reset) {

        form_reset = typeof form_reset !== 'undefined' ? form_reset : true;

        console.log('Ajax processing form: ' + form_id + ', form_reset: ' + form_reset);

        var form = $(form_id);

        //Prepare the notification
        PNotify.removeAll();
        rg_pnotify = new PNotify(rg_pnotify_options.initiate);

        var data = form.serializeArray();

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

                    $('.dropdown-title:first').trigger('click'); //triggers redraw of the table

                    if (form_reset === true) {
                        $('[name=_transaction_id]').val('');
                        form.trigger("reset");
                        form.find(".select-search, .select").val("").trigger('change');
                        $('.hide-sidebar-opposite').trigger('click'); //hide the right sidebar
                    }

                }
                else {

                    rg_pnotify_options.error.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.error);
                }

            }
        });

    }

    var init = function () {

        $('.bank_transaction li a').click(function () {
            //Hide all the tabs
            $('.tabbable [id^=tabs_]').addClass('hidden');
            $('.tabbable #tabs_add_transaction').removeClass('hidden');
            $('.sidebar-opposite').removeClass('hidden');
            $('.sidebar-opposite .txn_form_panel').addClass('hidden');
            $($(this).attr('href')).removeClass('hidden');
            $($(this).attr('href')).find('.panel-heading').removeClass('hidden');
            $($(this).attr('href')).find('form').trigger("reset");
            $('.transactions_tax_form_fields').removeClass('hidden');
            $('#banking_category_money_out, #banking_category_money_in').addClass('hidden');
            $('.banking_item_rate').removeClass('text-danger').prop("readonly", false);
            $('[name=_transaction_id]').val('');
            $('[name=_transaction_status]').val('');
        });

        $('[name=banking_category_money_out], [name=banking_category_money_in]').change(function () {
            $('.txn_form_panel:not(.txn_category_panel)').addClass('hidden');
            $($(this).val()).removeClass('hidden');
            $($(this).val()).find('.panel-heading').addClass('hidden');
        });

        $('.hide-sidebar-opposite').click(function () {
            $('.sidebar-opposite').addClass('hidden');
            $('.sidebar-opposite .txn_form_panel').addClass('hidden');
        });

        $('.import_from_desktop').click(function () {
            console.log('Choose file to import');
            $('#file_to_import').click();
        });

        /*document.getElementById('file_to_import').onchange = function () {
            $('#file_to_import_name').html(this.value);
        };*/

        $('#transaction_rule_form [name=apply_to]').click(function() {
            var _this = $(this);
            $('#transaction_rule_deposit_process_as_row, #transaction_rule_withdraw_process_as_row').addClass('hidden');
            if(_this.is(':checked')) {
                $('#transaction_rule_'+_this.val()+'_process_as_row').removeClass('hidden');
            }
        });

        $('#file_to_import').change(function () {
            var n = $(this).val();
            n = n.replace(/.*[\/\\]/, '');
            $('#file_to_import_name').html(n);
        });

        $('body').delegate('#transaction_rule_deposit_process_as_field, #transaction_rule_withdraw_process_as_field', 'change', function () {
            var v = $(this).val();
            $("._options").addClass('hidden');

            if (rg_empty(v)) {
                $('._options').addClass('hidden');
            } else {
                $('#' + v + '_fields').toggleClass('hidden');
            }
        });

        $('body').delegate('#transaction_rule_criteria_add a', 'click', function () {
            criteria_add();
        });

        $('body').on( "mouseenter", '.banking_transactions_possible_matches button', function() {
            $(this).removeClass('btn-default').addClass('btn-success text-semibold');
        });
        $('body').on( "mouseleave", '.banking_transactions_possible_matches button', function() {
            $(this).removeClass('btn-success text-semibold').addClass('btn-default');
        });

        $(".dropdown .dropdown-menu").on('click', 'li a', function(){
            $(this).parents('.dropdown').find('.dropdown-title').html($(this).html()).data('ajax', $(this).data('ajax'));
        });

        $('body').on( "click", 'button.banking_transaction_match', function() {
            var _this = $(this);

            PNotify.removeAll();
            rg_pnotify = new PNotify(rg_pnotify_options.initiate);

            $.ajax({
                url: '/banking/transactions/'+_this.data('financial_account_code')+'/match/',
                method: 'POST',
                data: { _financial_account_code: _this.data('financial_account_code'), _bank_transaction_id: _this.data('bank_transaction'), _transaction_id: _this.data('transaction') },
                dataType: "json",
                success: function(response, status, xhr, $form) {
                    //console.log(response);
                    if (response.status === true) {
                        rg_pnotify_options.success.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.success);
                        $('#transaction_matches tbody').html('');
                        $('.hide-sidebar-opposite').trigger('click'); //hide the right sidebar
                        $('.dropdown-title:first').trigger('click'); //triggers redraw of the table
                    } else {
                        rg_pnotify_options.error.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.error);
                    }
                }
            });

        });

    }

    return {
        // public functions
        init: function() {

            init();
            criteria_add(); //add the 1st criteria

            try {
                datatable_reconcile();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_que();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_bank_accounts();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_transaction_rules();
            } catch (e) {
                console.log(e);
            }

        },

        form_ajax_submit: function(form_id, form_reset) {
            form_ajax_submit(form_id, form_reset);
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
        dom: '<"datatable-scroll-wrap"t><"datatable-footer"ipr>',
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

    rg_transaction_import.init();

});
    