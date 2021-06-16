/**
 * Created by t on 9/9/2017.
 */
rg_drafts = function() {
    
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
            aoColumns: [
                { "mDataProp": 'id', "sClass": "pr-5" },
                { "mDataProp": null, "sClass": "text-center pl-0 pr-0" },
                { "mDataProp": "txn_entree_name", "sClass": "" },
                { "mDataProp": "txn_type_name", "sClass": "" },
                { "mDataProp": "date_time", "sClass": "" },
                { "mDataProp": 'contact_name', "sClass": "text-right" },
                { "mDataProp": 'reference', "sClass": "text-right" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var action = '<ul class="icons-list">\
                    <li><a href="' + aData['edit_link'] + 'draft/' + aData['id'] + '"><i class="icon-pencil7"></i></a></li> \
                </ul>';

                $('td:eq(1)', nRow).html(action);
                //$('td:eq(2)', nRow).html('<a href="/sales/estimates/' + aData['id'] + '">' + aData['number'] + '</a>');
                //$('td:eq(7)', nRow).html(rg_number_format(aData['total']) + ' ' + aData['base_currency']);

                if (!rg_empty(aData['app'])) {
                    $('td:eq(0)', nRow).find("input[type=checkbox]").attr("disabled", true);
                }
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


    rg_drafts.init();

});