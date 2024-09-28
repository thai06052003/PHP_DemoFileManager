</div>
<?php if (empty($_GET['type'])): ?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <?php if (empty($_GET['module'])): ?>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-check-square"></i>
                    Chọn tất cả
                </a>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-times-circle"></i> Bỏ tất cả
                </a>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-trash-alt"></i> Xóa
                </a>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-copy"></i>Copy
                </a>
                <?php endif; ?>
            </div>
            <div class="col-4">
                <p class="text-end">Copyright &copy; <?php echo date('Y') ?> by Đinh Xuân Thái</p>
            </div>
        </div>
    </div>
</footer>
<?php
endif; 
$parentDir = Load::getParentDir();
?>
<!-- Modal -->
<div class="modal fade" id="new_item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="?module=create_item&type=action&path=<?php echo $parentDir ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="label-block mb-2">Loại</label>
                        <div class="row">
                            <div class="col-3">
                                <label for="item_file">
                                    <input type="radio" id="item_file" name="item_type" value="file" checked> Tập tin
                                </label>
                            </div>
                            <div class="col-3">
                                <label for="item_folder">
                                    <input type="radio" id="item_folder" name="item_type" value="folder"> Thư mục
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="label-block mb-2">Tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Tên..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Datatable JS -->
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.4/datatables.min.js"></script>
<!-- Custom JS -->
<script src="./assets/js/custom.js?ver<?php echo rand(); ?>"></script>
<!-- HightLightJs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js" integrity="sha512-bgHRAiTjGrzHzLyKOnpFvaEpGzJet3z4tZnXGjpsCcqOnAH6VGUx9frc5bcIhKTVLEiCO6vEhNAgx5jtLUYrfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>hljs.highlightAll();</script>
</body>

</html>