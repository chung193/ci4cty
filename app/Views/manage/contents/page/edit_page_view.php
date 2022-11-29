<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<div class="row">
    <div class="col-12 col-md-8">
        <form action="<?php echo base_url() ?>/manage/page/update" method="post" id="addPage" enctype='multipart/form-data'>

            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Tiêu đề" value="<?php echo $page->title ?>">
            </div>


            <input type="hidden" class="form-control" name="id"  value="<?php echo $page->id ?>">

            <div class="mb-3">
                <label for="title" class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" placeholder="slug" value="<?php echo $page->slug ?>">
            </div>



            <div class="mb-3">
                <label for="title" class="form-label">Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả" rows="3"><?php echo $page->description ?></textarea>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Nội dung</label>
                <textarea class="form-control" name="content" placeholder="Nội dung" id="editor" rows="3"><?php echo $page->content ?></textarea>
            </div>

            

            <button type="submit" class="btn btn-1">Lưu</button>
            <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
    </div>
    <div class="col-12 col-md-4">
    <?php echo view('manage/contents/SEO/seo', $data) 
      ?>
      <div class="form-check form-switch">
                <input class="form-check-input" name="published" value="1" type="checkbox" id="flexSwitchCheckChecked" <?php
                                                                                                                        if ($page->published) {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                        ?>>
                <label class="form-check-label" for="flexSwitchCheckChecked">Xuất bản</label>
            </div>

            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="image" id="imgus" class="custom-file-input form-control">
                    <label class="custom-file-label" for="customFile">Chọn file ảnh đại diện</label>
                </div>
            </div>

            <div class="pb-2" id="preview">
                <?php if ($page->img) { ?>
                    <img src="<?php echo base_url() . '/public/uploads/page/' . $page->img ?>" width="200">
                <?php } ?>
            </div>
  </div>
 
    </form>
</div>