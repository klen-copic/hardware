<!-- Product section-->
<div class="py-5">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <video controls class="card-img-top mb-5 mb-md-0">
                    <source src="/uploads/<?php echo $video['videoLocation'] ?>">
                </video>
                <h1 class="display-5 fw-bolder"><?php echo $video['title'] ?></h1>
                <p>Category: <?php echo ucfirst($video['category']) ?></p>
                <div class="post">
                    <div class="post-action">
                        <!-- Rating Bar -->
                        <input id="item_<?php echo $video['id'] ?>" value='<?php echo $userRating ?>'
                               class="kv-ltr-theme-svg-star ratingbar" data-min="0" data-max="5"
                               data-step="1">
                        <!-- Average Rating -->
                        <div>Average Rating: <span
                                    id='averageRating'><?php echo $averageRating ?></span>
                        </div>
                    </div>
                </div>
                <p class="lead"><?php echo $video['description'] ?></p>
                <p class="lead">Uploaded by:<a href="/user/<?php echo $video['userID']?>" style="text-decoration: none"> <?php echo $video['firstName'] . " " . $video['lastName']; ?></a></p>
            </div>
            <div class="col-md-4">
                <div class="container mt-5">
                    <div class="d-flex justify-content-center row">
                        <div class="">
                            <?php if (!empty($comments)): ?>
                                <?php foreach ($comments as $comment) { ?>
                                    <div class="d-flex flex-column comment-section">
                                        <div class="bg-white p-2">
                                            <div class="d-flex flex-row user-info">
                                                <div class="d-flex flex-column justify-content-start ml-2"><span
                                                            class="d-block font-weight-bold name"><?php echo $comment['firstName'] . " " . $comment['lastName'] ?></span>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <p class="comment-text"><?php echo $comment['text'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php else: ?>
                                <div class="alert alert-primary" role="alert">
                                    No comments about this video!
                                </div>
                            <?php endif; ?>

                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start">
                                    <textarea id="textarea" class="form-control ml-1 shadow-none textarea"></textarea>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-success btn-sm shadow-none" id="postComment" type="button">
                                        Post comment
                                    </button>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // Initialize
        $('.ratingbar').rating({
            showCaption: false,
            showClear: false,
            size: 'sm'
        });

        // Rating change
        $('.ratingbar').on('rating:change', function (event, value, caption) {
            const id = this.id;
            const splitID = id.split('_');
            const videoID = splitID[1];

            $.ajax({
                url: '/features/rateVideo',
                type: 'post',
                data: {
                    videoID: videoID,
                    rating: value,
                },
                success: function (response) {
                    $('#averageRating').text(response);
                }
            });
        });
    });

    $(document).ready(function () {
        $('#postComment').click(function () {
            const text = $('#textarea').val();
            const id = <?php echo $video['id'] ?>;
            console.log(id)
            if (text === "") {
                alert("Please enter a comment!");
            } else {
                $.ajax({
                    url: '/features/postComment',
                    type: 'post',
                    data: {
                        videoID: id,
                        text: text,
                    },
                    success: function (response) {
                        if (response === "ok") {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>