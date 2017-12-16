<?php

namespace App\Helpers;

class Printer
{
    private $printer;
    
    public function __construct($printer = null){
        $this->printer = $printer;
    }
    
    public function printDocument(DocumentInterface $document, int $copies = 1)
    {
        if ($this->printer)
        {
            shell_exec("lp -n {$copies} -o collate=true {$document->path()}");
        }else{
            shell_exec("lp -d {$this->printer} -n {$copies} -o collate=true {$document->path()}");
        }
    }
    
    public function cancel()
    {
        return shell_exec("cancel");
    }
    
    public function showAvailablePrinters()
    {
        return shell_exec("lpstat -p");
    }
    
    public function getPrinterName()
    {
        return $this->printer;
    }
    
    public function setPrinterName($printer)
    {
        $this->printer = $printer;
    }
}
