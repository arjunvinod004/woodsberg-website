<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
          $this->load->model('admin/Productmodel');

    }

    
//MARK: upload product
public function import() {
 $logged_in_store_id = $this->session->userdata('logged_in_store_id');   
if (!empty($_FILES['excel_file']['tmp_name'])) {
    $file = fopen($_FILES['excel_file']['tmp_name'], 'r');
    $header = fgetcsv($file); // Skip header row if exists

    while (($row = fgetcsv($file)) !== false) {
        // print_r($row);
        $shipping      = $row[0] ?? null;
        $product_name  = trim($row[1]) ?: null;
        $product_code  = $row[2] ?? null;
        $description   = $row[4] ?? null;
        $ctns          = (int)($row[5] ?? 0);
        $pcns          = (int)($row[6] ?? 0);
        $total_stock   = (int)($row[7] ?? 0);
        $category_name =  (int)($row[8] ?? null);
        $subcategory_name =  (int)($row[9] ?? null);
    //    $image_filename = trim($row[3]) ?? null;
    //    $image_path = null;

// if (!empty($image_filename)) {
//     // Source folder where images are kept before import
//     $source = FCPATH . 'temp_uploads/' . $image_filename;
    
//     // Destination folder
//     $destination = FCPATH . 'uploads/product/' . $image_filename;

//     if (file_exists($source)) {
//         // Copy image to uploads/product
//         copy($source, $destination);

//         // Save path for DB
//         $image_path = base_url('uploads/product/' . $image_filename); 
//     }
// }


$category_id = $this->Productmodel->getIdByName('categories', $row[8], 'category_name');

$subcategory_id = $this->Productmodel->getIdByName('subcategories', $row[9], 'name');
        $data = [
            
            'category_id'    => $category_id ??null,
            'subcategory_id' => $subcategory_id ??null,
            'parent_id'      => 0??null,
            'shipping'       => $shipping,
            'product_name'   => $product_name,
            'item_code'   => $product_code,
            'store_id' =>$logged_in_store_id, //If admin store id default 0 
            'image'          => null, // Always null
            'image1'         => null, // Always null
            'image2'         => null, // Always null
            'image3'         => null, // Always null
            'description'    => $description,
            'weight'         => null, // Always null
            'kg_g'           => 0, // Always null
            'is_home'        => 0,
            'is_bestseller'  => 0,
            'is_seasonaloffer' => 0,
            'price'=>0,
            'wholesale_price'=>0,
            'retail_price'=>0,
            'franchise_price'=>0,
            'export_price'=>0,
            'ctns'           => $ctns,
            'pcs'           => $pcns,
            'total_stock'    => $total_stock,
            'is_active'      => 1,
            
        ];

        $exists = $this->db->get_where('product', [
            'item_code' => $product_code,
        ])->row();
        // print_r($exists);

        if ($exists) 
        {
            continue;
        }
        else{
            $this->db->insert('product', $data);
            $stock = $total_stock;
            $product_id = $this->db->insert_id();
                // echo $product_id;
            $user_id = $this->session->userdata('loginid');
            $storestock= $this->Productmodel->insert_product_stock($stock,$product_id,$user_id);    
        }



    }
    fclose($file);

    echo json_encode(["success" => "success", "message" => "Data imported successfully"]);
}
 else {
        echo "❌ No file selected!";
    }
}



//MARK: upload category
public function importcategory(){
 $logged_in_store_id = $this->session->userdata('logged_in_store_id');  
 $order_index=$this->Productmodel->getNextOrderIndex(); 
if (!empty($_FILES['category_excel_file']['tmp_name'])) {
    $file = fopen($_FILES['category_excel_file']['tmp_name'], 'r');
    $header = fgetcsv($file); // Skip header row if exists

    while (($row = fgetcsv($file)) !== false) {
        // print_r($row);
        $category_name     = $row[0] ?? null;
        $category_desc  = trim($row[1]) ?: null;
        $image  = $row[2] ?? null;

       
        
        $data = [
            'store_id' => $logged_in_store_id,
            'category_name'   => $category_name,
            'category_desc'   => $category_desc,
            'category_img'   => $image,
            'is_header'   => 0,
            'is_footer'   => 0,
            'order_index' =>$order_index ++,
            'is_active'      => 1,
            
        ];

        $exists = $this->db->get_where('categories', [
            'category_name' => $category_name,
        ])->row();
        // print_r($exists);

        if ($exists) 
        {
            continue;
        }
        else
        {
            $this->db->insert('categories', $data);   
        }



    }
    fclose($file);

    echo json_encode(["success" => "success", "message" => "Data imported successfully"]);
}
 else {
        echo "❌ No file selected!";
    } 
}


