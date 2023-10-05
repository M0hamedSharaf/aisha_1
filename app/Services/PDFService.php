<?php 

namespace App\Services;

use App\Jobs\ConvertPdfPageIntoImageJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class PDFService
{

    public function uploadPdfFile($fileObject, $fileName , $directoryName = null, $filePrefix = null, $fileSuffix = null)
    {
        $ext = $fileObject->getClientOriginalExtension();
        $filePrefix = $filePrefix ? $filePrefix . "_" : ""; 
        $fileSuffix = $fileSuffix ? "_" . $fileSuffix : "";
        $fileName = $filePrefix . $fileName . $fileSuffix . "." . $ext;

        if($directoryName)
        {
            Storage::disk('public')->putFileAs(
                'files/'. $directoryName . '/',
                $fileObject,
                $fileName
            );
        }
        else
        {
            Storage::disk('public')->putFile('files/' . $fileName, $fileObject);
        }
        return $fileName;
    }

    public function explodePdfToImages($subject)
    {
        $pdf = new Pdf(public_path($subject->book));
        $numberOfPages = $pdf->getNumberOfPages();

        $subject->update([
            'pages_count' => $numberOfPages
        ]);
        
        $path = public_path('files/subjects/' . $subject->name . "/");

        if(!File::exists($path)) 
        {
            File::makeDirectory($path, 0777, true, true);
        }

        $jobs = [];
        for($i = 1; $i <= $numberOfPages; $i++)
        {
            $jobs []= new ConvertPdfPageIntoImageJob($pdf, $i, $subject->name);
        }
        // ConvertPdfPageIntoImageJob::withChain($jobs)->dispatch($pdf, 1, $createdDirectoryName);
        Bus::chain($jobs)->dispatch();
    }

    public function deleteFile($path)
    {
        if($this->isAPdf($path) && file_exists(public_path($path)))
        {
            return unlink(public_path($path));
        }
        return true;
    }

    public function deleteDirectory($directory_name)
    {
        if(File::exists(public_path('files/subjects/' . $directory_name . "/")))
        {
            File::deleteDirectory(public_path('files/subjects/' . $directory_name . "/"));
        }
    }

    public function isAPdf($path)
    {
        $array = explode('.',$path);
        return array_pop($array) == 'pdf';
    }

}