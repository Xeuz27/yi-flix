<?php 

class searchResultsProvider{

    private $con, $username;

    public function __construct($con,$username){
        $this->con = $con;
        $this->username = $username;

    }

    public function getResults ($inputText) {
        $entities = EntityProvider::getSearchResults($this->con, $inputText);
        $html = "<div class='previewCategories noScroll'></div>";

        $html .= $this->getResultsHtml($entities);

        return $html .= "</div>";
    }
    private function getResultsHtml($entities){
        if(sizeof($entities) == 0 ){
            return ;
        }
        $entitiesHtml = "";
        $previewProvider = new PreviewProvider($this->con, $this->username);

        foreach($entities as $entity){
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
        }
        return "<div class='category'>
                    <div    class='entities'>
                        $entitiesHtml
                    </div>
                </div>";
                
    }

}


?>