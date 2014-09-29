# goto

Simple travel note

## apache

At your apache config file,

    DocumentRoot "/path/to/goto/public_html"

and

    <Directory "/path/to/goto/public_html">
        ...
    </Directory>

## nginx

At your nginx's server block,

    root /path/to/goto/public_html;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }