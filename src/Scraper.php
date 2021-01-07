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
            $this->elements = $this->xpath->query("*/{$element}[@{$identifier[0]}='{$identifier[1]}']");
        }
        $this->elements = $this->xpath->query("*/{$element}");

        return !empty($this->elements) ? $this->elements[0] : false;
    }

    public function find_all(string $element, array $identifier){
        if(!empty($identifier)){
            $this->elements = $this->xpath->query("*/{$element}[@{$identifier[0]}='{$identifier[1]}']");
        }
        $this->elements = $this->xpath->query("*/{$element}");

        return $this->elements;
    }

    public function getText() {
        return strip_tags($this->elements);
    }
}

?>
