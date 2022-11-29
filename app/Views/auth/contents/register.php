
<div class="bg-light d-flex justify-content-center align-items-center vh-100 ">
  <form class="border p-4 rounded shadow-lg" id="regForm" method="post" action="<?php echo base_url()?>/auth/register/save">
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
        <p class="d-inline">Đã có tài khoản?<a href="<?= base_url()?>/auth/login"> Đăng nhập</a></p>
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
      }
    });
  });

</script>
