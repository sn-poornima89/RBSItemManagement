<?php

function sinetiks_godowns_create() {
    //$id = $_POST["shop_id"];
    $name = $_POST["godown_name"];
	$address= $_POST["address"];
	$phone= $_POST["phone"];
	$city= $_POST["city"];
	$state = $_POST["state"];
	$country = $_POST["country"];
	$pincode = $_POST["pincode"];
	
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
       // $table_name = $wpdb->prefix . "godowns";
		$table_name = "godowns";
        $wpdb->insert(
                $table_name, //table
                array( 'godown_name' => $name, 'address' => $address, 'phone' => $phone, 'city' => $city, 'state' => $state, 'country' => $country, 'pincode' => $pincode,), //data
                array( '%s', '%s', '%s', '%s', '%s', '%s', '%s') //data format			
        );
        $message.="Godown inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Godown</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=sinetiks_godowns_list'); ?>">Godowns List</a>
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
                    <th class="ss-th-width">Godown Name</th>
                    <td><input type="text" name="godown_name"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Address</th>
                    <td><input type="text" name="address"  class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Phone No</th>
                    <td><input type="text" name="phone"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">City</th>
                    <td><input type="text" name="city"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">State</th>
                    <td><input type="text" name="state"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Country</th>
                    <td><input type="text" name="country"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Pincode</th>
                    <td><input type="text" name="pincode"  class="ss-field-width" /></td>
                </tr>
            </table>
			<br>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}