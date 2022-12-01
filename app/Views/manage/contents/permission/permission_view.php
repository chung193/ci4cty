<?php
$db = db_connect();
$tables = $db->listTables();
$demo = (array)json_decode($permission->permission);
//print_r($demo); die();
// foreach ($tables as $tb) {
//   $demo[$tb] = array(1, 1, 1, 1);
// }
//print_r($demo);
// echo json_encode($demo);

// if ($_POST) {
//   echo json_encode($_POST);
//   die();
// }


$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>
<h3>Phân quyền cho nhóm người dùng <strong><?= $permission->grname ?></strong></h3>
<div class=" mt-4 mb-4  border">

  <form method="post" action="<?= base_url().'/manage/save-permission'?>">
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Xem</th>
          <th>Thêm</th>
          <th>Sửa</th>
          <th>Xóa</th>
          <th style="width:180px">check/ uncheck</th>
        </tr>
      </thead>
      <tbody>
        <?php


        foreach ($tables as $table) {
        ?>
          <tr>
            <td><?= $table ?></td>
            <?php //echo $demo[$table][0]; die();
            ?>
            <td>
              <div class="form-check">
                <?php $isChecked = (isset($demo[$table][0]) && $demo[$table][0] == 1) ? 'checked' : ''; ?>
                <input class="form-check-input" table="<?= $table ?>" type="checkbox" name="data[<?= $table ?>][]" value="1" <?= $isChecked ?>>
              </div>
            </td>

            <input type="hidden" name="id" value="<?= $permission->id?>">
            <input type="hidden" name="group_id" value="<?= $permission->group_id?>">
            <td>
              <div class="form-check">
                <?php $isChecked = (isset($demo[$table][1]) && $demo[$table][1] == 1) ? 'checked' : ''; ?>
                <input class="form-check-input" table="<?= $table ?>" name="data[<?= $table ?>][]" type="checkbox" value="1" <?= $isChecked ?>>
              </div>
            </td>

            <td>
              <div class="form-check">
                <?php $isChecked = (isset($demo[$table][2]) && $demo[$table][2] == 1) ? 'checked' : ''; ?>
                <input class="form-check-input" table="<?= $table ?>" type="checkbox" name="data[<?= $table ?>][]" value="1" <?= $isChecked ?>>
              </div>
            </td>

            <td>
              <div class="form-check">
                <?php $isChecked = (isset($demo[$table][3]) && $demo[$table][3] == 1) ? 'checked' : ''; ?>
                <input class="form-check-input" table="<?= $table ?>" type="checkbox" name="data[<?= $table ?>][]" value="1" <?= $isChecked ?>>
              </div>
            </td>

            <td>
              <div class="form-check">
                <button type="button" class="btn btn-1" btn="<?= $table ?>" onclick="checkAll('<?= $table ?>')">Check all</button>
              </div>
            </td>
          </tr>
        <?php
          }
        

        ?>

      </tbody>
    </table>
    <div class="p-3">
      <button type="submit" class="btn btn-1">Lưu</button>
      <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
    </div>
  </form>
</div>