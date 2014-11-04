/**
 * Implements user interface in the product's catalog.
 * This structure is used only to demonstrate the way to organize more complicated JS.
 */
var Products = (function () {

    /**
     * Initialize interface
     */
    function init() {
        $(".product .details a").colorbox();
        $(".product .add a").colorbox();
        $(".product .image img").lazyload();
    }

    /**
     * Initialize product's autoloading on page scrolling
     */
    function initScroll() {
        $(".products").jscroll({
            nextSelector: '.loading:last a'
        });
    }

    /**
     * Return only "public" methods
     */
    return {
        init: init,
        initScroll: initScroll
    };
})();
