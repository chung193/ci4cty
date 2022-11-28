<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

<a class="btn btn-1 mb-3" href="<?php echo base_url() ?>/manage/page/add/">Thêm mới</a>


<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#public" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Bài viết công khai (<?php echo $countpagepublic ?>)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#draft" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Nháp (<?php echo $countpagedraft ?>)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Tất cả (<?php echo $countall ?>)</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="public" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <table class="border display">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Tác giả</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pagePublic as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?php
                            if ($row['published'])
                                echo '<i class="bi bi-check2"></i>';
                            ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['createdat'])); ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" href="<?php echo base_url() ?>/manage/page/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/page/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <table class="border display">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Tác giả</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pagedraft as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?php
                            if ($row['published'])
                                echo '<i class="bi bi-check2"></i>';
                            ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['createdat'])); ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" href="<?php echo base_url() ?>/manage/page/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/page/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        <table class="border display">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Tác giả</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($page as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?php
                            if ($row['published'])
                                echo '<i class="bi bi-check2"></i>';
                            ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['createdat'])); ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" href="<?php echo base_url() ?>/manage/page/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/page/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>