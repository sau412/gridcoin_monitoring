<?php
// Only for command line
if(!isset($argc)) die();

// Gridcoin RPC variables
$grc_rpc_host="";
$grc_rpc_port="";
$grc_rpc_login="";
$grc_rpc_password="";

// Send query to gridcoin client
function grc_rpc_send_query($query) {
        global $grc_rpc_host,$grc_rpc_port,$grc_rpc_login,$grc_rpc_password;
        $ch=curl_init("http://$grc_rpc_host:$grc_rpc_port");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_POST,TRUE);
        curl_setopt($ch,CURLOPT_USERPWD,"$grc_rpc_login:$grc_rpc_password");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
        $result=curl_exec($ch);
        curl_close($ch);

        return $result;
}

// Get network info
function grc_rpc_get_network_info() {
        $query='{"id":1,"method":"getinfo","params":[]}';
        $result=grc_rpc_send_query($query);
        $data=json_decode($result);
        return $data->result;
}

// Get mining info
function grc_rpc_get_mining_info() {
        $query='{"id":1,"method":"getmininginfo","params":[]}';
        $result=grc_rpc_send_query($query);
        $data=json_decode($result);
        return $data->result;
}

// Get mining info
$mining_data=grc_rpc_get_mining_info();

// Get network info
$network_data=grc_rpc_get_network_info();

// Get specific variables
$blocks=$mining_data->blocks;
$diff=$mining_data->difficulty->{"proof-of-stake"};
$moneysupply=$network_data->moneysupply;
$netgrcweight=$mining_data->netstakingGRCvalue;

// Show variables in cacti-readable format
echo "blocks:$blocks diff:$diff netgrcweight:$netgrcweight moneysupply:$moneysupply\n";

?>
