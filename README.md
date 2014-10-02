# goto

Simple travel note.

Write notes with Markdown, check in to famous venues, share your check ins and notes to Twitter.

(Venues are retrieved from Foursquare, goto does not check in to Foursquare or Swarm.)

# Web server setting

## Apache

At your Apache config file,

    DocumentRoot "/path/to/goto/public_html"

## nginx

At your nginx's server block,

    root /path/to/goto/public_html;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }