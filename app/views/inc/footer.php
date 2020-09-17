</div>

<br> <br>
<!-- FOOTER -->
<div class="container py-3 border-top w-150">
    <div class="row">
        <div class="col-md-8 ml-auto">
            <div class="d-flex flex-column row-hl">
                <div class="item-hl p-2">
                    <h4>Have a Questions?</h4>
                </div>
                <div class="item-hl p-2">
                    <span><i class="fas fa-envelope"></i></span>
                    <span> quizverse@hcmut.edu.vn</span>
                </div>
                <div class="item-hl p-2">
                    <span><i class="fas fa-phone"></i></span>
                    <span> 028 01642284289</span>
                </div>
                <div class="item-hl p-2">
                    <span><i class="far fa-compass"></i></span>
                    <span> 268 Ly Thuong Kiet, District 10, Ho Chi Minh City, Viet Nam</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 ml-auto text-center">

            <div class="d-flex flex-column row-hl">
                <div class="item-hl p-3">
                    <p class="text-secondary">Copyright &copy; 2019 QuizVerse designed by Nhan and Diep</p>
                </div>
                <button class="btn btn-secondary p-3" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i> Go Top</button>
            </div>
        </div>
    </div>
</div>

<!-- <button class="btn btn-secondary" onclick="topFunction()" id="myBtn" title="Go to top">Top</button> -->

<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<script src="https://kit.fontawesome.com/b0724393dc.js" crossorigin="anonymous"></script>
<script src="<?php echo URLROOT; ?>/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>

</html>