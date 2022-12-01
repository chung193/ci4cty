<?php
$session = session();
$post = $session->get('post');
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>
<div class="row mb-3">
    <div class="col-12 col-md-8">
        <form action="<?php echo base_url() ?>/manage/post/save" method="post" id="addPost" enctype='multipart/form-data'>
            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" id="title" class="form-control" value="<?php if(isset($post['title'])){ echo $post['title'];}else{ echo '';}?>" name="title" placeholder="Tiêu đề">
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Danh mục cha</label>
                        <select class="form-control select2 select2-hidden-accessible" name="parentid" aria-label="Default select example">
                            <?php
                            showCategories($category);
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" placeholder="slug" value="<?php if(isset($post['slug'])){ echo $post['slug'];}else{ echo '';}?>">
                    </div>
                </div>
            </div>



            <div class="mb-3">
                <label for="title" class="form-label">Mô tả</label>
                <textarea class="form-control" name="description" placeholder="content" rows="3"><?php if(isset($post['content'])){ echo $post['content'];}else{ echo '';}?></textarea>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Nội dung</label>
                <textarea class="form-control" name="content" style="min-height: 400px" placeholder="Nội dung" id="editor" rows="3"><?php if(isset($post['title'])){ echo $post['title'];}else{ echo '';}?></textarea>
            </div>



            <button type="submit" class="btn btn-1">Lưu</button>
            <button type="button" onclick="history.back();" class="btn btn-light border">Hủy</button>


    </div>
    <div class="col-12 col-md-4">
        <?php echo view('manage/contents/SEO/seo', $data)
        ?>
        <hr>
        <div class="form-check form-switch">
            <input class="form-check-input" name="published" type="checkbox" id="flexSwitchCheckChecked" value="1" checked>
            <label class="form-check-label" for="flexSwitchCheckChecked">Xuất bản</label>
        </div>


        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" name="img" id="imgus" class="custom-file-input form-control">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>

        <div id="preview" class="pb-3"></div>
        </form>
    </div>
</div>