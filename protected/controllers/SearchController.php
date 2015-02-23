<?php

class SearchController extends Controller
{
	public $moduleName = 'Search';
    public $layout = '//layouts/search';
	
	public function actionIndex()
	{
        if(isset($_POST['q']) && strlen($_POST['q']) > 0)
        {
            $keyword = $_POST['q'];
            
            $debug = strpos($keyword, "--debug")? true : false;
            
            if($debug)
            {
                $keyword = trim(preg_replace("/--debug/", "", $keyword));
            }

            $results = $this->search($keyword);
            
            // hilangkan yang 0
            foreach ($results as $key => $value)
            {
                if($value == 0)
                {
                    unset($results[$key]);
                }
            }
            
    //            
    //            print_r($results);
    //            die();
    //            
            $error =  "-";
            $warning =  "-";
            $status =  "-";
            $total = "-";
            $total_found =  "-";
            $time = "-";
            $words =  "-";
            $matches =  "-";
            
            
            $result = array();
            if(count($results) > 0)
            {
                $ids = $this->extractIds($results);
                
                $result = $this->getDocumentsByIds($ids);
            }
            
            $this->render('index', array(
                'error' => $error, 
                'warning' => $warning,
                'status' => $status,
                'total' => $total,
                'total_found' => $total_found,
                'time' => $time,
                'words' => $words,
                'result' => $result,
                'query' => $keyword,
                'debug' => $debug,
                'matches' => $matches,
                'weight' => $results,
                )
            );
        }
        else
        {
            $this->render('index');
        }
	}
    
    private function extractIds($results)
    {
        if(!(count($results) > 0)) return false;
        
        $result = array();
        
        foreach($results as $id => $val)
        {
            $result[] = $id;
        }
        
        return $result;
    }
    
    private function getDocumentsByIds($arrIds)
    {
        if(!(count($arrIds) > 0)) return false;
        
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $arrIds);
        
        $documents = Document::model()->findAll($criteria);
        
        $arrResult = array();
        
        foreach($arrIds as $id)
        {
            foreach ($documents as $doc) 
            {
                if($id == $doc->id)
                {
                    $result = array();
                    $result['id'] = (string) $doc->id;
                    $result['title'] = (string)  $doc->title;
                    $result['author'] = (string) $doc->author;
                    $result['content'] = (string) $this->truncate($doc->content, 170);
                    $result['url'] = (string) $doc->url;

                    $arrResult[] = $result;
                }
            }
        }
        
        return $arrResult;
    }
    
    //truncate a string only at a whitespace (by nogdog)
    private function truncate($text, $length) 
    {
        $length = abs((int)$length);
        
        if(strlen($text) > $length) 
        {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        
        return($text);
    }
    
    private function search($terms)
    {
        $documents = Document::model()->findAll();
        $N = count($documents);
        
        $cosine = new TKICosine();
        $vektorQ = $cosine->getVectorTfIdfLengthQuery($terms);
        
        $result = array();
        
        foreach($documents as $doc)
        {
            $cosineResult = 0;
            
            $vektorD = $cosine->getVectorTfIdfLengthDocumentById($doc->id);
            $dPowerQ = $cosine->getDPowerQ($terms, $doc->id);
            
            $cosineResult = $dPowerQ/($vektorD+$vektorQ);
            
            $result["$doc->id"] = $cosineResult;
        }
        
        arsort($result);
       
        return $result;
    }
}