# PHP Linux File Transfer Interface

This is a useful utility written in PHP, that allows a user to be authenticated through steam and if their steam ID is on the access list they can use this interface. Once they are logged in, they can use this program to transfer a specified file name from one main server to other remote servers, without giving them direct SSH access. Currently .HTML and .PHP files are available for transfer, but you can change the file extension at any time.

## Getting Started

Instructions:
* Open index.php and replace the steamid's with the steamid of any user you want to grant access to the interface.
* Open resources/passwordServer1 and passwordServer2, then add the SSH password to the servers you want to use. (Not fully secure, other password methods can be implemented). An htaccess file has been added to the resources folder to block anyone from accessing it besides your server.
* Change the forms to match the type of files you wish to transfer
* In the switch statement, add any file extensions you wish to allow for transfer. (By default .html or .php will be added to file names entered with no extension.)

### Prerequisites

What you will need to run this interface.

```
An apache server.
A main server with SSH access and multiple other servers (with SSH access) that you wish to have the files transferred too.
Linux operating systems on each server.
```

### Functions to Change

```
ssh2_connect() - Add your main server that is hosting the files you wish to have transferred.
ssh2_auth_password() - Add your SSH credentials for the main server here.
ssh2_exec() - Change the password to the main server and the locations of the remote servers you wish to transfer a file too.

```

## How to Run

The user will first access the index.php page. Here they will given a button to sign into steam. Once they are signed in they can enter the name of the file they wish to transfer. A result notice will then be displayed on the screen. The user can then logout at any time. The login uses a php $_SESSION[''] variables which will keep the user logged in for a default of 24 minutes.

## Deployment

Run this in your var/www folder or web hosting http folder.

## Contributing

If you wish to contribute to this project or any others please contact me at jasontokarski@yahoo.com

## Authors

* **Jason Tokarski** - *Initial work* - [jasontokarski](https://github.com/jasontokarski)
