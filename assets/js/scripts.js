$(function () {
    $("[data-toggle='tooltip'").tooltip();

    /**
     * Make category nav menu sticky when scrolling, and update the highlighted subcategory link
     */
    window.onscroll = function () { updateNav() };

    // Get the navbar
    var navbar = document.getElementById("categoryNav");

    // Get the offset position of the navbar
    var sticky = navbar.offsetTop;

    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function updateNav() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
        // TO-DO: Install that jquery-visible plugin and implement proper code
        // console.log($("#free-ebooks").visible());
    }
});