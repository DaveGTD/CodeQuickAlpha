
sudo apt-get update

// change timezone
dpkg-reconfigure tzdata

sudo apt-get install -y vim git tree
sudo apt-get install -y default-jdk
sudo apt-get install lamp-server^
sudo apt-get install php7.0-xml
// prompts for MySQL root password => save it



mkdir /uploads/
chmod 777 /uploads/
mkdir /tmp_downloads/
chmod 777 /tmp_downloads/


git --version
java -version
php --version


git config --global credential.helper "cache --timeout=3600"


// copy credentials to server: => azure_functions.php


// copy cron scripts to /root/
// copy jars to /root/
chmod 777 <scripts>
// crontab -e



service apache2 restart
