document.addEventListener("DOMContentLoaded", function() {

    var copyButtonClickHandler = function(event) {
        // Your click handler
        id = event.target.getAttribute('data-id');

        // Get the Original String
        originalString = document.getElementById('original-' + id).innerHTML;
        destination = document.getElementById('translation-' + id);

        destination.innerHTML = originalString;

        event.preventDefault();


    };

    var copyButtons = document.getElementsByClassName("copybutton");
    for (var i = 0; i < copyButtons.length; i++) {
        var current = copyButtons[i];
        current.addEventListener('click', copyButtonClickHandler, false);
    }

});