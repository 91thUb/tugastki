<?php
class TKICosine 
{
    public function getDPowerQ($terms, $documentId)
    {
        $arrKeywordTemp = $this->splitTerms($terms);
        
        $N = Document::getN();
        $tfIdf = new TKIWeightingTfIdf();
        $tfIdf->setN($N);
        
        $result = 0;
        
        foreach($arrKeywordTemp as $key => $val)
        {
            $df = 0;
            
            $df = Document::getDf($key);
            
            if($df == 0) continue;
            
            $tfIdf->setDf($df);
            $tfIdf->setTf($val);
            
            $result += $tfIdf->getWeight() * Term::getTermWeightTfIdfByTermAndByDocumentId($key, $documentId);
        }
        
        return $result;
    }
    
    public function getVectorTfIdfLengthQuery($terms)
    {
        $arrKeywordTemp = $this->splitTerms($terms);
        
        $N = Document::getN();
        $tfIdf = new TKIWeightingTfIdf();
        $tfIdf->setN($N);
        
        $result = 0;
        
        foreach($arrKeywordTemp as $key => $val)
        {
            $df = 0;
            
            $df = Document::getDf($key);
            
            if($df == 0) continue;
                
            $tfIdf->setDf($df);
            $tfIdf->setTf($val);
            
            $result += $tfIdf->getWeight() * $tfIdf->getWeight();
        }
        
        return sqrt($result);
    }
    
    private function splitTerms($terms)
    {
        $terms = preg_split("/\s+/", $terms);
        $arrKeywordTemp = array();
        
        foreach($terms as $key)
        {
            if(isset($arrKeywordTemp["$key"]))
            {
                $arrKeywordTemp["$key"]++;
            }
            else
            {
                $arrKeywordTemp["$key"] = 1;
            }
        }
        
        return $arrKeywordTemp;
    }
    
    public function getVectorTfIdfLengthDocumentById($documentId)
    {
        return $this->getVectorLengthDocumentById($documentId, 2);
    }
    
    private function getVectorLengthDocumentById($documentId, $type)
    {
        $criteria = new CDbCriteria();
		$criteria->select = 't.*';
		$criteria->condition = 't.id_document =:documentId AND t.id_document_freq_type =:type';
		$criteria->params = array(':documentId' => $documentId, ':type' => $type);
        
        $docFreqs = DocumentFreq::model()->findAll($criteria);
        
        $result = 0;
        
        foreach($docFreqs as $docFreqs)
        {
            $result += $docFreqs->weight * $docFreqs->weight;
        }
        
        return sqrt($result);
    }
}

?>
