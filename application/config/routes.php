<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home/index';
// $route['products'] = 'website/products/index';
$route['email'] = 'home/email';
$route['admin/test']='admin/Test/index';



// $route['home/category/(:num)'] = 'home/getcategoryproducts/$1';
$route['cart'] = 'website/Cartcontroller/index';
$route['cart/add'] = 'website/Cartcontroller/add';
$route['cart/addvariant'] = 'website/Cartcontroller/addvariant';
$route['cart/addaddon'] = 'website/Cartcontroller/addaddon';
$route['cart/update'] = 'website/Cartcontroller/update';
$route['cart/get'] = 'website/Cartcontroller/get';
$route['cart/getpreviousorders'] = 'website/Cartcontroller/getpreviousorders';
$route['cart/delete'] = 'website/Cartcontroller/delete';
$route['cart/deleteparent'] = 'website/Cartcontroller/deleteparent';
$route['cart/updateQuantity'] = 'website/Cartcontroller/updateQuantity';
$route['cart/updateCartQuantityOutOfStock'] = 'website/Cartcontroller/updateCartQuantityOutOfStock'; //Decrease cart quantity in cart page
$route['product/current_stock'] = 'website/Products/current_stock';
// $route['product/(:num)'] = 'website/product/$1';
$route['product'] = 'website/product';
$route['product/(:num)'] = 'website/product/index/$1'; 
$route['product/(:num)/(:num)'] = 'website/product/index/$1/$2'; 
$route['wholesale'] = 'home/wholesale';
$route['clear']='home/clear';
$route['export'] = 'home/Export';
$route['b2b'] = 'home/B2B';
$route['details/(:num)'] = 'home/productpage/$1'; //['product']
$route['payments'] = 'payment/payments';
$route['cart']     = 'cart/cartview';
$route['wishlist'] = 'cart/wishlist';
$route['home/category/(:any)'] = 'home/category/$1';
$route['home/wholesalecategory/(:any)'] = 'home/wholesalecategory/$1';
$route['home/exportcategory/(:any)'] = 'home/exportcategory/$1';

$route['owner/product/(:num)'] = 'owner/product/$1';
$route['website/products/orderListing/(:num)/(:num)'] = 'website/products/orderListing/$1/$2';

$route['about'] = 'website/pages/about';
$route['contact'] = 'website/pages/contact';
$route['website/logout'] = 'website/user/logout';
$route['website/products/(:num)/(:num)'] = 'website/products/load_site/$1/$2'; //
$route['website/load_orders/(:num)/(:num)'] = 'website/products/load_orders/$1/$2';
$route['website/products/shop(:num)/(:num)/(:num)'] = 'website/products/shop/$1/$2/$3';

$route['forgotpassword'] = 'admin/Login/forgotpassword';
$route['Login'] = 'admin/Login';
$route['admin'] = 'admin/login';
$route['dashboard'] = 'admin/Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;