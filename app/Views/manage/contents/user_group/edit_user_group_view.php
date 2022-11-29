<?php
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>
<div class="row">
  <div class="col-12 col-md-4 offset-md-4">
    <form action="<?php echo base_url() ?>/manage/user-group/update" id="editUserGroup" method="post">

      <?php if (session()->getFlashdata('msgErr')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="title" class="form-label">Tên</label>
        <input type="text" id="title" class="form-control" name="name" value="<?php echo $user_group->name ?>" placeholder="tên">
      </div>


      <input type="hidden" class="form-control" name="id" value="<?php echo $user_group->id ?>">


      <button type="submit" class="btn btn-1">Lưu lại</button>
      <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
    </form>
  </div>
</div>