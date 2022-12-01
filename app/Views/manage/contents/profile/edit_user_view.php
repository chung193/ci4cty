<div class="row">
    <div class="col-12 col-md-6 offset-md-3">
        <?php
        $data = array(
            'title' => $title
        );

        echo view('manage/components/breadcrumb', $data)
        ?>

        <form action="<?php echo base_url() ?>/manage/profile/update" id="editProfile" method="post" enctype='multipart/form-data'>

            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="mb-3 col-md-6 col-12">
                    <label for="title" class="form-label">Tên hiển thị</label>
                    <input type="text" class="form-control" name="nicename" placeholder="Tên hiển thị" value="<?php echo $user->nicename ?>">
                </div>
                <div class="mb-3 col-md-6 col-12">
                    <label for="title" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo $user->email ?>">
                </div>
                <div class="mb-3 col-md-6 col-12">
                    <label for="title" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                </div>

                <div class="mb-3 col-md-6 col-12">
                    <label for="title" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Xác nhận mật khẩu">
                </div>
                <div class="mb-3 col-12 col-md-12">
                    <label for="title" class="form-label">Tự bạch</label>
                    <textarea class="form-control" name="profile" id="editor" placeholder="Tự bạch" rows="3"><?php echo $user->profile ?></textarea>
                </div>

                <input type="hidden" name="id" value="<?php echo $user->id ?>">

                <div class="input-group mb-3 col-12 col-md-6">
                    <label class="input-group-text" for="inputGroupFile01">Ảnh đại diện</label>
                    <input type="file" id="imgus" class="form-control" name="userimage" id="inputGroupFile01">
                </div>
                <div class="pb-2 col-12 col-md-6" id="preview">
                    <?php if ($user->userimage) { ?>
                        <img src="<?php echo base_url() . '/public/uploads/user/' . $user->userimage ?>" width="200">
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4">
                        <button type="submit" class="btn btn-1">Lưu</button>
                        <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
                    </div>
                </div>


            </div>

        </form>
    </div>
</div>