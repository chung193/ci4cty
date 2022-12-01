<div class="bg-light d-flex justify-content-center align-items-center vh-100 ">
  <form class="border p-4 rounded shadow-lg" id="regForm" method="post" action="<?php echo base_url() ?>/auth/register/save">
    <h3><strong>Đăng ký</strong></h3>
    <?php if (session()->getFlashdata('msgErr')) : ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
    <?php endif; ?>

    <div class="form-group mb-3">
      <label for="exampleInputEmail1">Họ và tên</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nicename" placeholder="Nhập tên" value="<?= set_value('nicename') ?>">
    </div>

    <div class="form-group mb-3">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Nhập email" value="<?= set_value('email') ?>">
    </div>
    <div class="form-group mb-3">
      <label for="exampleInputPassword1">Mật khẩu</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
    </div>

    <div class="form-group mb-3">
      <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="confpassword" placeholder="Nhập lại mật khẩu">
    </div>

    <div class="row p-0 mb-3">
      <div class="col-md-12 col-12">
        <p class="d-inline">Đã có tài khoản?<a href="<?= base_url() ?>/auth/login"> Đăng nhập</a></p>
      </div>
    </div>


    <button type="submit" class="btn btn-1 rounded-pill"><strong>Đăng ký</strong></button>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>

<script>
  $().ready(function() {
    $("#regForm").validate({
      onsubmit: true,
      rules: {
        "nicename": {
          required: true,
        },
        "email": {
          required: true,
          email: true
        },
        "password": {
          required: true,
          minlength: 6
        },
        "confpassword": {
          equalTo: "#password"
        }
      },
      messages: {
        "nicename": {
          required: "Trường tên không được để trống",
        },
        "email": {
          required: "Trường email không được để trống",
          email: "Trường này phải là 1 email"
        },
        "password": {
          required: "Trường mật khẩu không được để trống",
          minlength: "Trường mật khẩu có ít nhất 6 ký tự"
        },
        "confpassword": {
          equalTo: "Trường xác nhận mật khẩu cần khớp với mật khẩu"
        }
      }
    });
  });

  <?php 
  $session = session();
  if ($session->get('msg')) {
    echo "
          $.toast({
            heading: 'Thông tin',
            text: '.$session->get('msg').',
            showHideTransition: 'slide',
            icon: 'info'
        })
        ";
  };
  
  if ($session->get('msgErr')) {
    $err = trim(strip_tags($session->get('msgErr')));
    $array = explode('.', $err);
    if (count($array) > 1) {
      foreach ($array as $val) {
        if ($val != '') {
          $val = str_replace(array("\r", "\n"), '', $val);
          echo "
                            $.toast({
                                heading: 'Lỗi',
                                text: '$val',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                            ";
        }
      }
    } else {
      echo "
                    $.toast({
                        heading: 'Lỗi',
                        text: '$err',
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                    ";
    }
  }
  ?>
</script>