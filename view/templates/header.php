<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Maven+Pro:400,700">
<link rel="stylesheet" href="/assets/css/normalize.min.css">
<link rel="stylesheet" href="/assets/css/geomicons.min.css">
<link rel="stylesheet" href="/assets/css/page_global.min.css">

<link rel="shortcut icon" href="/assets/images/icon/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="/assets/images/icon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/assets/images/icon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="/assets/images/icon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/assets/images/icon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="/assets/images/icon/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/assets/images/icon/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/assets/images/icon/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/assets/images/icon/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icon/apple-touch-icon-180x180.png">
<meta name="apple-mobile-web-app-title" content="goto">
<link rel="icon" type="image/png" href="/assets/images/icon/favicon-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/assets/images/icon/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/assets/images/icon/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/assets/images/icon/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/assets/images/icon/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#1b1108">
<meta name="msapplication-TileImage" content="/assets/images/icon/mstile-144x144.png">
<meta name="msapplication-config" content="/assets/images/icon/browserconfig.xml">
<meta name="application-name" content="goto">

<?php if(isset($head) && isset($head["meta"])) { foreach($head["meta"] as $name => $content) { ?>
<meta name="<?php echo $name; ?>" content="<?php echo $content ?>">
<?php } } ?>

<?php if(isset($head) && isset($head["css"])) { foreach($head["css"] as $href) { ?>
<link rel="stylesheet" href="<?php echo $href ?>">
<?php } } ?>

</head>
<body>