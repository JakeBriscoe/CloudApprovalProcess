# -*- mode: ruby -*-
# vi: set ft=ruby :

# Fixes bug is CS labs
class Hash
  def slice(*keep_keys)
    h = {}
    keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
    h
  end unless Hash.method_defined?(:slice)
  def except(*less_keys)
    slice(*keys - less_keys)
  end unless Hash.method_defined?(:except)
end

Vagrant.configure("2") do |config|
  # AWS provider does not require a box, so we use a dummy
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|
    # Environment configuaration parameters for access to AWS
    aws.access_key_id = ENV["AWS_ACCESS_KEY_ID"]
    aws.secret_access_key =  ENV["AWS_SECRET_ACCESS_KEY"]
    aws.session_token =  ENV["AWS_SESSION_TOKEN"]

    # Amazon Educate region
    aws.region = "us-east-1"

    # These options force synchronisation of files to the VM's
    # /vagrant directory using rsync, rather than using trying to use
    # SMB (which will not be available by default).
    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

    # User specific variables below

    # Name of key pair
    aws.keypair_name = "cosc349-asgn2"
    # Location of key pair
    override.ssh.private_key_path = "~/.ssh/cosc349-asgn2.pem"

    aws.instance_type = "t2.micro"

    # Security group allowing inbound and outbound connections without restriction
    # Below we have ssh access, web access, and RDS access
    # aws.security_groups = ["sg-0d7e4e8332bcba5ef", "sg-05bcf6d581bc9f707", "sg-089ac0901305ec53b"] # Regan
    aws.security_groups = ["sg-03eabd1f67ea5102e", "sg-04e5ff82033e54bb8", "sg-0ca507193372892d5"] # Jake

    # For Vagrant to deploy to EC2 for Amazon Educate accounts, it
    # seems that a specific availability_zone needs to be selected
    # (will be of the form "us-east-1a"). The subnet_id for that
    # availability_zone needs to be included, too (will be of the form
    # "subnet-...").

    #  A Amazon Educate availability zone and subnet id
    aws.availability_zone = "us-east-1a"
    # aws.subnet_id = "subnet-5621f930" # Regan
    aws.subnet_id = "subnet-c9b01496" # Jake

    # Makes it a Ubuntu VM
    aws.ami = "ami-07a985bed28dfbc01"

    # Makes Vagrant connect with "ubuntu" default username
    override.ssh.username = "ubuntu"

  end

  config.vm.define "webadmin" do |webadmin|

     webadmin.vm.hostname = "webadmin"

     # Enable provisioning with a shell script. Additional provisioners such as
     # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
     # documentation for more information about their specific syntax and use.
     webadmin.vm.provision "shell", inline: <<-SHELL
       apt-get update
       # Install Apache and PHP
       apt-get install -y apache2 php libapache2-mod-php php-mysql

       sudo su
       # Uncomment lines 890 and 894 from php.ini
       sed -i '890s/^.//' ../../etc/php/7.0/cli/php.ini
       sed -i '894s/^.//' ../../etc/php/7.0/cli/php.ini
       # Move admin web files
       mv ../../vagrant/admin/* ../../var/www/html/
       # Remove user web files
       rm -r ../../vagrant/user
       exit
       # Restart apache for changes in php.ini file to take affect
       sudo service apache2 restart

       SHELL

   end

   config.vm.define "webuser" do |webuser|

     webuser.vm.hostname = "webuser"

     # Enable provisioning with a shell script. Additional provisioners such as
     # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
     # documentation for more information about their specific syntax and use.
     webuser.vm.provision "shell", inline: <<-SHELL
       apt-get update
       # Install Apache and PHP
       apt-get install -y apache2 php libapache2-mod-php php-mysql

       sudo su
       # Uncomment lines 890 and 894 from php.ini
       sed -i '890s/^.//' ../../etc/php/7.0/cli/php.ini
       sed -i '894s/^.//' ../../etc/php/7.0/cli/php.ini
       # Move admin web files
       mv ../../vagrant/user/* ../../var/www/html/
       # Remove admin web files
       rm -r ../../vagrant/admin
       exit
       # Restart apache for changes in php.ini file to take affect
       sudo service apache2 restart

       SHELL

   end

end
