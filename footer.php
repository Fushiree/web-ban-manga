<!-- app-container -->
<section class="app-container">
    <p>Tải ứng dụng</p>
    <div class="app-google">
        <img src="/picture/app/appstore.png">
        <img src="/picture/app/ggplay.png">
    </div>
    <p>Nhận tin từ chúng tôi</p>
    <input type="text" placeholder="Nhập Email của bạn...">
   </section>
 <!-- end app-container -->
 <!-- footer -->
  <div class="footer-top">
        <li><a href="">Liên hệ</a></li>
        <li><a href="">Tuyển dụng</a></li>
        <li><a href="">Giới thiệu</a></li>
        <li>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
            <a href=""><i class="fa-brands fa-x-twitter"></i></a>
        </li>
  </div>
 <!-- end footer -->

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/main.js"></script>
</body>
<script>
    const header = document.querySelector("header")
    window.addEventListener("scroll",function(){
        x = window.pageYOffset
        if(x>0){
            header.classList.add("sticky")
        }
        else{
            header.classList.remove("sticky")
        }
    })
</script>
</html>