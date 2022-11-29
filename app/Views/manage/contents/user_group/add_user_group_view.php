

<div class="row">
    <div class="col-12 col-md-4 offset-md-4">
        <?php
            $data = array(
                'title' => $title
            );
            echo view('manage/components/breadcrumb', $data)
        ?>
        <form action="<?php echo base_url() ?>/manage/user-group/save" id="addUserGroup" method="post">
            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label">Tên nhóm</label>
                <input type="text" id="title" class="form-control" name="name" placeholder="tiêu đề">
            </div>

            <button type="submit" class="btn btn-1">Lưu</button>
            <button type="button" onclick="history.back();" class="btn btn-light border">Hủy</button>
        </form>
    </div>
</div>