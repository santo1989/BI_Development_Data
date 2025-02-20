<?php


// namespace App\Imports;

// use App\Models\Buyer;
// use App\Models\Item;
// use App\Models\ItemUmo;
// use App\Models\TilAccessories;
// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
// use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Shared\Date;

// class TilAccessoriesImport implements ToModel, WithStartRow, WithCalculatedFormulas
// {
//     private $mergedCells = [];
//     private $filePath;

//     public function __construct($filePath)
//     {
//         if (!$filePath) {
//             throw new \Exception("No file uploaded");
//         }
//         $this->filePath = $filePath;
//         $spreadsheet = IOFactory::load($this->filePath);
//         $worksheet = $spreadsheet->getActiveSheet();
//         $this->mergedCells = $worksheet->getMergeCells();
//     }

//     public function startRow(): int
//     {
//         return 2; // Start from the 2nd row
//     }

//     public function model(array $row)
//     {
//         static $batchData = [];
//         $cleanedRow = $this->prepareRowData($row);
//         $data = $this->prepareTilAccessoriesData($cleanedRow);

//         $batchData[] = $data;

//         if (count($batchData) >= 1000) {
//             $this->insertBatchData($batchData);
//             $batchData = [];
//         }

//         return null;
//     }

//     private function prepareRowData(array $row)
//     {
//         $spreadsheet = IOFactory::load($this->filePath);
//         $worksheet = $spreadsheet->getActiveSheet();

//         foreach ($this->mergedCells as $mergedRange) {
//             $mergedCells = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::splitRange($mergedRange);
//             $firstCell = $mergedCells[0][0];
//             $value = $worksheet->getCell($firstCell)->getValue();

//             foreach ($mergedCells as $cells) {
//                 foreach ($cells as $cell) {
//                     $colIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($cell[0]) - 1;
//                     $rowIndex = $cell[1] - 1;
//                     if ($rowIndex == $rowIndex) {
//                         $row[$colIndex] = $value;
//                     }
//                 }
//             }
//         }

//         return array_map(function ($value) {
//             return trim(str_replace("\xc2\xa0", ' ', $value));
//         }, array_slice($row, 0, 35));
//     }

//     private function prepareTilAccessoriesData(array $cleanedRow)
//     {
//         $buyerName = strtoupper(strtolower($cleanedRow[8] ?? ''));
//         $buyer = Buyer::firstOrCreate(['name' => $buyerName]);

//         $itemName = strtoupper(strtolower($cleanedRow[14] ?? ''));
//         $item = Item::firstOrCreate(['name' => $itemName]);

//         $uomName = strtoupper(strtolower($cleanedRow[17] ?? ''));
//         $uom = ItemUmo::firstOrCreate(['name' => $uomName]);

//         $convertDate = function ($dateValue) {
//             if (empty($dateValue)) return null;
//             if (is_numeric($dateValue)) {
//                 return \Carbon\Carbon::instance(Date::excelToDateTimeObject($dateValue))->format('Y-m-d');
//             }
//             try {
//                 return \Carbon\Carbon::parse($dateValue)->format('Y-m-d');
//             } catch (\Exception $e) {
//                 return null;
//             }
//         };

       

// // dd($cleanedRow);


       

//         return [
//             'WO_No' => $cleanedRow[1],
//             'Approved_Date' => $convertDate($cleanedRow[2]),
//             'Internal_Ref_No' => $cleanedRow[3],
//             'WO_Date' => $convertDate($cleanedRow[4]),
//             'Delivery_Date' => $convertDate($cleanedRow[5]),
//             'WO_Type' => $cleanedRow[7],
//             'Supplier' => $cleanedRow[8],
//             'Buyer' => $buyerName,
//             'buyer_id' => $buyer->id,
//             'Job_Year' => $cleanedRow[10],
//             'Job_No' => $cleanedRow[11],
//             'Style_Ref' => $cleanedRow[12],
//             'Order_No' => $cleanedRow[13],
//             'Order_qty' => $cleanedRow[14],
//             'Item_Name' => $itemName,
//             'item_id' => $item->id,
//             'Description' => $cleanedRow[16],
//             'UOM' => $uomName,
//             'WO_Qty' => (int)$cleanedRow[19],
//             'WO_Unit_price' => (float)$cleanedRow[20],
//             'WO_value' => (float)$cleanedRow[21],
//             'Budget_Unit_price' => (float)$cleanedRow[22],
//             'Precost_value' => (float)$cleanedRow[23],
//             'Deference' => (float)$cleanedRow[24],
//             'Deference_percent' => (float)$cleanedRow[25],
//             'On_Time_Receive' => (int)$cleanedRow[26],
//             'OTD_percent' => (int)$cleanedRow[27],
//             'Total_Receive_Qty' => (int)$cleanedRow[28],
//             'Receive_Value' => (float)$cleanedRow[29],
//             'Receive_Balance' => (float)$cleanedRow[30],
//             'Dealing_Merchant' => $cleanedRow[31],
//             'Team_Leader' => $cleanedRow[32],
//             'User_Name' => $cleanedRow[33],
//             'Remarks' => $cleanedRow[34],
//             'item_umo_id' => $uom->id,
//         ];
//     }

