<?php
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>
<a class="btn btn-1 mb-3" href="<?php echo base_url() ?>/manage/user/add/">Thêm mới</a>


<div class="row">
  <div class="col-md-12 col-12">
    <table class="display border">
      <thead>
        <tr>
          <th>Tên</th>
          <th>Email</th>
          <th>Quyền</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($user as $row) {
          if (!$row['is_superadmin']) { ?>
            <tr>
              <td><?= $row['nicename']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['grname']; ?></td>
              <td>
                <a  data-toggle="tooltip" data-placement="top" title="sửa"  href="<?php echo base_url() ?>/manage/user/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                <a  data-toggle="tooltip" data-placement="top" title="xóa"  class="text-danger" href="<?php echo base_url() ?>/manage/user/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
              </td>
            </tr>
        <?php }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>