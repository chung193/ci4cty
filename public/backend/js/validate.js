// all validate here
$(document).ready(function () {
  $("#addCategory").validate({
    onsubmit: true,
    rules: {
      "title": {
        required: true,
      }
    },
    messages: {
      "title": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#editCategory").validate({
    onsubmit: true,
    rules: {
      "title": {
        required: true,
      }
    },
    messages: {
      "title": {
        required: "Trường này là bắt buộc",
      },
    }
  });


  $("#addPost").validate({
    onsubmit: true,
    rules: {
      "title": {
        required: true,
      },
      "content": {
        required: true,
      }
    },
    messages: {
      "title": {
        required: "Trường này là bắt buộc",
      },
      "content": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#editPost").validate({
    onsubmit: true,
    rules: {
      "title": {
        required: true,
      },
      "content": {
        required: true,
      }
    },
    messages: {
      "title": {
        required: "Trường này là bắt buộc",
      },
      "content": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#addPage").validate({
    onsubmit: true,
    rules: {
      "title": {
        required: true,
      },
      "content": {
        required: true,
      }
    },
    messages: {
      "title": {
        required: "Trường này là bắt buộc",
      },
      "content": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#editPage").validate({
    onsubmit: true,
    rules: {
      "title": {
        required: true,
      },
      "content": {
        required: true,
      }
    },
    messages: {
      "title": {
        required: "Trường này là bắt buộc",
      },
      "content": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#editSeo").validate({
    onsubmit: true,
    rules: {
      "meta_title": {
        required: true,
      },
      "meta_description": {
        required: true,
      },
    },
    messages: {
      "meta_title": {
        required: "Trường này là bắt buộc",
      },
      "meta_description": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#addSlider").validate({
    onsubmit: true,
    rules: {
      "main_title": {
        required: true,
      },
      "url": {
        required: true,
      }
    },
    messages: {
      "main_title": {
        required: "Trường này là bắt buộc",
      },
      "url": {
        required: "Trường này là bắt buộc",
      },
    }
  });

  $("#editSlider").validate({
    onsubmit: true,
    rules: {
      "main_title": {
        required: true,
      },
      "url": {
        required: true,
      }
    },
    messages: {
      "main_title": {
        required: "Trường này là bắt buộc",
      },
      "url": {
        required: "Trường này là bắt buộc",
      },
    }
  });


});