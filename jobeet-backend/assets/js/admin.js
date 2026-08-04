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

    //edit category model
    const editCategoryModal = document.getElementById("editCategoryModal");
    const closeEditCategoryModal= document.getElementById("closeEditCategoryModal");

    const editCategoryForm = document.getElementById("editCategoryForm");
    const editCatgeoryId = document.getElementById("edit_category_id");
    const editCategoryName= document.getElementById("edit_category_name");

    document.querySelectorAll(".edit-category-btn").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.stopPropagation();

            const categoryId = this.getAttribute("data-id");
            const categoryName = this.getAttribute("data-name");

            if(editCatgeoryId) editCatgeoryId.value= categoryId;
            if(editCategoryName) editCategoryName.value=categoryName;

            if(editCategoryModal) {
                editCategoryModal.classList.add("show");
                document.body.style.overflow = "hidden";
            }

            const dropdown = this.closest(".menu-dropdown");
            if(dropdown) {
                dropdown.classList.remove("show");
            }
        });
    });

    if(closeEditCategoryModal && editCategoryModal) {
        closeEditCategoryModal.addEventListener("click", function() {
            editCategoryModal.classList.remove("show");
            document.body.style.overflow = "";
        });
    }

    window.addEventListener("click", function(e) {
        if(e.target == editCategoryModal) {
            editCategoryModal.classList.remove("show");
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
        document.querySelectorAll(".menu-dropdown.show").forEach( d => {
            d.classList.remove("show");
        });
    });

    const button= document.querySelector(".nav-menu");
    const menu = document.querySelector(".mobile-menu");

    button.addEventListener("click", ()=> {
      menu.classList.toggle("show");
    });

    window.addEventListener("click", function(e) {
        if(!menu.contains(e.target) &&
        !button.contains(e.target)) {
            menu.classList.remove("show");
        }
    });

});