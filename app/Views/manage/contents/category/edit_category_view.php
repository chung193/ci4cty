<?php
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>
<div class="row">
  <div class="col-12 col-md-8">
    <form action="<?php echo base_url() ?>/manage/category/update" id="editCategory" method="post">

      <?php if (session()->getFlashdata('msgErr')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" id="title" class="form-control" name="title" value="<?php echo $category->title ?>" placeholder="tiêu đề">
      </div>

      <div class="mb-3 row">
        <label for="title" class="form-label">Danh mục cha</label>
        <div class="col-md-4 col-10">
          <select name="parent_id" class="form-control select2 select2-hidden-accessible">
            <option value="0" <?php if ($category->parent_id == 0) {
                                echo 'selected';
                              }; ?>>Không có danh mục cha</option>
            <?php showCategoriesEdit($category->parent_id, $category_list); ?>
          </select>
        </div>
      </div>

      <input type="hidden" class="form-control" name="id" value="<?php echo $category->id ?>">


      <div class="mb-3">
        <label for="title" class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" value="<?php echo $category->slug ?>" placeholder="slug">
      </div>

      <button type="submit" class="btn btn-1">Lưu lại</button>
      <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
  </div>
  <div class="col-md-4 col-12">
  <?php
  echo view('manage/contents/SEO/seo', $data)
  ?>
  </div>
  </form>
</div>