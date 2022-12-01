<div class="row">
    <div class="col-12 col-md-10 offset-md-0">
        <?php
        $data = array(
            'title' => $title
        );
        echo view('manage/components/breadcrumb', $data)
        ?>

        <form action="<?php echo base_url() ?>/manage/options/save" method="post" enctype='multipart/form-data'>
            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>
            <h3>Mail</h3>

            <div class="row p-0 m-0">
                <div class="col-12 col-md-6 mb-3">
                    <label for="title" class="form-label">Mail protocol</label>
                    <input type="text" id="title" class="form-control" name="data['mail_protocol']" placeholder="Mail protocol" value="<?php echo $option['mail_protocol']['value'] ?>">
                </div>
                <div class=" col-12 col-md-6 mb-3">
                    <label for="title" class="form-label">Mail smtp</label>
                    <input type="text" class="form-control" name="data['mail_SMTPHost']" placeholder="Mail smtp" value="<?php echo $option['mail_SMTPHost']['value'] ?>">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="title" class="form-label">Mail port</label>
                    <input type="text" class="form-control" name="data['mail_SMTPPort']" placeholder="Mail port" value="<?php echo $option['mail_SMTPPort']['value'] ?>">
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="title" class="form-label">Mail smtp crypto</label>
                    <input type="text" class="form-control" name="data['mail_SMTPCrypto']" placeholder="Mail smtp crypto" value="<?php echo $option['mail_SMTPCrypto']['value'] ?>">
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Mail user</label>
                    <input type="text" class="form-control" name="data['mail_user']" placeholder="Mail user" value="<?php echo $option['mail_user']['value'] ?>">
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Mail password</label>
                    <input type="text" class="form-control" name="data['mail_password']" placeholder="Mail password" value="<?php echo $option['mail_password']['value'] ?>">
                </div>

                <hr>
                <h3>Trang web</h3>
                <p class="text-danger">Chú ý với phần này</p>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Mail mặc định của trang</label>
                    <input type="text" class="form-control" name="data['site_mail']" placeholder="Default mail of site" value="<?php echo $option['site_mail']['value'] ?>">
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Site title</label>
                    <input type="text" class="form-control" name="data['site_title']" placeholder="Site title" value="<?php echo $option['site_title']['value'] ?>">
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Site meta title</label>
                    <textarea class="form-control" name="data['site_metatitle']" placeholder="Site meta title" rows="3"><?php echo $option['site_metatitle']['value'] ?></textarea>
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Site description</label>
                    <textarea class="form-control" name="data['site_description']" placeholder="Site description" rows="3"><?php echo $option['site_description']['value'] ?></textarea>
                </div>

                <p class="text-danger">Quan trọng !</p>

                <div class="form-check form-switch pb-3 col-12 col-md-6 ml-2">
                    <input class="form-check-input " name="data['site_status']" value="<?= $option['site_status']['value'] ?>" type="checkbox" id="site_status" <?php
                                                                                                                                                                if ($option['site_status']['value']) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                }
                                                                                                                                                                ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked">
                        <?php
                        if ($option['site_status']['value']) {
                            echo '<span class="text-primary">Site online</span>';
                        } else {
                            echo '<span class="text-danger">Site online</span>';
                        }
                        ?>

                    </label>
                </div>
                
                <div class="col-md-4 col-12">
                    <button type="submit" class="btn btn-1">Lưu lại</button>
                    <button type="button" onclick="hostory.back()" class="btn btn-light order">Hủy</button>
                </div>

        </form>
    </div>


</div>
</div>