//     private function insertBatchData(array $batchData)
//     {
//         // dd($batchData);
//         DB::beginTransaction();
//         try {
//             //insert data into database using laravel eloquent model one by one
//             // foreach ($batchData as $data) {
//             //    $tilAccessories = new TilAccessories();
//             //     $tilAccessories->WO_No = $data['WO_No'];
//             //     $tilAccessories->Approved_Date = $data['Approved_Date'];
//             //     $tilAccessories->Internal_Ref_No = $data['Internal_Ref_No'];
//             //     $tilAccessories->WO_Date = $data['WO_Date'];
//             //     $tilAccessories->Delivery_Date = $data['Delivery_Date'];
//             //     $tilAccessories->WO_Type = $data['WO_Type'];
//             //     $tilAccessories->Supplier = $data['Supplier'];
//             //     $tilAccessories->Buyer = $data['Buyer'];
//             //     $tilAccessories->Job_Year = $data['Job_Year'];
//             //     $tilAccessories->Job_No = $data['Job_No'];
//             //     $tilAccessories->Style_Ref = $data['Style_Ref'];
//             //     $tilAccessories->Order_No = $data['Order_No'];
//             //     $tilAccessories->Order_qty = $data['Order_qty'];
//             //     $tilAccessories->Item_Name = $data['Item_Name'];
//             //     $tilAccessories->Description = $data['Description'];
//             //     $tilAccessories->UOM = $data['UOM'];
//             //     $tilAccessories->WO_Qty = $data['WO_Qty'];
//             //     $tilAccessories->WO_Unit_price = $data['WO_Unit_price'];
//             //     $tilAccessories->WO_value = $data['WO_value'];
//             //     $tilAccessories->Budget_Unit_price = $data['Budget_Unit_price'];
//             //     $tilAccessories->Precost_value = $data['Precost_value'];
//             //     $tilAccessories->Deference = $data['Deference'];
//             //     $tilAccessories->Deference_percent = $data['Deference_percent'];
//             //     $tilAccessories->On_Time_Receive = $data['On_Time_Receive'];
//             //     $tilAccessories->OTD_percent = $data['OTD_percent'];
//             //     $tilAccessories->Total_Receive_Qty = $data['Total_Receive_Qty'];
//             //     $tilAccessories->Receive_Value = $data['Receive_Value'];
//             //     $tilAccessories->Receive_Balance = $data['Receive_Balance'];
//             //     $tilAccessories->Dealing_Merchant = $data['Dealing_Merchant'];
//             //     $tilAccessories->Team_Leader = $data['Team_Leader'];
//             //     $tilAccessories->buyer_id = $data['buyer_id'];
//             //     $tilAccessories->User_Name = $data['User_Name'];
//             //     $tilAccessories->item_id = $data['item_id'];
//             //     $tilAccessories->Remarks = $data['Remarks'];
//             //     $tilAccessories->item_umo_id = $data['item_umo_id'];
//             //     $tilAccessories->save();

//             // }
//             TilAccessories::insert($batchData);

//             DB::commit();




//         } catch (\Exception $e) {
//             DB::rollBack();
//             \Log::error('Batch insert failed: ' . $e->getMessage());
//         }
//     }
// }

 

namespace App\Imports;

