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
                                    <p class="mb-0"><b>First Name</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"><?php echo session()->get('firstName') ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"><b>Last Name</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"><?php echo session()->get('lastName') ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"><b>Email</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"><?php echo session()->get('email') ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0"><b>Phone</b></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"><?php echo session()->get('phoneNumber') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editData">Edit Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-mb-4">
                        <div class="text-center text-center">
                            <h2 class="p-2">Dashboard</h2>
                            <hr>
                            <div class="container p-4">
                                <div class="row">
                                    <div class="col md-2">
                                        <h6>Number of posted videos</h6>
                                        <h1><?php echo $totalVideos ?></h1>
                                    </div>
                                    <div class="col md-2">
                                        <h6>Average rating per video</h6>
                                        <h1><?php echo $averageRating ?></h1>
                                    </div>
                                    <div class="col md-2">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#uploadNewVideo">Upload New Video
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-mb-4">
                        <div class="text-center">
                            <h2 class="p-2">My Videos</h2>
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
                                                        <div class="text-center">
                                                            <button class="btn btn-danger delete mt-2"
                                                                    id="video_<?php echo $video['id'] ?>">Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php else: ?>
                                        <div class="alert alert-primary" role="alert">
                                            You do not have any uploads yet!
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

<!-- Modal -->
<div class="modal fade" id="uploadNewVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload New Video</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="greski" hidden>
                </div>
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                               placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Video Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                               placeholder="Video Description" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category"
                               placeholder="Category" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload video</label>
                        <input class="form-control" type="file" name="file" accept="video/*" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {

        $('form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '/features/uploadVideo',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response === "ok") {
                        alert("Upload Successful!");
                        location.reload()
                    } else {
                        document.getElementById("greski").hidden = false;
                        $('#greski').html(response);
                    }
                },
                error: function (result) {
                    $('body').html("err");
                },
            });

        });

    });

    $('.delete').click(function () {

        if (confirm("Are you sure you want to delete this video?") === true) {

            const id = $(this).attr('id')
            const splitID = id.split('_');

            const videoID = splitID[1];
            $.ajax({
                type: 'post',
                url: '/features/deleteVideo',
                data: {id: videoID},
                success: function (response) {
                    if (response === "ok") {
                        alert("Video deleted!");
                        location.reload()
                    } else {
                        alert("Error!");
                    }
                },
                error: function (result) {
                    $('body').html("err");
                },
            });
        }
    });

</script>