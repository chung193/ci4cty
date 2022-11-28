<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

    <a class="btn btn-1 mb-3" href="<?php echo base_url()?>/manage/post/add/">Thêm mới</a>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-public-tab" data-bs-toggle="pill" data-bs-target="#public" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Bài viết công khai (<?php echo $countpostpublic ?>)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Tất cả bài viết (<?php echo $countpost ?>)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-draft-tab" data-bs-toggle="pill" data-bs-target="#draft" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Bản nháp (<?php echo $countpostdraft ?>)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-trash-tab" data-bs-toggle="pill" data-bs-target="#trash" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false">Thùng rác (<?php echo $countposttrash ?>)</button>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="public" role="tabpanel" aria-labelledby="pills-public-tab" tabindex="0">
        <table class="border display" id="post1">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($postpublic as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['cattitle']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" class="text-info" href="<?php echo base_url() ?>/manage/post/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/post/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
        <table id="post2" class="border display">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($post as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['cattitle']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" class="text-info" href="<?php echo base_url() ?>/manage/post/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/post/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="pills-draft-tab" tabindex="0">
        <table id="post3" class="border display">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($postdraft as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['cattitle']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" class="text-info" href="<?php echo base_url() ?>/manage/post/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" class="text-danger" href="<?php echo base_url() ?>/manage/post/delete/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="pills-trash-tab" tabindex="0">
        <table id="post4" class="border display">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($posttrash as $row) : ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['cattitle']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= date("d-m-Y h:i:s", strtotime($row['updateat'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" class="text-info" href="<?php echo base_url() ?>/manage/post/edit/<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="khôi phục" class="text-success" href="<?php echo base_url() ?>/manage/post/restore/<?= $row['id']; ?>"><i class="fas fa-trash-restore-alt"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa"  class="text-danger" href="<?php echo base_url() ?>/manage/post/delete-from-trash/<?= $row['id']; ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>