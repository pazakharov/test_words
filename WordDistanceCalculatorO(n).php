<?php

/**
 * Класс решает задачу поиска расстояний между словами в тексте, где единица расстояния слово. 
 */
class WordDistanceCalculator
{
    public $text;
    public $word1;
    public $word2;
    public $maxKeyWord1;
    public $minKeyWord1;
    public $maxKeyWord2;
    public $minKeyWord2;
    public $wordsArray;
    public $arrayKeysWord1;
    public $arrayKeysWord2;
    public $minDistance;
    public $maxDistance;

    /**
     * @param mixed $text  Исходный текст для поска расстояний слов
     * @param mixed $word1 Первое слово для поиска
     * @param mixed $word2 Второе слово для поиска
     */
    function __construct($text, $word1, $word2)
    {
        $this->word1 = $word1;
        $this->word2 = $word2;
        $this->textNormolize($text);
        $this->calculate();
    }

    /**
     * Функция оставляет в обрабатываемом тексте только слова
     * @return void
     */
    private function textNormolize($text)
    {
        $text = str_replace(PHP_EOL, ' ', $text); //конец строки ненужен
        $this->text = preg_replace('/|[\s]+|s/u', ' ', $text); //сдвоенные пробелы не нужны
        $this->text = preg_replace('/[^a-zа-яA-ZА-ЯёЁ0-9 ]/u', '', $text); //оставляем буквы, цифры и пробелы
    }

    /**
     * Основная функция просчета, заполняет искомые приватные переменные. 
     * Для поиска расстояния между словами вычисляется разница расстояний от базы (начала) 
     * @return void
     */
    private function calculate()
    {
        $this->wordsArray = explode(' ', $this->text);
        $this->arrayKeysWord1 = array_keys($this->wordsArray, $this->word1);
        $this->arrayKeysWord2 = array_keys($this->wordsArray, $this->word2);

        $this->minDistance = count($this->wordsArray);
        $prevWord = [];
        foreach ($this->wordsArray as $key => $value) {
            if (($value == $this->word1) || ($value == $this->word2)) {
                if (count($prevWord) > 0) {
                    if ($prevWord['value'] <> $value) {
                        if (($key - $prevWord['key']) < $this->minDistance) {
                            $this->minDistance = ($key - $prevWord['key'])-1;
                        }
                    } else {
                        $prevWord = ['key' => $key, 'value' => $value];
                    }
                } else {
                    $prevWord = ['key' => $key, 'value' => $value];
                }
            }
        }

        $this->maxKeyWord1 = max($this->arrayKeysWord1);
        $this->minKeyWord1 = min($this->arrayKeysWord1);
        $this->maxKeyWord2 = max($this->arrayKeysWord2);
        $this->minKeyWord2 = min($this->arrayKeysWord2);

        if (abs($this->maxKeyWord1 - $this->minKeyWord2) > abs($this->maxKeyWord2 - $this->minKeyWord1)) {
            $this->maxDistance = abs($this->maxKeyWord1 - $this->minKeyWord2) - 1;
        } else {
            $this->maxDistance = abs($this->maxKeyWord2 - $this->minKeyWord1) - 1;
        }
    }
}

if (isset($argv[1]) && isset($argv[2])) {
    $calculator = new WordDistanceCalculator(file_get_contents('./input.txt'), $argv[1], $argv[2]);
    if ((count($calculator->arrayKeysWord1) == 0) || (count($calculator->arrayKeysWord2) == 0)) {
        echo PHP_EOL . 'Слова в тексте не найдены проверьте существование слов: "' . $calculator->word1 . '" и "' . $calculator->word2 . '" ';
    } else {
        echo PHP_EOL . 'Минимальное расстояние между словами "' . $calculator->word1 . '" и "' . $calculator->word2 . '" ' . $calculator->minDistance;
        echo PHP_EOL . 'Максимальное расстояние между словами "' . $calculator->word1 . '" и "' . $calculator->word2 . '" ' . $calculator->maxDistance;
    }
} else {
    echo 'Не заданы слова во входящих параметрах, задайте слова пример: php .\WordDistanceCalculator.php word1 word2';
}
