<?php

function rbs_godowns_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Godowns List</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=rbs_godowns_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        //$table_name = $wpdb->prefix . "godowns";
		$table_name ="godowns";
        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <!--<th class="manage-column ss-list-width">Shop ID</th>-->
                <th class="manage-column ss-list-width">Godown Name</th>
				<th class="manage-column ss-list-width">Address</th>
                <th class="manage-column ss-list-width">Phone No</th>
				<th class="manage-column ss-list-width">City</th>
				<th class="manage-column ss-list-width">State</th>
				<th class="manage-column ss-list-width">Country</th>
				<th class="manage-column ss-list-width">Pincode</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <!--<td class="manage-column ss-list-width"><?php // echo $row->shop_id; ?></td>-->
                    <td class="manage-column ss-list-width"><?php echo $row->godown_name; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->address; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->phone; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->city; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->state; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->country; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->pincode; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=rbs_godowns_update&id=' . $row->godown_id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}