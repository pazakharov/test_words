### Тестовое задание на должность PHP-разработчик
#### Задание: 
```
 Given a text file with words, find the shortest and maximum distance between two given words. Distance is the number of words between these 2 given words. Please provide an estimate of the complexity of your algorithm O(n).
```

#### Сложность приведенного алгоритма
```
O(N)*4+O(N^2) = O(N^2)
```
#### Алгоритм

- Программа перед подсчетом удаляет лишние символы и пробелы в тексте для приведения текста к условиям задачи.
- Вычисляется расстояние от базы до искомого слова
- Вычисляется разница расстояний от базы для двух заданных слов, анализируется результат. 

#### Программа работает в консольном режиме 
```
input.txt - содержит анализируемый код. 
```
#### Запуск программы
```
php .\WordDistanceCalculator.php word1 word2
```