<script type="text/javascript">
$(document).ready(function() {
    $('#students').DataTable({
        "processing": true,
        "serverSide": true,


        "dom": "<'row'<'col-md-8 col-sm-12 table-group-actions'><'col-md-4 col-sm-12'<' pull-right' f>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

        "scrollX": true,

        "pageLength": 10, 

        "ajax": {
            url: "<?php echo base_url('ajax_try/get_students/') ?>",
            type : 'GET'
        },
        "columnDefs": [
            {
            "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
                    orderable: false
                },
            ]
    });
});
</script>