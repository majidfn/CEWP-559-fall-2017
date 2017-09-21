# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    config.vm.box = "ubuntu/trusty64"

    # Mount shared folder using NFS
    config.vm.synced_folder ".", "/vagrant", type: "nfs"

    # Port forwarding and network configuration
    config.vm.network "forwarded_port", guest: 80, host: 8080
    config.vm.network "forwarded_port", guest: 3306, host: 3306
    config.vm.network "private_network", ip: "192.168.100.100"

    config.vm.provision :shell, :path => "build/vagrant/provision.sh"

end