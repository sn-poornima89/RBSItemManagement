<?php

function rbs_items_update() {
    global $wpdb;
    //$table_name = $wpdb->prefix . "school";
	$table_name ="items";
    $id = $_GET["id"];
    $item_pid = $_POST["item_pid"];
	$item_quantity= $_POST["item_qty"];
	$item_from= $_POST["item_from_id"];
	$item_to= $_POST["item_to_id"];
	$item_date = $_POST["item_date"];

	$item_updated = date('Y-m-d H:i:s');
	
	
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('item_product_id' => $item_pid,'item_quantity'=>$item_quantity,'item_from_id'=>$item_from,'item_to_id'=>$item_to,'item_date'=>$item_date,'item_updated'=>$item_updated),
				array('item_id' => $id), //where
                array('%s','%s','%s','%s','%s','%s'),
				array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE item_id = %s", $id));
    } else {//selecting value to update	
        $items = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where item_id=%s", $id));
        foreach ($items as $s) {
            $item_name = $s->item_product_id;
			$item_quantity = $s->item_quantity;
			$item_from_id = $s->item_from_id;
			$item_to_id = $s->item_to_id;
			$item_date = $s->item_date;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Update Item Report</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Item Report deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=rbs_items_list') ?>">&laquo; Back to Item Reports</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Item Report updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=rbs_items_list') ?>">&laquo; Back to Item Reports</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Product Name</th><td><input type="text" name="item_pid" value="<?php echo $item_pid; ?>"/></td></tr>
					<tr><th>Product Quantity</th><td><textarea name="item_qty"><?php echo $item_qty; ?></textarea></td></tr>
                    <tr><th>Item From</th><td><input type="text" name="item_from_id" value="<?php echo $item_from_id; ?>"/></td></tr>
					<tr><th>Item To</th><td><input type="text" name="item_to_id" value="<?php echo $item_to_id; ?>"/></td></tr>
					<tr><th>Date</th><td><input type="text" name="item_date" value="<?php echo $item_date; ?>"/></td></tr>
					<tr><th>Item Created</th><td><input type="text" name="item_created" value="<?php echo $item_created; ?>"/></td></tr>
					<tr><th>Item Updated</th><td><input type="text" name="item_updated" value="<?php echo $item_updated; ?>"/></td></tr>
                </table>
				<br>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <!-- <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure, You want to delete?')"> -->
            </form>
        <?php } ?>

    </div>
    <?php
}