<?php
$session = session();
$post = $session->get('post');
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<div class="row">
  <div class="col-12 col-md-8">

    <form action="<?php echo base_url() ?>/manage/page/save" method="post" id="addPage" enctype='multipart/form-data'>

      <?php if (isset($validation)) : ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" id="title" class="form-control" value="<?php if(isset($post['title'])){ echo $post['title'];}else{ echo '';}?>" name="title" placeholder="Tiêu đề">
      </div>


      <div class="mb-3">
        <label for="title" class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" value="<?php if(isset($post['title'])){ echo $post['title'];}else{ echo '';}?>" placeholder="slug">
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Mô tả</label>
        <textarea class="form-control" name="description" placeholder="Mô tả" rows="3"><?php if(isset($post['title'])){ echo $post['title'];}else{ echo '';}?></textarea>
      </div>

      <div class="mb-3">
        <label for="title" class="form-label">Nội dung</label>
        <textarea class="form-control" name="content" placeholder="Nội dung" id="editor" rows="3"><?php if(isset($post['title'])){ echo $post['title'];}else{ echo '';}?></textarea>
      </div>

      

      <button type="submit" class="btn btn-1">Lưu lại</button>
      <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
      
  </div>
  <div class="col-12 col-md-4">
    <?php echo view('manage/contents/SEO/seo', $data) 
      ?>
      <div class="form-check form-switch">
        <input class="form-check-input" name="published" type="checkbox" id="flexSwitchCheckChecked" value="1" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked">Công khai</label>
      </div>

      <div class="input-group mb-3">
        <div class="custom-file">
          <input type="file" name="img" id="imgus" class="custom-file-input form-control">
          <label class="custom-file-label" for="customFile">Chọn file ảnh đại diện</label>
        </div>
      </div>
  </div>
 
    </form>
</div>