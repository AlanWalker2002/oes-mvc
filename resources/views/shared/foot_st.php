<!-- START FOOTER -->
<footer class="bg-dark py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="public/img/logo.png" alt="" class="logo-dark" height="18">
                <p class="text-muted mt-4">Hyper giúp học sinh dễ dàng trải nghiệm hệ thống kiểm tra một cách
                    <br> tốc độ và nhanh chóng. Thiết kế thân thiện giúp
                    <br> tạo học sinh thoải mái khi làm bài thi tại Hyper.
                </p>

                <ul class="social-list list-inline mt-3">
                    <li class="list-inline-item text-center">
                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                    </li>
                    <li class="list-inline-item text-center">
                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                    </li>
                    <li class="list-inline-item text-center">
                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                    </li>
                    <li class="list-inline-item text-center">
                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                    </li>
                </ul>

            </div>

            <div class="col-lg-2 mt-3 mt-lg-0">
                <h5 class="text-light">Company</h5>

                <ul class="list-unstyled ps-0 mb-0 mt-3">
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">About Us</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Documentation</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Blog</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Affiliate Program</a></li>
                </ul>

            </div>

            <div class="col-lg-2 mt-3 mt-lg-0">
                <h5 class="text-light">Apps</h5>

                <ul class="list-unstyled ps-0 mb-0 mt-3">
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Ecommerce Pages</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Email</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Social Feed</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Projects</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Tasks Management</a></li>
                </ul>
            </div>

            <div class="col-lg-2 mt-3 mt-lg-0">
                <h5 class="text-light">Discover</h5>

                <ul class="list-unstyled ps-0 mb-0 mt-3">
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Help Center</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Our Products</a></li>
                    <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Privacy</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="mt-5">
                    <p class="text-muted mt-4 text-center mb-0">© 2018 - 2021 Hyper. Design and coded by
                        Coderthemes</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<div id="logoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Đăng Xuất</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <p>Xác nhận đăng xuất</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Không</button>
                <button type="button" class="btn btn-primary" id="btn-logout">Có</button>
            </div>
        </div>
    </div>
</div>

<!-- bundle -->
<script src="public/js/vendor.min.js"></script>
<script src="public/js/app.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $('.maintained').click(() => {
        toastr.warning('Chức năng đang trong quá trình phát triển');
    });
</script>

</body>

</html>