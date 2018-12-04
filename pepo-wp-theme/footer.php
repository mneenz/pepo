
			<footer id="footer" role="contentinfo">
				<div id="copyright">

				</div>
			</footer>
		</div>

		<!--JQUERY-->
		<script data-cfasync="false" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script data-cfasync="false" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/menu.js"></script>
		<script data-cfasync="false" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>

		<!--Facebook Share Page Icon Script on home and single pages-->
	  <?php if (is_singular() ):?>
	  	<script language="javascript" type="text/javascript">
	  	//Share current page to Facebook
		  function fbShare(url, translationTitle, descr, image, winWidth, winHeight) {
		    var winTop = (screen.height / 2) - (winHeight / 2);
		    var winLeft = (screen.width / 2) - (winWidth / 2);
		    window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + translationTitle + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width='+winWidth+',height='+winHeight);
	    }
			</script>

		<?php endif;?>

		<?php wp_footer(); ?>

	</body>
</html>
