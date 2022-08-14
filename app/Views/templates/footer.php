<!-- Footer -->
<!-- Footer -->
<footer class="bg-info text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">

        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="https://www.facebook.com/marko.taleski.9/" role="button"><i class="fab fa-facebook-f"></i></a>

        
            <!-- Google -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="https://www.instagram.com/markotaleski/" role="button"><i class="fab fa-instagram"></i></a>

             <!-- Github -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="https://github.com/markotaleski24" role="button"><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->


       


        <!-- Section: Text -->
        <section class="mb-4" >
            <p id= "footerText">
                This webpage was developed as a project for my course Systems III - Information systems. It serves as an information system for the hardware components of a computer.
            </p>
        </section>
        <!-- Section: Text -->


    </div>
    <!-- Grid container -->

   

</footer>
<!-- Footer -->
<!-- SCRIPTS -->

<script>
    $(function() {

        $('#logout').on('click', function(e) {
            e.preventDefault();
            console.log("click")
            $.ajax({
                type: 'post',
                url: '/userAuth/logout',
                dataType: "html",
                success: function(response) {
                    alert(response);
                    window.location = "/login"
                },
                error: function(result) {
                    $('body').html("err");
                },
            });

        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script></body>
</html>
