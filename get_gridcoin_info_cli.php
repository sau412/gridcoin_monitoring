<?php
// Only for command line
if(!isset($argc)) die();

// Gridcoin data directory
$grc_data_dir="/home/USERNAME/.GridcoinResearch";

// Send query to gridcoin client
function grc_rpc_send_query($query) {
        global $grc_data_dir;
        $result=shell_exec("gridcoinresearchd -datadir='$grc_data_dir' $query");
        echo $result;
        return $result;
}

// Get network info
function grc_rpc_get_network_info() {
        $query="getinfo";
        $result=grc_rpc_send_query($query);
        $data=json_decode($result);
        return $data;
}

// Get network info
function grc_rpc_get_mining_info() {
        $query="getmininginfo";
        $result=grc_rpc_send_query($query);
        $data=json_decode($result);
        return $data;
}


$mining_data=grc_rpc_get_mining_info();

$network_data=grc_rpc_get_network_info();

$blocks=$mining_data->blocks;
$diff=$mining_data->difficulty->{"proof-of-stake"};
$moneysupply=$network_data->moneysupply;
$netgrcweight=$mining_data->netstakingGRCvalue;

echo "blocks:$blocks diff:$diff netgrcweight:$netgrcweight moneysupply:$moneysupply\n";

?>
