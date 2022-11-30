<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<div class="row">
    <div class="col-12 col-md-8">
        <?php
            $url = base_url().'/manage/'.$seo->content_type.'/edit/'.$seo->content_id; 
            $name = $content->title;
        ?>
        <p>Nội dung seo cho <a href="<?= $url?>"><?= $name?></a>, bạn cũng có thể sửa nội dung seo tại đó.</p>
        <form action="<?php echo base_url() ?>/manage/seo/update" method="post" id="editSeo" enctype='multipart/form-data'>

            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label">Meta title</label>
                <input type="text" id="title" class="form-control" name="meta_title" placeholder="Meta title" value="<?php echo $seo->meta_title ?>">
            </div>

            <input type="hidden" value="<?= $seo->id?>" name="id">
            <input type="hidden" class="form-control" name="id"  value="<?php echo $seo->id ?>">

            <div class="mb-3">
                <label for="title" class="form-label">Content type</label>
                <input type="text" class="form-control" name="content_type" disabled  value="<?php echo $seo->content_type ?>">
            </div>



            <div class="mb-3">
                <label for="title" class="form-label">Meta description</label>
                <textarea class="form-control" name="meta_description" placeholder="Meta description" rows="3"><?php echo $seo->meta_description ?></textarea>
            </div>

            <button type="submit" class="btn btn-1">Lưu</button>
            <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
        </form>
    </div>
</div>