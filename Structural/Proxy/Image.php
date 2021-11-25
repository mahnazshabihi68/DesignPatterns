<?php

interface ImageProxyInterface
{
    public function display();
}

class RealImage implements ImageProxyInterface
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
		$this->loadFromDisk();
    }

    protected function loadFromDisk()
    {
        echo "Loading {$this->filename}\n";
    }

    public function display()
    {
        echo "Display {$this->filename}\n";
    }
}

class ProxyImage implements ImageProxyInterface
{
    protected $id;
    protected $image;
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function display()
    {
        if (null === $this->image) {
            $this->image = new RealImage($this->filename);
        }

        return $this->image->display();
    }
}

$filename = 'test.png';

$image1 = new RealImage($filename);//loading  image and use system resource	

// Call some other methods to attach image to related user. 
echo 'image object attached to user object .';

echo $image1->display();



$image2 = new ProxyImage($filename); 

// Call some other methods to attach image to related user. 

echo 'image object attached to user object .';


echo $image2->display();//loading  image and use system resource	
