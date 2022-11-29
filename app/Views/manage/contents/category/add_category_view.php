<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<div class="row">
    <div class="col-12 col-md-8">
        <form action="<?php echo base_url() ?>/manage/category/save" id="addCategory" method="post">
            <?php if (session()->getFlashdata('msgErr')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="tiêu đề">
            </div>

            <div class="mb-3 row">
                <label for="title" class="form-label">Danh mục cha</label>
                <div class="col-md-4 col-10">
                <select name="parent_id" class="form-control select2 select2-hidden-accessible ">
                    <option value="0">Không có danh mục cha</option>
                    <?php showCategories($category); ?>
                </select>
                </div>
            </div>


            <div class="mb-3">
                <label for="title" class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" placeholder="slug">
            </div>

            <button type="submit" class="btn btn-1">Lưu</button>
            <button type="button" onclick="history.back();" class="btn btn-light border">Hủy</button>
    </div>
    <div class="col-12 col-md-4">
        <?php echo view('manage/contents/SEO/seo', $data) 
            ?>
        </form>
        </div>
</div>
