<?php
$data = $args['flexible'];
?>
<div class="block_heading">
    <div class="row">
        <?php if($data['image']) : ?>
            <div class="col-12 col-md-auto">
                <img class="block_heading_img" src="<?php echo $data['image']; ?>" alt="<?php echo $data['title']; ?>">
            </div>
         <?php endif; ?>
        <div class="col-12 col-md">
            <div class="content">
                <?php if($data['title']) : ?>
                    <div class="title">
                        <?php echo $data['title']; ?>
                    </div>
                <?php endif; ?>

                <?php if($data['description']) : ?>
                    <div class="desc">
                        <?php echo $data['description']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>