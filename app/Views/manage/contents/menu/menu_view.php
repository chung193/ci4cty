<?php
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<a href="<?php echo base_url() ?>/manage/menu/add/" class="btn btn-1">Thêm mới</a>
<div class=" mt-4 mb-4">
  <table id="dttable" class="display border">
    <thead>
      <tr>
        <th>Tên menu</th>
        <th>code</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody class="border">
      <?php
      foreach ($menu as $val) {
      ?>
        <tr>
          <td><a href="<?php echo base_url() ?>/manage/menu/item/<?= $val['id']?>"><?= $val['name'] ?></a></td>
          <td><?= $val['code'] ?></td>
          <td>
            <a data-toggle="tooltip" data-placement="top" title="sửa" href="<?= base_url()?>/manage/menu/edit/<?= $val['id']?>" class="text-info"><i class="fas fa-edit"></i></a>
            <a data-toggle="tooltip" data-placement="top" title="xóa" href="<?= base_url()?>'/manage/menu/delete/<?= $val['id']?>" class="text-danger"><i class="fas fa-times"></i></a>
          </td>
        </tr>

      <?php
      }
      ?>
    </tbody>
  </table>
</div>