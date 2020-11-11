<?php
require_once(ROOT.'/template/header.php');
?>
    <section id="form"><!--form-->

        <div class="container">
            <div class="form-container">
                <form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post"
                      action="/upload">
                    <div class="form-group">
                        <p>Please Choose Image: </p>
                        <input type="file" class="form-control" name="images" id="images"
                               placeholder="Please choose your image">
                        <span class="help-block"></span>
                    </div>
                    <div id="loader" style="display: none;">
                        Please wait image uploading to server....
                    </div>
                    <input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
                </form>
            </div>
            <div class="clearfix"></div>
            <div id="uploaded_images" class="uploaded-images">
                <div id="error_div">
                </div>

                <div id="success_div">
                    <? if (count($images) > 0): ?>
                        <? foreach ($images as $image): ?>
                            <div class="image__item">
                                <a class="lightbox" href="#<?= $image['thumbnail_image']; ?>">
                                    <img src="/../images/<?= $image['thumbnail_image']; ?>"/>
                                </a>
                                <button type='button' class='btn btn-danger btn-sm delete-btn'
                                        data-id="<?= $image['id']; ?>">Delete
                                </button>
                                <div data-id="<?= $image['id']; ?>" class="lightbox-target"
                                     id="<?= $image['thumbnail_image']; ?>">
                                    <img src="/../images/<?= $image['original_image']; ?>"/>
                                    <a class="lightbox-close" href="#"></a>
                                </div>
                            </div>

                        <? endforeach; ?>

                    <? endif; ?>
                </div>
            </div>
        </div>

    </section><!--/form-->
<?
require_once(ROOT.'/template/footer.php');
?>