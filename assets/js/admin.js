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

    document.querySelectorAll(".menu-toggle").forEach(toggle => {
        toggle.addEventListener("click", function(e) {
            e.stopPropagation();
            const dropdown = this.nextElementSibling;
            const rect= dropdown.getBoundingClientRec();
            const viewportHeight = window.innerHeight;

            if(rect.bottom > viewportHeight) {
                dropdown.style.top = 'auto';
                dropdown.style.bottom = '100%';
                dropdown.style.marginTop= '0';
                dropdown.style.marginBottom= '4px';
            }
            else {
                dropdown.style.top = '100%';
                dropdown.style.bottom = 'auto';
                dropdown.style.marginTop = '4px';
                dropdown.style.marginBottom = '0';
            }

            dropdown.classList.toggle("show");
        });
    });

    document.addEventListener("click", function() {
        document.querySelectorAll(".menu-dropdown.show").forEach( d => {
            d.classList.remove("show");
        });
    });
});