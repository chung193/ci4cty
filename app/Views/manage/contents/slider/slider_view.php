<?php
$data = array(
    'title' => $title
);
echo view('manage/components/breadcrumb', $data)
?>

    <a class="btn btn-1 mb-3"  href="<?php echo base_url()?>/manage/slider/add/" >Thêm mới</a>
    <table class="display border">
        <thead>
            <tr>
                <th>Tiêu đề chính</th>
                <th>Tiêu đề phụ</th>
                <th>URL</th>
                <th>Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($slider as $row){
                    ?>
                    <tr>
                        <td><?php echo $row['main_title'] ?></td>
                        <td><?php echo $row['sub_title'] ?></td>
                        <td><?php echo $row['url'] ?></td>
                        <td><img src="<?php echo base_url().'/public/uploads/slider/'.$row['img'] ?>" width="200"></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" href="<?php echo base_url() ?>/manage/slider/edit/<?php echo $row['id']?>" class="text-info"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" href="<?php echo base_url() ?>/manage/slider/delete/<?php echo $row['id']?>" class="text-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>



