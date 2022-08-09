<!-- Section-->
<section class="py-5" id="main">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
            <?php if (!empty($videos)): ?>
                <?php foreach ($videos as $video) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <div class="text-center mt-2">
                                <a href="/video/<?php echo $video['id'] ?>">
                                    <video class="card-img-top mb-5 mb-md-0">
                                        <source src="/uploads/<?php echo $video['videoLocation'] ?>">
                                    </video>
                                </a>
                            </div>                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $video['title'] ?></h5>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="/video/<?php echo $video['id'] ?>">View
                                        video</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="alert alert-primary" role="alert">
                    No videos in the database currently!
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
