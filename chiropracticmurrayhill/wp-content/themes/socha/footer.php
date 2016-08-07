    </div>
	<footer id="footer-main" role="contentinfo">
		<?php if (ale_get_option('copyrights')) : ?>
			<p class="copy"><?php echo ale_option('copyrights'); ?></p>
		<?php else: ?>
			<p class="copy">&copy; <?php _e('2013. Socha Responsive Theme. ALL RIGHTS RESERVED.', 'aletheme')?></p>
		<?php endif; ?>
        <div class="topbutton">
            <a href="#top" id="gotop"><?php _e('TOP', 'aletheme')?></a>
        </div>
        <div class="cf"></div>
	</footer>
<?php wp_footer(); ?>

</body>
</html>