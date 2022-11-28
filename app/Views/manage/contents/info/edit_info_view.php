
<div class="row">
    <div class="col-12 col-md-6 offset-md-3">
    <?php
        $data = array(
            'title' => $title
        );
        echo view('manage/components/breadcrumb', $data)
        ?>
        
        <form action="<?php echo base_url() ?>/manage/info/update" method="post" enctype='multipart/form-data'>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
        <?php endif; ?>
            <div class="mb-3">
                <label for="title" class="form-label">Tên</label>
                <input type="text" id="title" class="form-control" name="name" placeholder="Tên shop" value="<?php echo $shopinfo->name ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" name="address" placeholder="meta title" value="<?php echo $shopinfo->address ?>">
            </div>

            <input type="hidden" class="form-control" name="id" value="<?php echo $shopinfo->id ?>">
            <input type="hidden" class="form-control" name="logo_old" value="<?php echo $shopinfo->logo ?>">
            <input type="hidden" class="form-control" name="favicon_old" value="<?php echo $shopinfo->favicon ?>">

            <div class="mb-3">
                <label for="title" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" name="phone" placeholder="phone" value="<?php echo $shopinfo->phone ?>">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="email" value="<?php echo $shopinfo->email ?>">
            </div>

            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="img" id="imgus" class="custom-file-input form-control">
                    <label class="custom-file-label" for="customFile">Logo</label>
                </div>
            </div>

            <div class="pb-2" id="preview">
                <?php if ($shopinfo->logo) { ?>
                    <img src="<?php echo base_url() . '/public/uploads/logo/' . $shopinfo->logo ?>" width="200">
                <?php } ?>
            </div>

            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="favicon" id="imgus" class="custom-file-input form-control">
                    <label class="custom-file-label" for="customFile">Favicon</label>
                </div>
            </div>

            <?php if ($shopinfo->favicon) { ?>
                <img src="<?php echo base_url() . '/public/uploads/favicon/' . $shopinfo->favicon ?>" width="100" style="margin: 40px 0;display: block">
            <?php } ?>

            <button type="submit" class="btn btn-1">Lưu</button>
            <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
        </form>
    </div>
</div>