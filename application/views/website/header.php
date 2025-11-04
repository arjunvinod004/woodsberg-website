<!DOCTYPE html>
<html lang="en">

<head>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woodsberg</title>
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins1.css"> -->
    <!-- plugins -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins1.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins/magnifypopup.css"> -->
    <!-- <link href="<?php echo base_url();?>assets/website/css/styles1.css" rel="stylesheet"> -->
    <link href="<?php echo base_url('assets/website/css/styles1.css?v=' . time()); ?>" rel="stylesheet">

    <!-- <link href="<?php echo base_url();?>assets/website/css/styles1.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins/xzoom.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/lighbox.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/themefy-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/search.css">
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1178684731076899');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1178684731076899&ev=PageView&noscript=1"
/></noscript>

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "tujwubi2h2");
</script>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FT0YFXK49G"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-FT0YFXK49G');
</script>



</head>

<body>
    <?php
// 1. Determine price based on order type
if ($ordertype == 'ws') {
    // $price = $product['wholesale_price'];
    $redirect_url = base_url('wholesale');
} elseif ($ordertype == 'rt') {
    // $price = $product['retail_price'];
    $redirect_url = base_url(); // Homepage or retail landing
} elseif ($ordertype == 'bb') {
    // $price = $product['franchise_price'];
    $redirect_url = base_url('b2b');
} elseif ($ordertype == 'exp') {
    // $price = $product['export_price'];
    $redirect_url = base_url('export');
}
else {
    // $price = $product['retail_price']; // default fallback
    $redirect_url = base_url();
}

?>

    <header class="header-style3">

        <div class="navbar-default">
            <!-- top search -->
            <div class="top-search bg-primary">
                <div class="container">
                    <form class="search-form" action="<?php echo base_url(); ?>website/product/search" method="get"
                        accept-charset="utf-8">
                        <div class="input-group">
                            <span class="input-group-addon close-search">
                                <i class="fas fa-times mt-1"></i>
                            </span>
                            <input type="text" class="search-form_input form-control" name="search" autocomplete="off"
                                placeholder="Search product....">
                            <!-- <span class="input-group-addon close-search"><i class="fas fa-times mt-1"></i></span> -->
                            <button class="search-form_submit fas fa-search text-white" type="submit"></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end top search -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="menu_area alt-font">
                            <nav class="navbar navbar-expand-lg navbar-light p-0">

                                <div class="navbar-header navbar-header-custom">
                                    <!-- logo -->
                                    <a href="<?php echo $redirect_url;?>" class="navbar-brand logo6"><img id="logo"
                                            src="<?php echo base_url();?>assets/website/images/woodsberg_logo.png"
                                            alt="logo"></a>
                                    <!-- end logo -->
                                </div>

                                <div class="navbar-toggler"></div>

                                <!-- menu area -->
                                <ul class="navbar-nav ms-auto" id="nav" style="display: none;">
                                    <li><a href="<?php echo $redirect_url;?>">Home</a></li>
                                    <?php foreach ($headercategory as $category): ?>
                                    <li>
                                        <a
                                            href="<?php echo base_url('product/' . $category['id']); ?>"><?php echo $category['category_name']; ?></a>
                                        <?php
                                                    $hasSub = false;
                                                    foreach ($subcategories as $sub) 
                                                    {
                                                        if ($sub['category_id'] == $category['id']) 
                                                        {
                                                            $hasSub = true;
                                                            break;
                                                        }
                                                    }
                                                ?>


                                        <?php if ($hasSub): ?>

                                        <ul>
                                            <?php foreach ($subcategories as $sub): ?>

                                            <?php if ($sub['category_id'] == $category['id'] ):?>

                                            <li>
                                                <a
                                                    href="<?php echo base_url('product/' . $category['id'] . '/' . $sub['id']); ?>">

                                                    <?= $sub['name']; ?></a>
                                            </li>
                                            <?php endif; ?>

                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; ?>
                                    <li><a href="<?php echo base_url();?>home/contact">Contact</a></li>
                                    <!-- <?php echo base_url();?>home/contact -->



                                </ul>
                                <!-- end menu area -->

                                <!-- atribute navigation -->
                                <div class="attr-nav">
                                    <ul>
                                        <li class="dropdown mx-2">
                                            <a href="<?php echo base_url();?>cart" title="Cart" class="dropdown-toggle"
                                                data-bs-toggle="#">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="badge-count badge bg-primary"></span>
                                            </a>
                                            <ul class="dropdown-menu cart-list" id="cart_item">

                                            </ul>
                                        </li>
                                        <li class="search" id="search"><a href="#!"><i class="fas fa-search"></i></a>
                                        </li>
                                        <!-- <li><a href="<?php echo base_url();?>wishlist" title="Wishlist"> <i
                                                    class="fas fa-heart"></i>
                                                <span class="badges bg-primary"></span>
                                            </a></li> -->

                                        <li><a href="<?php echo base_url();?>home/logout" title="Logout"> <i
                                                    class=" fas fa-solid fa-arrow-right-from-bracket"></i>
                                                <span class=" bg-primary"></span>

                                            </a></li>

                                    </ul>
                                </div>
                                <!-- end atribute navigation -->

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <div class="alert alert-success alert-dismissible fade show  custom-alert d-none " role="alert"
        style="float: right;">
        <a href="<?php echo base_url();?>cart" class="close" data-dismiss="alert" aria-label="close"> <i
                class="fas fa-shopping-cart"></i> View
            Cart
        </a>
    </div>
</body>

</html>