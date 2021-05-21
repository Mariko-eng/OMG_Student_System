<script>
    $(document).ready(function() {
        var dataTable = $("#users").DataTable({ // here you can define a typical datatable settings from http://datatables.net/usage/options
            "processing": true,
            "serverSide": true,
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
            // So when dropdowns used the scrollable div should be removed.
            "dom": "<'row'<'col-md-8 col-sm-12 table-group-actions'><'col-md-4 col-sm-12'<' pull-right' f>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [10, 20, 50, 100, 150, -1],
                [10, 20, 50, 100, 150, "All"] // change per page values here
            ],
            "pageLength": 10, // default record count per page
            "scrollX":true,
            "ajax": {
                "url": "<?php echo base_url('index.php/ajax_api/users/') ?>", // ajax source
                "type": "POST",
                //'data': function(data){
                    // Read values
                    //var status = $('#status').val();
                    //var type = $('#type').val();
                    //var available_from = $('#available_from').val();
                    //var category = $('#category').val();

                    // Append to data
                    //data.status = status;
                    //data.type = type;
                    //data.available_from = available_from;
                    //data.category = category;
                //}
            },
            "order": [ 
                [0, "desc"]
            ],// set first column as a default sort by asc
            "columnDefs": [
                {
                    "targets": [0,3,4,5,6,8],
                    orderable: false
                },
            ] 
        });
        $('#filter-submit').click(function(){
            dataTable.draw();
        });
        const datepicker = new TheDatepicker.Datepicker(input);
        datepicker.options.setInputFormat('Y-m-d');
        datepicker.render();
    });
</script>