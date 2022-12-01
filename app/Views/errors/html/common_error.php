<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title>Xin lỗi!</title>

    <style type="text/css">
        a{
            text-decoration: none;
            font-weight: 400;
        }
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>
<body>

    <div class="container text-center">

        <h1 class="headline">Chúng tôi rất tiếc!</h1>

        <p class="lead">Bạn không có quyền truy cập trang này, hoặc trang này hiện tại không hiển thị.</p>
        <p class="lead">Nhấn vào <a href="#" onclick="history.back()">đây</a> để quay trở lại</p>
    </div>

</body>

</html>
