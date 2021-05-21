<script type="text/javascript">
$(document).ready(function() {
    $('#users').DataTable({
        "processing": true,
        "serverSide": true,

        "dom": "<'row'<'col-md-8 col-sm-12 table-group-actions'><'col-md-4 col-sm-12'<' pull-right' f>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

        "pageLength": 10,
        "scrollX": true,

        "ajax": {
            url: "<?php echo base_url('ajax_try/get_users/') ?>",
            type : 'GET'
        },

        "order": [ 
                [0, "desc"]
            ],// set first column as a default sort by asc
            "columnDefs": [
                {
                    "targets": [0,1,2,3,4,5,6],
                    orderable: false
                },
            ]
    });
});
</script>