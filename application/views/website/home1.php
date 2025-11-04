<div class="service-box">
    <?php 
    $i = 0;
    foreach ($categories as $category): 
        if ($i % 2 == 0) echo '<div class="d-flex justify-content-center flex-wrap">';
    ?>
        <div class="project-grid-style2 text-center">
            <div class="project-details card-img">
                <img src="<?php echo base_url('uploads/categories/'.$category['category_img']); ?>" alt="<?php echo $category['category_name']; ?>">
                <div class="portfolio-icon">
                    <a href="#!" class="position-absolute start-50 top-50 translate-middle">
                        <button class="butn small"><?php echo $category['category_name']; ?></button>
                    </a>
                </div>
                <div class="portfolio-post-border"></div>
            </div>
            <h6 class="mt-3"><?php echo $category['category_name']; ?></h6>
        </div>
    <?php 
        $i++;
        if ($i % 2 == 0) echo '</div>'; // Close row every 2 items
    endforeach; 
    if ($i % 2 != 0) echo '</div>'; // Close last row if not already closed
    ?>
</div>
