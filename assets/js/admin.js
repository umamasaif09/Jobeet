document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".back-button").forEach(function(button) {
        button.addEventListener("click", function() {
            history.back();
        });
    });

    const openCategoryModal = document.getElementById("openCategoryModal");
    const closeCategoryModal = document.getElementById("closeCategoryModal");
    const categoryModal = document.getElementById("categoryModal");

    if(openCategoryModal && categoryModal) {
        openCategoryModal.addEventListener("click",function () {
            categoryModal.classList.add("show");
        });
    }

    if(closeCategoryModal && categoryModal) {
        closeCategoryModal.addEventListener("click", function () {
            categoryModal.classList.remove("show");
        });
    }

    window.addEventListener("click", function(e) {
        if(e.target == categoryModal) {
            categoryModal.classList.remove("show");
        }
    });

    //dropdown menu for actions
    document.querySelectorAll(".menu-toggle").forEach(function(button) {
        button.addEventListener("click", function(e) {
            
            e.stopPropagation();

            document.querySelectorAll(".menu-dropdown").forEach(function(menu) {
                if(menu !== button.nextElementSibling) {
                    menu.classList.remove("show");
                }
            });
            button.nextElementSibling.classList.toggle("show");

        });
    });

    document.addEventListener("click", function() {
        document.querySelectorAll(".menu-dropdown").forEach(function(menu) {
            menu.classList.remove("show");
        });
    });
});