use App\Models\Buyer;
use App\Models\Item;
use App\Models\ItemUmo;
use App\Models\TilAccessories;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class TilAccessoriesImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    private $mergedValues = [];
    private $filePath;
    private $currentRowIndex = 1;

    public function __construct($filePath)
    {
        if (!$filePath) {
            throw new \Exception("No file uploaded");
        }
        $this->filePath = $filePath;
        $this->preprocessMergedCells();
    }

    public function startRow(): int
    {
        return 2; // Start from the 2nd row
    }

    public function model(array $row)
    {
        static $batchData = [];
        $cleanedRow = $this->prepareRowData($row, $this->currentRowIndex);
        $data = $this->prepareTilAccessoriesData($cleanedRow);

        $batchData[] = $data;

        // Insert in batches of 100 rows
        if (count($batchData) >= 100) {
            $this->insertBatchData($batchData);
            $batchData = [];
        }

        // $this->insertBatchData($batchData);

        $this->currentRowIndex++;
        return null;
    }

    private function preprocessMergedCells()
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $mergedCells = $worksheet->getMergeCells();

        foreach ($mergedCells as $mergedRange) {
            $mergedCells = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::splitRange($mergedRange);
            $firstCell = $mergedCells[0][0];
            $value = $worksheet->getCell($firstCell)->getValue();

            $rangeCells = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange);
            foreach ($rangeCells as $cell) {
                [$col, $row] = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::indexesFromString($cell);
                $this->mergedValues[$row][$col] = $value;
            }
        }
    }

    private function prepareRowData(array $row, $rowIndex)
    {
        // Apply merged values for the current row
        if (isset($this->mergedValues[$rowIndex + 1])) { // +1 because Excel rows are 1-based
            foreach ($this->mergedValues[$rowIndex + 1] as $col => $value) {
                $row[$col - 1] = $value; // Convert to 0-based index
            }
        }

        return array_map(function ($value) {
            return trim(str_replace("\xc2\xa0", ' ', $value));
        }, array_slice($row, 0, 35));
    }

    private function prepareTilAccessoriesData(array $cleanedRow)
    {
        $buyerName = strtoupper(strtolower($cleanedRow[8] ?? ''));
        $buyer = Buyer::firstOrCreate(['name' => $buyerName]);

        $itemName = strtoupper(strtolower($cleanedRow[15] ?? ''));
        $item = Item::firstOrCreate(['name' => $itemName]);

        $uomName = strtoupper(strtolower($cleanedRow[18] ?? ''));
        $uom = ItemUmo::firstOrCreate(['name' => $uomName]);

        $convertDate = function ($dateValue) {
            if (empty($dateValue)) return null;
            if (is_numeric($dateValue)) {
                return Carbon::instance(Date::excelToDateTimeObject($dateValue))->format('Y-m-d');
            }
            try {
                return Carbon::parse($dateValue)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        };

        return [
            'WO_No' => $cleanedRow[1],
            'Approved_Date' => $convertDate($cleanedRow[2]),
            'Internal_Ref_No' => $cleanedRow[3],
            'WO_Date' => $convertDate($cleanedRow[4]),
            'Delivery_Date' => $convertDate($cleanedRow[5]),
            'WO_Type' => $cleanedRow[7],
            'Supplier' => $cleanedRow[8],
            'Buyer' => $buyerName,
            'buyer_id' => $buyer->id,
            'Job_Year' => $cleanedRow[10],
            'Job_No' => $cleanedRow[11],
            'Style_Ref' => $cleanedRow[12],
            'Order_No' => $cleanedRow[13],
            'Order_qty' => $cleanedRow[14],
            'Item_Name' => $itemName,
            'item_id' => $item->id,
            'Description' => $cleanedRow[16],
            'UOM' => $uomName,
            'WO_Qty' => (int)$cleanedRow[19],
            // 'WO_Unit_price' => (float)$cleanedRow[20],
            // 'WO_value' => (float)$cleanedRow[21],
            // 'Budget_Unit_price' => (float)$cleanedRow[22],
            // 'Precost_value' => (float)$cleanedRow[23],
            // 'Deference' => (float)$cleanedRow[24],
            // 'Deference_percent' => (float)$cleanedRow[25],

            // all float values after decimal point taken 4 digits

            'WO_Unit_price' => number_format((float)$cleanedRow[20], 4, '.', ''),
            'WO_value' => number_format((float)$cleanedRow[21], 4, '.', ''),
            'Budget_Unit_price' => number_format((float)$cleanedRow[22], 4, '.', ''),
            'Precost_value' => number_format((float)$cleanedRow[23], 4, '.', ''),
            'Deference' => number_format((float)$cleanedRow[24], 4, '.', ''),
            'Deference_percent' => number_format((float)$cleanedRow[25], 4, '.', ''),
            'On_Time_Receive' => (int)$cleanedRow[26],
            'OTD_percent' => (int)$cleanedRow[27],
            'Total_Receive_Qty' => (int)$cleanedRow[28],
            // 'Receive_Value' => (float)$cleanedRow[29],
            // 'Receive_Balance' => (float)$cleanedRow[30],
            'Receive_Value' => number_format((float)$cleanedRow[29], 4, '.', ''),
            'Receive_Balance' => number_format((float)$cleanedRow[30], 4, '.', ''),
            'Dealing_Merchant' => $cleanedRow[31],
            'Team_Leader' => $cleanedRow[32],
            'User_Name' => $cleanedRow[33],
            'Remarks' => $cleanedRow[34],
            'item_umo_id' => $uom->id,
        ];
    }

    // private function insertBatchData(array $batchData)
    // {
    //     DB::beginTransaction();
    //     try {





    //         // Split the batch data into smaller chunks
    //         $chunks = array_chunk($batchData, 50); // Adjust chunk size based on columns

    //         // foreach ($chunks as $chunk) {
    //         //     // TilAccessories::insert($chunk);
    //         // }
    //         foreach ($chunks as $chunk) {
    //             foreach ($chunk as $data) {
    //                 // dd($data);
    //                 $tilAccessories = new TilAccessories();
    //                 $tilAccessories->WO_No = $data['WO_No'];
    //                 $tilAccessories->Approved_Date = $data['Approved_Date'];
    //                 $tilAccessories->Internal_Ref_No = $data['Internal_Ref_No'];
    //                 $tilAccessories->WO_Date = $data['WO_Date'];
    //                 $tilAccessories->Delivery_Date = $data['Delivery_Date'];
    //                 $tilAccessories->WO_Type = $data['WO_Type'];
    //                 $tilAccessories->Supplier = $data['Supplier'];
    //                 $tilAccessories->Buyer = $data['Buyer'];
    //                 $tilAccessories->Job_Year = $data['Job_Year'];
    //                 $tilAccessories->Job_No = $data['Job_No'];
    //                 $tilAccessories->Style_Ref = $data['Style_Ref'];
    //                 $tilAccessories->Order_No = $data['Order_No'];
    //                 $tilAccessories->Order_qty = $data['Order_qty'];
    //                 $tilAccessories->Item_Name = $data['Item_Name'];
    //                 $tilAccessories->Description = $data['Description'];
    //                 $tilAccessories->UOM = $data['UOM'];
    //                 $tilAccessories->WO_Qty = $data['WO_Qty'];
    //                 $tilAccessories->WO_Unit_price = $data['WO_Unit_price'];
    //                 $tilAccessories->WO_value = $data['WO_value'];
    //                 $tilAccessories->Budget_Unit_price = $data['Budget_Unit_price'];
    //                 $tilAccessories->Precost_value = $data['Precost_value'];
    //                 $tilAccessories->Deference = $data['Deference'];
    //                 $tilAccessories->Deference_percent = $data['Deference_percent'];
    //                 $tilAccessories->On_Time_Receive = $data['On_Time_Receive'];
    //                 $tilAccessories->OTD_percent = $data['OTD_percent'];
    //                 $tilAccessories->Total_Receive_Qty = $data['Total_Receive_Qty'];
    //                 $tilAccessories->Receive_Value = $data['Receive_Value'];
    //                 $tilAccessories->Receive_Balance = $data['Receive_Balance'];
    //                 $tilAccessories->Dealing_Merchant = $data['Dealing_Merchant'];
    //                 $tilAccessories->Team_Leader = $data['Team_Leader'];
    //                 $tilAccessories->buyer_id = $data['buyer_id'];
    //                 $tilAccessories->User_Name = $data['User_Name'];
    //                 $tilAccessories->item_id = $data['item_id'];
    //                 $tilAccessories->Remarks = $data['Remarks'];
    //                 $tilAccessories->item_umo_id = $data['item_umo_id'];
    //                 $tilAccessories->save();

    //             }
    //         }

    //         DB::commit();
    //         //send a response to the user after the batch has been inserted 

    //         $count = count($batchData);
    //         session('Dabase_inserted', $count . ' rows inserted successfully');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('Batch insert failed: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }

    private function insertBatchData(array $batchData)
    {
        DB::beginTransaction();
        try {

            $batchDatas = array_chunk($batchData, 50); // Adjust chunk size based on columns

            foreach ($batchDatas as $batchData) {

                //

                // Get all existing records according to  WO No	WO Date	Supplier	Buyer	Job Year	Job No.	Style Ref.	Order No	Order qty	Item Name	Description	UOM	WO Qty	WO Unit price	WO value	Budget Unit price	Precost value	Deference	Deference %	On Time Receive	OTD%	Total Receive Qty	Receive Value	Receive Balance
                $existingRecords = TilAccessories::where('WO_No', array_column($batchData, 'WO_No'))->where('WO_Date', array_column($batchData, 'WO_Date'))->where('Supplier', array_column($batchData, 'Supplier'))->where('Buyer', array_column($batchData, 'Buyer'))->where('Job_Year', array_column($batchData, 'Job_Year'))->where('Job_No', array_column($batchData, 'Job_No'))->where('Style_Ref', array_column($batchData, 'Style_Ref'))->where('Order_No', array_column($batchData, 'Order_No'))->where('Order_qty', array_column($batchData, 'Order_qty'))->where('Item_Name', array_column($batchData, 'Item_Name'))->where('Description', array_column($batchData, 'Description'))->where('UOM', array_column($batchData, 'UOM'))->where('WO_Qty', array_column($batchData, 'WO_Qty'))->where('WO_Unit_price', array_column($batchData, 'WO_Unit_price'))->where('WO_value', array_column($batchData, 'WO_value'))->where('Budget_Unit_price', array_column($batchData, 'Budget_Unit_price'))->where('Precost_value', array_column($batchData, 'Precost_value'))->where('Deference', array_column($batchData, 'Deference'))->where('Deference_percent', array_column($batchData, 'Deference_percent'))->where('On_Time_Receive', array_column($batchData, 'On_Time_Receive'))->where('OTD_percent', array_column($batchData, 'OTD_percent'))->where('Total_Receive_Qty', array_column($batchData, 'Total_Receive_Qty'))->where('Receive_Value', array_column($batchData, 'Receive_Value'))->where('Receive_Balance', array_column($batchData, 'Receive_Balance'))->get();

                $newRecords = [];
                foreach ($batchData as $data) {
                    $existing = $existingRecords->where('WO_No', $data['WO_No'])->where('WO_Date', $data['WO_Date'])->where('Supplier', $data['Supplier'])->where('Buyer', $data['Buyer'])->where('Job_Year', $data['Job_Year'])->where('Job_No', $data['Job_No'])->where('Style_Ref', $data['Style_Ref'])->where('Order_No', $data['Order_No'])->where('Order_qty', $data['Order_qty'])->where('Item_Name', $data['Item_Name'])->where('Description', $data['Description'])->where('UOM', $data['UOM'])->where('WO_Qty', $data['WO_Qty'])->where('WO_Unit_price', $data['WO_Unit_price'])->where('WO_value', $data['WO_value'])->where('Budget_Unit_price', $data['Budget_Unit_price'])->where('Precost_value', $data['Precost_value'])->where('Deference', $data['Deference'])->where('Deference_percent', $data['Deference_percent'])->where('On_Time_Receive', $data['On_Time_Receive'])->where('OTD_percent', $data['OTD_percent'])->where('Total_Receive_Qty', $data['Total_Receive_Qty'])->where('Receive_Value', $data['Receive_Value'])->where('Receive_Balance', $data['Receive_Balance'])->first();


                    if ($existing) {
                        // Check for changes before updating
                        $changes = array_diff_assoc($data, $existing->toArray());
                        if (!empty($changes)) {
                            $existing->update($data);
                        }
                    } else {
                        $newRecords[] = $data;
                    }
                }

                // Bulk insert for new records
                if (!empty($newRecords)) {
                    TilAccessories::insert($newRecords);
                }
            }
            DB::commit();

            // Send response after batch insert/update
            session()->flash('Database_Message', count($newRecords) . ' rows inserted, ' . count($batchData) - count($newRecords) . ' rows updated');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Batch insert/update failed: ' . $e->getMessage());
            throw $e;
        }
    }

}
