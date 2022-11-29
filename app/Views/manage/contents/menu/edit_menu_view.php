
<div class="row">
  <div class="col-12 col-md-4 offset-md-4">
    <?php
    $data = array(
      'title' => $title
    );
    echo view('manage/components/breadcrumb', $data)
    ?>
    <form action="<?php echo base_url() ?>/manage/menu/update" id="editMenu" method="post">

      <?php if (session()->getFlashdata('msgErr')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="title" class="form-label">Tên menu</label>
        <input type="text" id="title" class="form-control" name="name" value="<?php echo $menu->name ?>" placeholder="tên menu">
      </div>


      <input type="hidden" class="form-control" name="id" value="<?php echo $menu->id ?>">


      <div class="mb-3">
        <label for="title" class="form-label">Code</label>
        <input type="text" class="form-control" name="code" value="<?php echo $menu->code ?>" placeholder="code">
      </div>

      <button type="submit" class="btn btn-1">Lưu lại</button>
      <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
  </div>
  </form>
</div>