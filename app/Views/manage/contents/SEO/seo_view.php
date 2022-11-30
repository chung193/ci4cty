<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<a class="btn btn-1 mb-3" href="<?php echo base_url() ?>/manage/seo/add/">Thêm mới</a>


        <table class="border display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Content ID</th>
                    <th>Loại nội dung</th>
                    <th>Meta title</th>
                    <th>Meta description</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($seo as $row) : ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['content_id']; ?></td>
                        <td><?= $row['content_type']; ?></td>
                        <td><?= $row['meta_title']; ?></td>
                        <td><?= $row['meta_description']; ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" href="<?php echo base_url() ?>/manage/seo/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