//MARK: upload subcategory
public function importsubcategory(){
 $logged_in_store_id = $this->session->userdata('logged_in_store_id');  
 $order_index=$this->Productmodel->getNextOrderIndexsubcategories(); 
if (!empty($_FILES['subcategory_excel_file']['tmp_name'])) {
    $file = fopen($_FILES['subcategory_excel_file']['tmp_name'], 'r');
    $header = fgetcsv($file); // Skip header row if exists
    while (($row = fgetcsv($file)) !== false) {
        // print_r($row);
        $category_name     = $row[0] ?? null;
        $subcategory_name  = trim($row[1]) ?: null;
        $image  = $row[2] ?? null;
        $category_id = $this->Productmodel->getIdByName('categories', $row[0], 'category_name');
        
        
        $data = [
            'store_id' => $logged_in_store_id,
            'category_id'   => $category_id,
            'name'   => $subcategory_name,
            'image'   => $image,
            'order_index' =>$order_index ++,
            'is_active'      => 1,
            
        ];

        $exists = $this->db->get_where('subcategories', [
            'name' => $subcategory_name,
        ])->row();
        // print_r($exists);

        if ($exists) 
        {
            continue;
        }
        else
        {
            $this->db->insert('subcategories', $data);   
        }



    }
    fclose($file);

    echo json_encode(["success" => "success", "message" => "Data imported successfully"]);
}
 else {
        echo "❌ No file selected!";
    } 
}

    // if (!empty($_FILES['excel_file']['tmp_name'])) {
    //     $file = fopen($_FILES['excel_file']['tmp_name'], 'r');

    //     $header = fgetcsv($file); // Skip header row
       
    //     while (($row = fgetcsv($file)) !== false) {
    //         $image_filename = $row[5];

    //         // Full path for database
    //         $image_path = '';
    //         if (!empty($image_filename) && file_exists(FCPATH.'uploads/product/'.$image_filename)) {
    //             $image_path = base_url('uploads/product/'.$image_filename);
    //         } else {
    //             $image_path = base_url('uploads/product/default.png'); // default image
    //         }

    //         $data = [
    //             'category_id'     => $row[0],
    //             'parent_id'       => $row[1],
    //             'subcategory_id'  => $row[2],
    //             'name'            => $row[3],
    //             'price'           => $row[4],
    //             'image'           => base_url('uploads/product/'.$image_filename),
    //         ];

    //         $this->db->insert('excel', $data);
    //     }

    //     fclose($file);

    //     echo "✅ CSV imported successfully!";
    // } else {
    //     echo "❌ No file selected!";
    // }
// }



    // ✅ Export DB Data into Excel
    // public function export() {
    //     $this->excel->setActiveSheetIndex(0);

    //     $this->excel->getActiveSheet()->setCellValue('A1', 'Name');
    //     $this->excel->getActiveSheet()->setCellValue('B1', 'Email');
    //     $this->excel->getActiveSheet()->setCellValue('C1', 'Phone');

    //     $users = $this->db->get('users')->result_array();
    //     $row = 2;

    //     foreach ($users as $u) {
    //         $this->excel->getActiveSheet()->setCellValue('A'.$row, $u['name']);
    //         $this->excel->getActiveSheet()->setCellValue('B'.$row, $u['email']);
    //         $this->excel->getActiveSheet()->setCellValue('C'.$row, $u['phone']);
    //         $row++;
    //     }

    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="users_export.xls"');
    //     header('Cache-Control: max-age=0');

    //     $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    //     $writer->save('php://output');
    // }
}