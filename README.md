Based on the CakePHP framework.

Notes:

1. When the vision algorithm is ready, place it in the processImageUploadMethod in the Bug model. (app/Model/Bug.php)
2. To change the upload filesize limit of files, modify the .htaccess file in the root directory and change these values:

#Maximum allowed size for uploaded files.
php_value upload_max_filesize 100M

#Must be greater than or equal to upload_max_filesize
php_value post_max_size 100M
