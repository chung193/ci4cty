<?php
$data = array(
  'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<a href="<?php echo base_url() ?>/manage/category/add/" class="btn btn-1">Thêm mới</a>
<div class=" mt-4 mb-4">
  <table id="dttable" class="display border">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>url</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody class="border">
      <?php
      cat_table($category);
      ?>
    </tbody>
  </table>
</div>