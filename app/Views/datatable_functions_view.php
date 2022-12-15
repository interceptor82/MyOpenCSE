dataTable.buttons().container()
                        .appendTo($('.col-md-6:eq(0)', dataTable.table().container()));

                jQuery.fn.DataTable.ext.type.search.string = function (data) {
                    return !data ?
                            '' :
                            typeof data === 'string' ?
                            data
                            .replace(/έ/g, 'ε')
                            .replace(/ύ/g, 'υ')
                            .replace(/ό/g, 'ο')
                            .replace(/ώ/g, 'ω')
                            .replace(/ά/g, 'α')
                            .replace(/ί/g, 'ι')
                            .replace(/ή/g, 'η')
                            .replace(/\n/g, ' ')
                            .replace(/á/g, 'a')
                            .replace(/é/g, 'e')
                            .replace(/í/g, 'i')
                            .replace(/ó/g, 'o')
                            .replace(/ú/g, 'u')
                            .replace(/ê/g, 'e')
                            .replace(/î/g, 'i')
                            .replace(/ô/g, 'o')
                            .replace(/è/g, 'e')
                            .replace(/ï/g, 'i')
                            .replace(/ü/g, 'u')
                            .replace(/ã/g, 'a')
                            .replace(/õ/g, 'o')
                            .replace(/ç/g, 'c')
                            .replace(/ì/g, 'i') :
                            data;
                };





                //repopulate forms
                var state = dataTable.state.loaded();
                if (state) {
                    dataTable.columns().eq(0).each(function (colIdx) {
                        var colSearch = state.columns[colIdx].search;

                        if (colSearch.search) {
                            var i
                            for (i = 0; i < <?php echo $max_column; ?>; i++) {
                                if (colIdx === i) {
                                    $('input[name="<?php echo $repopulate_column_name; ?>' + (i-1) + '"]').val(colSearch.search);
                                    $('select[name="<?php echo $repopulate_column_name; ?>' + (i-1) + '"]').val(colSearch.search);
                                }
                            }
                        }
                    });
                }
                ;



                dataTable.columns().every(function () {
                    var that = this;
                    //for input
                    $('input', this.footer()).on('keyup change', function (e) {
                        if (e.keyCode === 13) { //la recherche s'effectue en appuyant sur entrée
                            if (that.search() !== this.value) {
                                that
                                        .search(this.value)
                                        .draw();

                            }
                        }
                    });
                    //for select
                    $('select', this.footer()).on('change', function (e) {
                        if (that.search() !== this.value) {
                            that
                                    .search(this.value)
                                    .draw();

                        }

                    });
                });




                new $.fn.dataTable.ColReorder(dataTable, {
                    // options
                });
//    
//                Hide unique search
                $("#<?php echo $datatable_id; ?>_filter").css("display", "none");