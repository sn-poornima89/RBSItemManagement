<?php

function rbs_shops_update() {
    global $wpdb;
    //$table_name = $wpdb->prefix . "school";
	$table_name = "shops";
    $id = $_GET["id"];
    $shop_name = $_POST["shop_name"];
	$address = $_POST["address"];
	$phone = $_POST["phone"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$country = $_POST["country"];
	$pincode = $_POST["pincode"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                //array('shop_name' => $shop_name),array('address' => $address),array('city' => $city),array('state' => $state),array('country' => $country),array('pincode' => $pincode), //data
                array('shop_name' => $shop_name,'address'=>$address,'phone'=>$phone,'city'=>$city,'state'=>$state,'country'=>$country,'pincode'=>$pincode),
				array('shop_id' => $id), //where
                //array('%s'),array('%s'),array('%s'),array('%s'),array('%s'),array('%s'), //data format
                array('%s','%s','%s','%s','%s','%s','%s'),
				array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE shop_id = %s", $id));
    } else {//selecting value to update	
        $schools = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where shop_id=%s", $id));
        foreach ($schools as $s) {
            $shop_name = $s->shop_name;
			$address = $s->address;
			$phone = $s->phone;
			$city = $s->city;
			$state = $s->state;
			$country = $s->country;
			$pincode = $s->pincode;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Update Shop</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Shops deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=rbs_shops_list') ?>">&laquo; Back to Shop list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Shops updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=rbs_shops_list') ?>">&laquo; Back to Shop list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Name</th><td><input type="text" name="shop_name" value="<?php echo $shop_name; ?>"/></td></tr>
					<tr><th>Address</th><td><textarea name="address"><?php echo $address; ?></textarea></td></tr>
                    <tr><th>Phone No</th><td><input type="text" name="phone" value="<?php echo $phone; ?>"/></td></tr>
					<tr><th>City</th><td><input type="text" name="city" value="<?php echo $city; ?>"/></td></tr>
					<tr><th>State</th><td><input type="text" name="state" value="<?php echo $state; ?>"/></td></tr>
					<tr><th>Country</th><td><input type="text" name="country" value="<?php echo $country; ?>"/></td></tr>
					<tr><th>Pincode</th><td><input type="text" name="pincode" value="<?php echo $pincode; ?>"/></td></tr>
                </table>
				<br>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <!-- <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure, You want to delete?')"> -->
            </form>
        <?php } ?>

    </div>
    <?php
}