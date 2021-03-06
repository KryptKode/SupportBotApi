<?php

class Article extends Action
{
    protected $_table = "articles";

    public function incrementHelpedCount($id)
    {
        $article = $this->get(array('id', '=', $id));
        if (count($article) > 0) {
            $article = $article[0];
            $helped_count = $article->helped_count;
            $article->helped_count = $helped_count + 1;
            $this->update($article->id, (array)$article);
            return true;
        }
        return false;
    }

    public function incrementNotHelpedCount($id)
    {
        $article = $this->get(array('id', '=', $id));
        if (count($article) > 0) {
            $article = $article[0];
            $not_helped_count = $article->not_helped_count;
            $article->not_helped_count = $not_helped_count + 1;
            $this->update($article->id, (array)$article);
            return true;
        }
        return false;
    }

    public function getArticles($keywords)
    {
        $where = array();
        foreach ($keywords as $key){
            array_push($where, 'keywords', 'LIKE', "%{$key}%");
        }
        $articles = $this->getOR($where);
        return $articles;
    }

    public function getAllKeyWords()
    {
        $allKeywords = $this->get(array('1', '=', '1'), 'keywords');
        $words = array();
        foreach ($allKeywords as $key => $value) {
            $keywords = $value->keywords;
            $separated = explode(",", $keywords);
            foreach ($separated as $k => $v) {
                array_push($words, $v);
            }
        }
        return array_map("unserialize", array_unique(array_map("serialize", $words)));
    }


}