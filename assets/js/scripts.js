$(function () {
    $("[data-toggle='tooltip'").tooltip();
    // TO-DO: Update positions when window is resized (or other events that would change section positions??)
    var sectionPositions = new Map();
    $(".section-container").each(function () {
        sectionPositions.set($(this).attr("data-tid"), { "start": $(this).offset()["top"], "end": $(this).offset()["top"] + $(this).height() });
    });
    /**
     * Handle the minimize/expand side menu function
     */
    $("#toggleSideNavBtn").on("click", function () {
        if ($(this).attr("data-mode") == "hide") {
            // Hide menu, only showing the toggle menu btn (with now updated data-mode attr and symbol)
            $("#subcategoryMenu li:not(:first-of-type)").css("display", "none");
            $("#toggleSideNavBtn").attr("data-mode", "show");
            $("#toggleSide i[data-dir='left']").css("display", "none");
            $("#toggleSide i[data-dir='right']").css("display", "initial");
            $(this).attr("data-mode", "show");
            // Update tooltip text
            $(this).tooltip('hide')
                .attr('data-original-title', "Show menu")
                .tooltip('fixTitle')
                .tooltip('show');

            // Remove focus from buttons after releasing
            $(this).blur();
        }
        else {
            $("#subcategoryMenu li:not(#toggleSide)").css("display", "list-item");
            $("#toggleSideNavBtn").attr("data-mode", "hide");
            $("#toggleSide i[data-dir='left']").css("display", "initial");
            $("#toggleSide i[data-dir='right']").css("display", "none");
            // Update tooltip text
            $(this).tooltip('hide')
                .attr('data-original-title', "Minimize menu")
                .tooltip('fixTitle')
                .tooltip('show');
            $(this).blur();
        }
    });

    /**
     * Back to top action
     */
    $("#backToTop").on("click", function () {
        $(document).scrollTop(0);
    });

    /**
     * Make category nav menu dropdown sticky when scrolling, and update the current subcategory link
     */
    // window.onscroll = function () { updateNav() };
    // var dropdownBtn = $("#sectionNavBtn");
    // // Height of dropdown
    // var dropdownHeight = $("#sectionNavBtn").height();

    // // Change nav dropdown option depending on what section it's in
    // function updateNav() {
    //     // Top offset of dropdown
    //     var dropdownY = $("#sectionNavBtn").offset()["top"];

    //     // ID of section this dropdown is for
    //     var secID = $(dropdownBtn).attr("data-container");

    //     /**
    //      * If dropdown is not in the section it's supposed to be in, check which one it is in and update accordingly
    //      * 
    //      * ??? Use offset or offset+height for this???
    //      */
    //     if (dropdownY > sectionPositions.get(secID)["end"] || dropdownY < sectionPositions.get(secID)["start"]) {
    //         console.log("Time to update!");
    //         // Check which section it's actually in
    //         sectionPositions.forEach(function (value, key) {
    //             if (dropdownY > value["start"] && dropdownY < value["end"]) {
    //                 $(dropdownBtn).attr("data-container", key);
    //                 var secTitle = $("[data-btn='sectionNavBtn']").find("[data-opt-id='" + key + "']").text();
    //                 console.log("Change button text to: " + secTitle);
    //                 $(dropdownBtn).text(secTitle);
    //             }
    //         });
    //     }

    //     // The term ID of the section container this current dropdown button pertains to
    //     // var sectionID = $("#sectionNavBtn").attr("data-container");
    //     // // The actual container
    //     // var sectionContainer = $("[data-attr='" + sectionID + "']");
    //     // // Once dropdown has entered another section container, update dropdown accordingly
    //     // var sectionEnd = sectionPositions.get(sectionID)["end"];
    //     // if (dropdownY + dropdownHeight > sectionEnd) {
    //     //     var nextSection = $(sectionContainer).next();
    //     //     $(dropdownBtn).text()
    //     // }
    //     // TO-DO: ACCOUNT FOR UPWARD SCROLLING AS WELL

    // }
});