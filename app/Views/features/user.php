<section style="background-color: #eee;">
    <div class="container-fluid p-5 ">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-mb-4">
                        <div class="text-center text-center">
                            <img src="https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-512.png" alt="avatar"
                                 class="rounded-circle img-fluid" style="width:250px">
                            <h5 class="card-title p-2">Profile</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"><b>Name</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"> <?= $user['firstName'] . " " . $user['lastName'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"><b>Email</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"> <?= $user['email'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"><b>Phone</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"> <?= $user['phoneNumber'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-mb-4">
                        <div class="text-center">
                            <h2 class="p-2"><?php echo $user['firstName'] . " " . $user['lastName'] ?> Videos</h2>
                            <hr>
                            <div class="container p-4">
                                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
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
                                                    </div>
                                                    <!-- Product details-->
                                                    <div class="card-body p-4">
                                                        <div class="text-center">
                                                            <!-- Product name-->
                                                            <h5 class="fw-bolder"><?php echo $video['title'] ?></h5>
                                                            <!-- Product price-->
                                                        </div>
                                                    </div>
                                                    <!-- Product actions-->
                                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                        <div class="text-center">
                                                            <a class="btn btn-outline-dark mt-auto"
                                                               href="/video/<?php echo $video['id'] ?>">View
                                                                video</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php else: ?>
                                        <div class="alert alert-primary" role="alert">
                                            This user has not uploaded any videos yet.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>