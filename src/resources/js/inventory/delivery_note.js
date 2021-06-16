/**
 * Created by t on 9/9/2017.
 */
rg_delivery_note = function() {

    var datatable_sidebar = function() {

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
            info: false,
            bLengthChange: false,
            //bFilter: false, //to allow search
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": "number", "sClass": "pointer " },
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

        $('.sidebar-secondary').on('click', '.rg_datatable_selected_delete', function(ev) {

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
                text: "You will not be able to recover this transaction(s)!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });

        });

        if (_table.is(':visible')) {
            $('#navbar_top_search').keypress(function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    dtable.search($(this).val()).draw() ;
                }
            });
        }
    }

    var datatable_txns = function() {

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
                                $('.rg_datatable_onselect_btns').slideDown(100);
                                $('.page-header').slideUp(100);
                            } else {
                                $('.rg_datatable_onselect_btns').slideUp(100);
                                $('.page-header').slideDown(100);
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
            processing: true,
            serverSide: true,
            //info: false,
            //bLengthChange: false,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": "date", "sClass": "pointer " },
                { "mDataProp": "number", "sClass": "pointer " },
                { "mDataProp": "reference", "sClass": "pointer " },
                { "mDataProp": 'contact_name', "sClass": "pointer " }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                if (!rg_empty(aData['app'])) {
                    $('td:eq(0)', nRow).find("input[type=checkbox]").attr("disabled", true);
                }

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

        $('body').on('click', '.rg_datatable_selected_export_to_excel', function(ev) {

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

    return {
        // public functions
        init: function() {
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

        }
    };
}();

jQuery(document).ready(function() {

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


    rg_delivery_note.init();

});