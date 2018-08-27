# Gridcoin monitoring
Read gridcoin network info and export them into cacti format

# How to use
See https://steemit.com/gridcoin/@sau412/gridcoin-network-monitoring-with-cacti

Here is copy of steemit article:
# Introduction

Sometimes you want to know if something interesting happens in Gridcoin network. Here is instruction how to create graphs for interesting parameters with cacti. It will be looks like that:
Requirements

* Gridcoin research client (RPC also possible)
* Linux, Apache, MySQL, php
* Cacti (sudo apt-get install cacti)
* Script get_gridcoin_info_cli.php from https://github.com/sau412/gridcoin_monitoring

# How to setup
## Script

Copy get_gridcoin_info_cli.php to your cacti scripts folder, for my ubuntu it is:

    /usr/share/cacti/site/scripts/

And set your gridcoin folder variable in get_gridcoin_info_cli.php. Also your gridcoin folder should be accessible for user www-data.

# Cacti

Cacti is RRDTool-based Graphing Solution. In simple words it can draw graphs. Usually it draw interface load, CPU load, user count. Now we add Gridcoin network stats here.
## Adding data input

* Data collection -> Data input methods
* Click 'New' (or plus in right top corner)
* Name 'Get gridcoin network info'
* Input type Script/Command
* Command 'php <path_cacti>/get_gridcoin_info.php'
* Click 'Save'
* Add output fields: 'blocks', 'diff', 'moneysupply', 'netgrcweight' with friendly names

## Adding data source template

* Templates -> New (or plus in right top corner)
* Name 'Gridcoin - Blocks'
* Data input method 'Get gridcoin network info'
* Data source type 'GAUGE' for difficulty and net weight, 'COUNTER' for blocks and money supply.
* Internal Data Source Name 'blocks'
* Click 'Create'
* Set 'Output field' to 'blocks'
* Click 'Save'
* Create data sources for 'diff', 'moneysupply', 'netgrcweight' is the same way

## Adding graph template

* Templates -> Graph
* Set name 'Gridcoin - Blocks'
* Set title 'Gridcoin - Blocks'
* Click 'Create'
* Add Graph Template Items on the top
* Set data source 'Gridcoin - Blocks'
* Set color, line or area you want
* Click 'Create'
* Create grapth templates for 'diff', 'moneysupply', 'netgrcweight' is the same way

## Adding graphs

* Create -> New graphs
* Select 'Gridcoin - Blocks' and click 'Create'
* Select 'Gridcoin - Difficulty' and click 'Create'
* Select 'Gridcoin - Money supply' and click 'Create'
* Select 'Gridcoin - Net weight' and click 'Create'
* Done.

## View graphs

Open 'Graphs' tap on the top. After 10-20 minutes first strokes should appear on the graphs. In day or two you can open 'Graphs' tab to view your pretty graphs.

Notes:

* Money supply currently not changing. I don't know what exactly it means.
* In blocks graph you see milliblocks per second:)

That's all! Thanks for reading.
