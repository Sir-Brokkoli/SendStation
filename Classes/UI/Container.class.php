<?php namespace Sendstation\UI;

include_once 'IDrawable.php';

abstract class Container implements IDrawable{

    protected $headerHTML;
    protected $footerHTML;
    protected $content;

    public function __construct($headerHTML, $footerHTML, $content){
        $this->headerHTML = $headerHTML;
        $this->footerHTML = $footerHTML;
        $this->content = $content;
    }

    public function draw(){
        echo $this->headerHTML;
        $this->content->draw();
        echo $this-footerHTML;
    }

    
}

?>