<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\File;
use DB;
use Session;
use AdminHelper;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;

class ImportProduct implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {            
        //echo "Work in progress..."; exit();
        if(!empty($collection))
        {
            $file = request()->file('file');
            DB::beginTransaction();
            try {
                $total_rows = count($collection);
                $total_rows = $total_rows-1;
                $count_rows = 0;                
                $curr_date = date('Y-m-d H:i:s');  
                $error=0;          
                foreach($collection as $key=>$row)
                {                    
                    if($key==0)
                    {
                        if($row[0]=='Category' && $row[1]=='Supplier ID' && $row[2]=='Item Code' && $row[3]=='Description' && $row[4]=='OUM' && $row[5]=='Opening Qty' && $row[6]=='Received Qty' && $row[7]=='Issued Qty' && $row[8]=='Balance Qty' && $row[9]=='Price' && $row[10]=='GST(%)' && $row[11]=='Taxable Amount' && $row[12]=='Total Amount')
                        {
                            //true;
                        }else{ 
                            $error=1;
                            Session::flash('error','Excel header not matched');                            
                        }
                        
                    }
                    if($key>0 && !empty($row[0]) && $error==0)
                    {                        
                        $created_by = AdminHelper::myId();
                        $category_id=0;
                        $sub_category_id=0;
                        $brand_id=0;
                        //Category
                        $category = Category::where('category_name', 'like', trim(strtolower($row[0])))->first();
                        if(!empty($category))
                        {
                            $category_id = $category->id;
                        }else{                            
                            $category_id = Category::insertGetId([                                
                                'category_name' => ucwords(trim($row[0])),
                                'status' => 0,
                                'created_by' => $created_by,
                                'created_at' => $curr_date
                            ]);
                        }
                        
                        //Supplier
                        if(!Supplier::where('id', $row[1])->exists())
                        {        
                            $error=1;
                            Session::flash('error',"Supplier id ".$row[1]." not found");
                            continue;
                            //echo "Supplier id ".$row[1]." not found"; die();
                        }
                        $supplier_id = $row[1];
                        // $supplier = Supplier::where('name', 'like', strtolower($row[1]))->first();
                        // if(!empty($supplier))
                        // {
                        //     $supplier_id = $supplier->id;
                        // }else{                            
                        //     $supplier_id = Supplier::insertGetId([
                        //         'name' => ucwords($row[1]),
                        //         'created_by' => $created_by,                            
                        //         'created_at' => $curr_date
                        //     ]);
                        // }    
                        
                        if(!Product::where('item_code', 'like', $row[2])->exists())
                        {
                            $import_data = [
                                'item_code' => $row[2],
                                'category_id' => $category_id,
                                'supplier_id' => $supplier_id,
                                'description' => $row[3],
                                'oum' => $row[4],
                                'opening_qty' => $row[5],
                                'received_qty' => $row[6],
                                'issued_qty' => $row[7],
                                'balance_qty' => $row[8],
                                'rate' => $row[9],
                                'gst' => $row[10],
                                'taxable_amount' => $row[11],
                                'total_amount' => $row[12],
                                'created_at' => $curr_date,
                                'created_by' => $created_by
                            ];                            

                            $item_id = Product::insertGetId($import_data);
                        }
                    }
                }
                if($error==0)
                {
                    Session::flash('success','Data imported successfully');
                }                
            }
            catch (Exception $e) {                
                DB::rollBack();                
            }
            DB::commit();            
        }        
    }
}
