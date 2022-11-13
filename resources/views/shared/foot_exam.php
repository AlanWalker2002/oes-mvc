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
    function changeIcon(id) {
        $('.arrow-id-' + id).children('i').toggleClass('mdi-arrow-down-drop-circle mdi-arrow-up-drop-circle');
        $('#slide-' + id).slideToggle();
    }
</script>

</body>

</html>