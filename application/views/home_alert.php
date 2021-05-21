<span class="alert_container">
    <div class="alert bg-<?php echo isset($alert)?$alert:'info'; ?>">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <?php echo $message; ?>
    </div>
</span>

