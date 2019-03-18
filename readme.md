# Easy, secure & fast WordPress install

<img src="imgs/wp.png" alt="wordpress logo" width="250" height="250" align="right">

The objective of this repository is to give you an easy way of installing WordPress. Why? Having a wp server isn't just php + wp files. What about the cache, https, security, plugins, etc?

The features of this repo are:

* Installation of `apache` + `php` 7.2.
* All typically required `php` modules are installed.
* The database is set up in the same server: `mysql` 8.
* Strong and aggressive cache and minification is done via [PageSpeed](https://developers.google.com/speed/) and pre-installed plugins.
* SEO optimization:
    * Nice urls pre configured.
    * SEO plugins pre installed.
* HTTPS ready with [Let’s Encrypt certificates](https://letsencrypt.org/).
* Security in mind.
    * Firewall.
    * [fail2ban](https://www.fail2ban.org).
    * Strong salting and user/passwords.

The code here is written using [Ansible](https://www.ansible.com/) and [Python 3](https://www.python.org/). And the assumptions are the following:

* You are running in linux machine (Ansible doesn't work under windows).
* You have **root** access to a **ubuntu** server.
* The server has at least 1GB of ram. It wont last a long time running with 512MB or less.

## Usage - quick guide

To install WordPress just to which you already can connect via `ssh` as `root`:

```
$ ./install [your-server-ip]
```

With your A records pointing to your server you can add https with:

```
$ ./install [server-ip] https [domain] [your-email]
```

Inside your instance logged as `root`, retrieve the user and password to login into your new WordPress installation:

```
$ cat /root/passwords/ADMIN_USER
... admin user output ...
$ cat /root/passwords/ADMIN_PASSWORD
... admin password output ...
```

You have your new WordPress installation up and running!

## Usage - step by step

### 0 - Get your *own* server
Most provably you already have your own server, vps, or whatever. If you don't there are many cheap cloud providers for that:

* [Digital Ocean](https://m.do.co/c/288a30cfeece): Very easy, and with free 100 USD for 60 days.
* [AWS LightSail](https://aws.amazon.com/lightsail/): Easy, but with limited functionality.
* [AWS EC2](https://aws.amazon.com/ec2/): Hard, but with extreme flexibility.

### 1 - Check that you can connect
First you need to be able to connect via `ssh` as `root` without specifying manually the key. Like this:

```shell
ssh-add [your-key-path]
ssh root@[your-server-ip]
```

Is very important that you can connect in this way, because the scripts rely on this to work. Also user/password logging will be disabled for security.

If you can connect to your server as root, you are ready to go. Then continue in the next section.

If you had problems connecting:

* `Could not resolve hostname ...`: Try typing the ip.
* `Permission denied (publickey)`: Add your keys first with `ssh-add`.
* `Permissions ... for '...' are too open`: `chmod` the private key to `0400`.
* Troubleshooting guides: [A](https://www.linode.com/docs/troubleshooting/troubleshooting-ssh/), [B](https://www.linux.com/blog/4-reasons-why-ssh-connection-fails%20), [C](https://tecadmin.net/how-to-enable-ssh-as-root-on-aws-ubuntu-instance/).

### 2 - Install requirements

You needs to have installed python3 and ansible:

* [Official Ansible Installation guide](https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html).
* [Running Ansible on Windows](https://dzone.com/articles/running-ansible-on-a-windows-system): If you are stuck with it.
* [Python 3 installation guide by RealPython.com](https://realpython.com/installing-python/).

### 3 - Install Wordpress

You need to call the `install` script passing your server ip as argument:

```shell
./install [server-ip]
```

This script will call the ansible scripts inside `tasks`. You should take a look at the code to see what is going on.

After the previous command run successfully you will get a working WordPress installation. The user and password are stored inside the `/root/passwords` folder:

* `/root/passwords/ADMIN_USER`
* `/root/passwords/ADMIN_PASSWORD`

You need those credentials to log into your new installation.

### 4 - Add https

With a domain registered, you need to add a A DNS record pointing to your domain. If you don't know how to do it, [this is a good tutorial](https://code.tutsplus.com/tutorials/an-introduction-to-learning-and-using-dns-records--cms-24704).

After you can access your website using your domain you can write:

```shell
$ ./install [server-ip] https [domain] [your-email]
```

That will setup your https certification. The email is required because if there is any problem with the certificates you will be notified.


### 5 - Next steps

Because you will managing your own server, you should be taking a look to:

* [WP CLI](https://wp-cli.org/): The WordPress Command Line Interface.