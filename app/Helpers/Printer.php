<?php

namespace App\Helpers;

class Printer
{
    /**
     * Print the needed doc using the DocumentInterface.
     *
     * @param DocumentInterface $document
     * @param $copies
     */
    public function print(DocumentInterface $document, $copies = 1)
    {
        shell_exec("lp -n {$copies} -o collate=true {$document->path()}");
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
}
