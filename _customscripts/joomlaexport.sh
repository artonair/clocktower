#!/bin/bash

#mysql -ugeops1 -p artonair_joomla -e "SELECT * FROM wps1_newsite_content WHERE created between '2010-08-28' and '2010-11-30' INTO OUTFILE '/web/staging.artonair.org/htdocs/drupal/_customscripts/joomlaexport.csv' FIELDS TERMINATED BY '|' LINES TERMINATED BY '\r\n';"
mysql -ugeops1 -p artonair_joomla -e "SELECT * FROM wps1_newsite_content WHERE created between '2010-08-28' and '2010-12-10' INTO OUTFILE '/web/staging.artonair.org/htdocs/drupal/_customscripts/joomlaexport.csv' FIELDS TERMINATED BY '|*|' LINES TERMINATED BY '|***|';"

