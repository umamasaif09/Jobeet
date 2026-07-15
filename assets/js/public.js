document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".back-button").forEach(function(button) {
        button.addEventListener("click", function() {
            history.back();
        });
    });

    
});

