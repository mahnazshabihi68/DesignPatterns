<?php

interface OfficeInternetAccess {  
    public function grantInternetAccess();  
}  

class RealInternetAccess implements OfficeInternetAccess {  
    private $employeeName;  
    public function RealInternetAccess($empName) {  
        $this->employeeName = $empName;  
    }  

    public function grantInternetAccess() {  
        return "Internet Access granted for employee: " . $this->employeeName;  
    }  
}  

class ProxyInternetAccess implements OfficeInternetAccess {  
    public $employeeName;  
    public function ProxyInternetAccess($employeeName) {  
        $this->employeeName = $employeeName;  
    }

    public function grantInternetAccess()   {  
        if ($this->getRole($this->employeeName) > 2)   {
            $realaccess = new RealInternetAccess($this->employeeName);  
            return $realaccess->grantInternetAccess();  
        } else {  
            return "No Internet access granted.";  
        }  
    }  

    public function getRole($emplName) {  
            // Check role from the database based on Name and designation
           // return job level or job designation.
            return 3;  
    }  
}  

$access = new ProxyInternetAccess("Ghodsian");  
echo $access->grantInternetAccess();  