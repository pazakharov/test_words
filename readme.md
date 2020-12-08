### Тестовое задание на должность PHP-разработчик
#### Задание: 
```
 Given a text file with words, find the shortest and maximum distance between two given words. Distance is the number of words between these 2 given words. Please provide an estimate of the complexity of your algorithm O(n).
```

#### Сложность приведенного алгоритма
```
O(N)
```
 
#### Алгоритм

- Программа перед подсчетом удаляет лишние символы и пробелы в тексте для приведения текста к условиям задачи.
- Для минимума и максимума разные алгоритмы поиска значения
- Максимум находится как большее число между крайними случаями встречи заданных слов
- Минимум как миинимальное расстояние между соседними словами из заданных 

#### Программа работает в консольном режиме 
```
input.txt - содержит анализируемый текст. 
```
#### Запуск программы
```
php .\WordDistanceCalculator.php word1 word2
```
