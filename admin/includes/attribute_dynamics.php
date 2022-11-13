<?php


function attribute_table($table_id)
{

    $title = ['Template', 'Action'];

    if ($table_id == 'mount_types') {
        $title  = ['Mount Name', 'Status', 'Action'];
    } else if ($table_id == 'lift_styles') {
        $title  = ['Style Name', 'Status', 'Action'];
    } else if ($table_id == 'headrails') {
        $title  = ['Headrail Name', 'Status',  'Action'];
    } else if ($table_id == 'product_varient_color') {
        $title  = ['Color Name', 'Image', 'Status', 'Action'];
    } else if ($table_id == 'warranty') {
        $title  = ['Name', 'Status', 'Action'];
    } else if ($table_id == 'product_category') {
        $title  = ['Category Name', 'Image', 'Status', 'Action'];
    }



?>
    <div class="table-responsive mt-5">
        <table id="<?php echo $table_id; ?>_datatable" class="table <?php echo $table_id; ?>_datatable" data-toggle="data-table">
            <thead>
                <tr class="table-dark">
                    <?php foreach ($title as $t) { ?>
                        <th><?php echo $t; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>



            </tbody>
            <tfoot>
                <tr class="table-dark" id="<?php echo $table_id; ?>_footer">
                    <?php foreach ($title as $t) { ?>
                        <th><?php echo $t; ?></th>
                    <?php } ?>
                </tr>
            </tfoot>
        </table>
    </div>
<?php } ?>