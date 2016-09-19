<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 28.07.16
 * Time: 18:54
 */

namespace app\models;


use Mystem\Article;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class WordExtractor extends Model
{
    public $text;

    protected $extractedWords;
    protected $stemm;
    protected $question;

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getExtractedWords()
    {
        return $this->extractedWords;
    }

    /**
     * @param mixed $extractedWords
     */
    public function setExtractedWords($extractedWords)
    {
        $this->extractedWords = $extractedWords;
    }

    /**
     * @return Article
     */
    public function getStemm()
    {
        return $this->stemm;
    }

    /**
     * @param mixed $stemm
     */
    public function setStemm($stemm)
    {
        $this->stemm = $stemm;
    }

    public function rules()
    {
        return [
            ['text', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => "Введите запрос"
        ];
    }


    /**
     * @return $this
     */
    public function extractWords()
    {
        $this->setExtractedWords(\Yii::$app->wordsExtractor->extract($this->text));
        return $this;
    }

    /**
     * @return $this
     */
    public function stemmWords()
    {
        $this->setStemm(new \Mystem\Article(implode(' ', $this->getExtractedWords())));
        return $this;
    }

    public function searchQuestion($id = null)
    {
        if (null !== $id) {
            $this->setQuestion($this->getQuestionConfig($id));
            return true;
        }
        $q = [];
        foreach ($this->getStemm()->words as $keyword) {

            $r = \Yii::$app->search->find($keyword->normalized());
            foreach (ArrayHelper::getValue($r, 'results', []) as $found) {
                if (array_key_exists($found->uid, $q)) {
                    $q[$found->uid]++;
                } else {
                    $q[$found->uid] = 1;
                }
            }
        }
        arsort($q);
        $qId = key($q);
        if ($qId) {
            $this->setQuestion($this->getQuestionConfig($qId));
        }
        return false;
    }

    public function getQuestionConfig($id)
    {
        $config = array_filter(Question::questions(), function ($item) use ($id) {
            return $item['id'] == $id;
        });
        return new Question(current($config));
    }
}