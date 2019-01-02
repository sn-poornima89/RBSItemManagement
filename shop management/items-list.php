<?php

function rbs_items_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Items Report</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=rbs_items_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        //$table_name = $wpdb->prefix . "godowns";
		$table_name ="items";
        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <!--<th class="manage-column ss-list-width">Shop ID</th>-->
                <th class="manage-column ss-list-width">Item Name</th>
				<th class="manage-column ss-list-width">Item Quantity </th>
                <th class="manage-column ss-list-width">From</th>
				<th class="manage-column ss-list-width">To</th>
				<th class="manage-column ss-list-width">Date</th>
				<th class="manage-column ss-list-width">Created</th>
				<th class="manage-column ss-list-width">Updated</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <!--<td class="manage-column ss-list-width"><?php // echo $row->shop_id; ?></td>-->
                    <td class="manage-column ss-list-width"><?php echo $row->item_product_id; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->item_quantity; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->item_from_id; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->item_to_id; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->item_date; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->item_created; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->item_updated; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=rbs_items_update&id=' . $row->item_id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}