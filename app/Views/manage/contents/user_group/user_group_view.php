<?php
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<a href="<?php echo base_url() ?>/manage/user-group/add/" class="btn btn-1">Thêm mới</a>
<div class=" mt-4 mb-4">
  <table id="dttable" class="display border">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên nhóm</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody class="border">
      <?php
      foreach ($user_group as $val) {
      ?>
        <tr>
          <td><?= $val['id'] ?></td>
          <td><a href="<?= base_url().'/manage/permission/'.$val['id']?>"><?= $val['name'] ?></a></td>
          <td>
            <a data-toggle="tooltip" data-placement="top" title="sửa" class="text-info" href="<?php echo base_url() ?>/manage/user-group/edit/<?= $val['id']; ?>"><i class="fas fa-edit"></i></a>
            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/user-group/delete/<?= $val['id']; ?>"><i class="fas fa-times"></i></a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>