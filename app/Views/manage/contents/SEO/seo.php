
<?php 
  $session = session();
  $post = $session->get('post');
?>
  <div class="form-group">
    <label class="form-label">Thẻ tiêu đề (meta title)</label>
    <input type="text" name="meta_title" class="form-control" <?php
                                                              if (isset($seo)) {
                                                                echo 'value="' . $seo->meta_title . '"';
                                                              }
                                                              ?> id="exampleInputEmail1" placeholder="meta title">
  </div>


  <div class="form-group">
    <label class="form-label">Thẻ mô tả (meta description)</label>
    <textarea class="form-control" name="meta_description" rows="3" placeholder="meta description ..."><?php
                                                                                            if (isset($seo)) {
                                                                                              echo $seo->meta_description;
                                                                                            }
                                                                                            ?></textarea>
  </div>

