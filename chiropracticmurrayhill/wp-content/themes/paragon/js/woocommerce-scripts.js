jQuery(document).ready(function() {
jQuery(window).load(function() {

if (jQuery('.products').hasClass('mk-woo-isotop')) {
	 $container = jQuery('.products.mk-woo-isotop');
            $container_item = '.products.mk-woo-isotop .product';

            $container.isotope({
                itemSelector: $container_item,
                animationEngine: "best-available",
                isFitWidth: true

            });


            jQuery(window)
            .on("debouncedresize", function (event) {
            $container.isotope('reLayout');
        });
}
});

});