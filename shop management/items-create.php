<?php

function rbs_items_create() {
    $item_pid = $_POST["item_pid"];
	$item_quantity= $_POST["item_qty"];
	$item_from= $_POST["item_from_id"];
	$item_to= $_POST["item_to_id"];
	$item_date = $_POST["item_date"];
	$item_created = date('Y-m-d H:i:s');
	$item_updated = date('Y-m-d H:i:s');
	
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
       // $table_name = $wpdb->prefix . "godowns";
		$table_name = "items";
        $wpdb->insert(
                $table_name, //table
                array( 
						'item_product_id' => $item_pid,
						'item_quantity' => $item_quantity, 
						'item_from_id' => $item_from, 
						'item_to_id' => $item_to, 
						'item_date' => $item_date, 
						'item_created' => $item_created, 
						'item_updated' => $item_updated,), //data
                array( '%s', '%s', '%s', '%s', '%s', '%s', '%s') //data format			
        );
        $message.="Item Report inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Item Report</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=rbs_items_list'); ?>">Item Report</a>
            </div>
            <br class="clear">
        </div>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <!--<p>Three capital letters for the ID</p>-->
            <table class='wp-list-table widefat fixed'>
               <!-- <tr>
                    <th class="ss-th-width">ID</th>
                    <td><input type="text" name="shop_id" class="ss-field-width" /></td>
                </tr>
                <tr>-->
                    <th class="ss-th-width">Item Name</th>
                    <td><input type="text" name="godown_name"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Item Quantity</th>
                    <td><input type="text" name="address"  class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Item From </th>
                    <td><input type="text" name="phone"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Item To </th>
                    <td><input type="text" name="city"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Date</th>
                    <td><input type="text" name="state"  class="ss-field-width" /></td>
                </tr>
				
            </table>
			<br>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}