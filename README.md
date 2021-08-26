# Mysql-Tables-Synchronizer
The small PHP script for synchronizing preselected tables between two separate MySQL databases. 

Requirements:
PHP>=5.4, MySQLi

How to use it:

 1. In the config.php
  - add credentials for source and target databases
  - add comma-separated tables that you want to be synchronized between databases
  
2. Execute index.php manually or using cron job.
