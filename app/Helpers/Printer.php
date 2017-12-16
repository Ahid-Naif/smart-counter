<?php

namespace App\Helpers;

class Printer
{
    /**
     * The printer name.
     *
     * @var null
     */
    private $printer;
    
    /**
     * Printer constructor.
     * @param null $printer
     */
    public function __construct($printer = null){
        $this->printer = $printer;
    }
    
    /**
     * Print the needed doc using the DocumentInterface.
     *
     * @param DocumentInterface $document
     * @param int $copies
     */
    public function printDocument(DocumentInterface $document, int $copies = 1)
    {
        if ($this->printer)
        {
            shell_exec("lp -n {$copies} -o collate=true {$document->path()}");
        }else{
            shell_exec("lp -d {$this->printer} -n {$copies} -o collate=true {$document->path()}");
        }
    }
    
    /**
     * Continent method to cancel printing process.
     *
     * @return string
     */
    public function cancel()
    {
        return shell_exec("cancel");
    }
    
    /**
     * Grab all available printers that connected to the device.
     *
     * @return string
     */
    public function showAvailablePrinters()
    {
        return shell_exec("lpstat -p");
    }
    
    /**
     * Return the printer name.
     *
     * @return null
     */
    public function getPrinter()
    {
        return $this->printer;
    }
    
    /**
     * Set the printer name to be used for later printing requests.
     *
     * @param $printer
     */
    public function setPrinter($printer)
    {
        $this->printer = $printer;
    }
}
