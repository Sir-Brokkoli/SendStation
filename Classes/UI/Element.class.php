<?php namespace Sendstation\UI;

include_once 'IDrawable.php';

class Element implements IDrawable {

    private string $type = "div";
    private array $annotations;

    private array $contents = array();

    public function __construct(string $type = "div", string $class = null, string $id = null) {

        $this->type = $type;

        if (isset($class)) {

            $this->annotations['class'] = $class;
        }

        if (isset($id)) {

            $this->annotations['id'] = $id;
        }
    }

    public function draw() :void {

        $annotationStr = "";

        foreach ($this->annotations as $annotation => $value) {

            $annotationStr .= " {$annotation}=\"{$value}\"";
        }
        
        echo "<{$this->type}{$annotationStr}>";

        foreach ($this->contents as $element) {

            $element->draw();
        }

        echo "</{$this->type}>";
    }

    public function setAnnotation(string $annotation, string $value) :void {

        $this->annotations[$annotation] = $value;
    }

    public function getAnnotation(string $annotation) {

        return $this->annotations[$annotation];
    }

    public function addContent($content) {

        array_push($this->contents, $content);
    }
}