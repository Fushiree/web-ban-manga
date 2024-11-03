const itemsliderbar = document.querySelectorAll(".cartegory-left-li"); // Thêm dấu chấm ở đây
itemsliderbar.forEach(function(menu, index) {
    menu.addEventListener("click", function() {
        menu.classList.toggle("block");
    });
});


