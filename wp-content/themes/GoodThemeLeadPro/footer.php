</div>
<!-- END wrapper -->

<!-- BEGIN footer -->

<div id="footer">

<div id="totop">
<a href="<?php echo get_settings('home'); ?>/#">Jump To Top</a>
</div>

<div id="footee1">
<ul>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(4) ) : ?>
<li><h2>Widget Ready Block</h2></li>
<li>Aenean lacinia varius vulputate. Cras in tellus eros, vitae volutpat lectus. Suspendisse nec elit nec mi pretium ullamcorper. Donec nec felis ac diam tristique vestibulum non et augue. Sed a varius massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>      


<?php endif; ?>
</ul>
</div>

<div id="footee2">
<ul>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(5) ) : ?>
<li><h2>Widget Ready Block</h2></li>
<li>Morbi ac risus sapien. Nullam non magna est. Donec placerat pretium molestie. Sed sed risus quis arcu aliquet aliquet sed eget massa. Quisque accumsan, ante in gravida tristique, risus ipsum venenatis nulla, ac viverra ipsum odio in arcu. Quisque a dictum orci. </li>




<?php endif; ?>
</ul>
  </div>

<div id="footee3">
<ul>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(6) ) : ?>
 <li><h2>Widget Ready Block</h2></li>
<li>Hellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque at lacus turpis, ac rutrum risus. Sed ultrices lectus a neque malesuada condimentum. Maecenas magna lorem, porttitor vitae aliquet eget, egestas malesuada mauris. </li>      


<?php endif; ?>
</ul>

  </div>




<div class="wrapper">
	<h2><?php bloginfo('description'); ?></h2>
    &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?> is proudly using the <a href="http://goodtheme.org" title="Really Good Theme">GoodTheme Pro</a> designed by <a href="http://dannci.com" title="Really Amazing Themes">Dannci</a> | <?php wp_loginout(); ?>
</div>	
</div>
</div>
<!-- END footer -->
<?php 
$pov_google_analytics = get_option('pov_google_analytics');
if ($pov_google_analytics != '') { echo stripslashes($pov_google_analytics); }
?>
<?php wp_footer(); ?>
</div>
</body>

</html>
