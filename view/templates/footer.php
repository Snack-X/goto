<footer>
<p class="sosumi">Powered by <a href="https://github.com/Snack-X/goto">goto</a> &copy; 2014-2015 SnackStudio. All rights reserved.</p>
<a href="https://twitter.com/Snack_X"><span class="js-geomicon geomicon-md fill-gray" data-icon="twitter"></span></a>
<a href="https://github.com/Snack-X"><span class="js-geomicon geomicon-md fill-gray" data-icon="github"></span></a>
<a href="/admin"><span class="js-geomicon geomicon-md fill-gray" data-icon="cog"></span></a>
<a href="/"><span class="js-geomicon geomicon-md fill-gray" data-icon="home"></span></a>
</footer>
<script src="/assets/js/geomicons.min.js"></script>
<?php if($this->config["ga"]["enabled"]) { ?>
<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '<?php echo $this->config["ga"]["key"] ?>', 'auto'); ga('send', 'pageview'); </script>
<?php } ?>
<script>Geomicons.inject(document.querySelectorAll(".js-geomicon"));</script>
</body>
</html>