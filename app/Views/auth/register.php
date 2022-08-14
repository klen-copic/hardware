<section class="vh-100 gradient-custom" style="background-color: #10ccf4;">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                        <div class="alert alert-danger" id="greski" hidden>
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <input type="text" id="firstName" name="firstName" class="form-control form-control-lg"/>
                                        <label class="form-label" for="firstName">First Name</label>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-lg"/>
                                        <label class="form-label" for="lastName">Last Name</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"/>
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-lg"/>
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg"/>
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <input type="password" id="passwordConfirm" name="passwordConfirm" class="form-control form-control-lg"/>
                                        <label class="form-label" for="passwordConfirm">Confirm Password</label>
                                    </div>

                                </div>
                            </div>

                            <div class="mt-4 pt-2">
                                <input class="btn btn-primary btn-lg" type="submit" value="Submit"/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/userAuth/register',
                dataType: "html",
                data: $('form').serialize(),
                success: function(response) {
                    if (response === "ok") {
                        alert("Register Successful!");
                        window.location = "/login"
                    } else {
                        document.getElementById("greski").hidden = false;
                        $('#greski').html(response);
                    }
                },
                error: function(result) {
                    $('body').html("err");
                },
            });
        });
    });
</script>