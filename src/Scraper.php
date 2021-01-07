<?php 
namespace EarlSabalo\PHPScraper;

class PHPScraper {
    public $elements;

    function __construct(string $html_page){
        $this->html_page = $html_page;
        $this->scraper = new DOMDocument();
        $this->scraper->loadHTML($this->html_page);
        $this->xpath = new DOMXPath($this->scraper);
    }
    public function find(string $element, array $identifier){
        if(!empty($identifier)){
            $this->elements = $this->xpath->query("*/{$element}[@{$identifier[0]}='{$identifier[1]}']")->item(0);
        }
        $this->elements = $this->xpath->query("*/{$element}")->item(0);

        return !empty($this->elements) ? $this->elements : false;
    }

    public function find_all(string $element, array $identifier){
        if(!empty($identifier)){
            $this->elements = $this->xpath->query("*/{$element}[@{$identifier[0]}='{$identifier[1]}']");
        }
        $this->elements = $this->xpath->query("*/{$element}");

        return $this->elements;
    }

    public function text() {
        return strip_tags($this->elements);
    }

    public function title() {
        $this->elements = $this->xpath->query("/html/head/title");
        return $this->elements;
    }
    
    public function get($attribute) {
        return !empty($this->elements->getAttribute($attribute)) ? $this->elements->getAttribute($attribute) : false;
    }
}

?>
