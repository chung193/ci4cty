

<div class="bg-light d-flex justify-content-center align-items-center vh-100 ">
  <form class="border p-4 rounded shadow-lg" id="loginForm" method="post" action="<?php echo base_url()?>/auth/sendresetlink">
    <h3><strong>Điền đúng email để lấy lại mật khẩu</strong></h3>
    <?php if (session()->getFlashdata('msgErr')) : ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('msgErr') ?></div>
    <?php endif; ?>
    <div class="form-group mb-3">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Nhập email" value="<?= set_value('email') ?>">
    </div>

    <button type="submit" class="btn btn-1 rounded-pill"><strong>Gửi mail</strong></button>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>

<script>
  $().ready(function() {
    $("#loginForm").validate({
      onsubmit: true,
      rules: {
        "email": {
          required: true,
          email: true
        },
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

