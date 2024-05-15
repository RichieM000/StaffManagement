<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportExcel()
    {
        // Logic to export table to Excel
        // You can use PHPExcel or other PHP libraries for server-side Excel generation

        // For demonstration, you can simply return a CSV file
        $filename = 'export.csv';
        $csvContent = "No.,Firstname,Lastname,Gender,Age,Address,Email,Phone,Position,Kagawad Committee,Work Schedule\n";

        // Iterate through your data and append to CSV content
        foreach ($data as $row) {
            $csvContent .= "{$row->id},{$row->fname},{$row->lname},{$row->gender},{$row->age},{$row->address},{$row->email},{$row->phone},{$row->jobrole},{$row->kagawad_committee_on},{$row->workSchedule}\n";
        }

        // Set appropriate headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        // Output CSV content and exit
        echo $csvContent;
        exit();
    }
}
