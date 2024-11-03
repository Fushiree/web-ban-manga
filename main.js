// danh sách tùy chọn(index)
const itemsliderbar = document.querySelectorAll(".cartegory-left-li");
itemsliderbar.forEach(function(menu, index) {
    menu.addEventListener("click", function() {
        menu.classList.toggle("block");
    });
});
//end danh sách tùy chọn(index)

// product
const bigimg = document.querySelector(".product-content-left-big-img img")
const smallimg = document.querySelectorAll(".product-content-left-small-img img")
smallimg.forEach(function(imgItem,x){
    imgItem.addEventListener("click", function(){
        bigimg.src = imgItem.src;
    });
});

const mota = document.querySelector(".mota")
const chitiet = document.querySelector(".chitiet")

if (mota) {
    mota.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none";
        document.querySelector(".product-content-right-bottom-content-mota").style.display = "block";
    });
}

if (chitiet) {
    chitiet.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block";
        document.querySelector(".product-content-right-bottom-content-mota").style.display = "none";
    });
}

const butTon = document.querySelector(".product-content-right-bottom-top");
if (butTon) {
    butTon.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB");
    });
}

//end product
