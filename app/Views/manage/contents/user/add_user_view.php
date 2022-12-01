<div class="row">
    <div class="col-md-6 col-12 offset-md-3">
        <?php
        $data = array(
            'title' => $title
        );
        echo view('manage/components/breadcrumb', $data)
        ?>
        <form action="<?php echo base_url() ?>/manage/user/save" method="post" id="addUser" enctype='multipart/form-data'>

            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>
            <div class="row">

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Tên hiển thị</label>
                    <input type="text" class="form-control" name="nicename" placeholder="Tên hiển thị">
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="title" class="form-label">Nhóm người dùng</label>
                        <select class="custom-select rounded form-control" name="group_id">
                            <?php
                            foreach ($user_group as $val) {
                            ?>
                                <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" name="confpassword" placeholder="Xác nhận lại mật khẩu">
                </div>

                <div class="mb-3 col-12 col-md-12">
                    <label for="title" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email">
                </div>

                <div class="mb-3 col-12 col-md-12">
                    <label for="title" class="form-label">Tự bạch</label>
                    <textarea class="form-control" name="profile" id="editor" placeholder="Giới thiệu bản thân" rows="3"></textarea>
                </div>

                <div class="input-group mb-3 col-12 col-md-6">
                    <div class="custom-file">
                        <input type="file" name="userimage" id="imgus" class="custom-file-input form-control">
                        <label class="custom-file-label" for="customFile">Chọn ảnh đại diện</label>
                    </div>
                </div>

                <div class="pb-2 col-12 col-md-6" id="preview"></div>

                <div class="row">
                    <div class="col-md-4 col-12">
                        <button type="submit" class="btn btn-1">Lưu</button>
                        <button type="button" onclick="hostory.back()" class="btn btn-light border">Hủy</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>