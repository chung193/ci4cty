<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>
<div class="row">
    <div class="col-12 col-md-8">

        <form action="<?php echo base_url() ?>/manage/post/update" method="post" id="editPost" enctype='multipart/form-data'>
            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Tiêu đề" value="<?php echo $post->title ?>">
            </div>

            <input type="hidden" class="form-control" name="id" placeholder="meta title" value="<?php echo $post->id ?>">


            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" placeholder="slug" value="<?php echo $post->slug ?>">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Danh mục cha</label>
                        <select class="form-control select2 select2-hidden-accessible" name="parentid" aria-label="Default select example">
                            <option selected>Chọn một danh mục</option>
                            <?php
                            foreach ($category as $item) {
                                // Nếu là chuyên mục con thì hiển thị
                                if ($item['id'] == $post->parentid) {
                                    echo '<option value="' . $item['id'] . '" selected>';
                                    echo $item['title'];
                                    echo '</option>';
                                } else {
                                    echo '<option value="' . $item['id'] . '">';
                                    echo $item['title'];
                                    echo '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


            </div>




            <div class="mb-3">
                <label for="title" class="form-label">Mô tả</label>
                <textarea class="form-control" name="description" placeholder="content" rows="3"><?php echo $post->description ?></textarea>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Nội dung</label>
                <textarea class="form-control" name="content" placeholder="content" id="editor" rows="3"><?php echo $post->content ?></textarea>
            </div>



            <button type="submit" class="btn btn-1">Lưu lại</button>
            <button type="button" onclick="history.back();" class="btn btn-light border">Hủy</button>

    </div>
    <div class="col-12 col-md-4">
        <?php echo view('manage/contents/SEO/seo', $data);
        ?>
        <hr>
        <div class="form-check form-switch">
            <input class="form-check-input" name="published" value="1" type="checkbox" id="flexSwitchCheckChecked" <?php
                                                                                                                    if ($post->published) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>
            <label class="form-check-label" for="flexSwitchCheckChecked">Xuất bản</label>
        </div>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" name="image" id="imgus" class="custom-file-input form-control">
                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
            </div>
        </div>

        <div class="pb-2" id="preview">
            <?php if ($post->img) { ?>
                <img src="<?php echo base_url() . '/public/uploads/post/' . $post->img ?>" width="200">
            <?php } ?>
        </div>
    </div>
    </form>
</div>