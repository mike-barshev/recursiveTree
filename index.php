<?php

//рекурсивный вывод массива в виде дерева
function printTree($array, $tab = '', $result = '')
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result .= "{$tab}[$key] <i style='color:#ff0000;'>(array)</i><br>";
            $result .= printTree($value, $tab . str_repeat('&nbsp;', 4));
        } else {
            $result .= "{$tab}[$key] => <b>$value</b><br>";
        }
    }
    return $result;
}

//рекурсивное удаление одинаковых элементов
function delSameElements(array &$array, array &$uniqueFilesArr = [])
{
    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            delSameElements($value, $uniqueFilesArr);
        } else {
                if (in_array($value, $uniqueFilesArr)) {
                    unset($array[$key]);
                } else {
                    array_push($uniqueFilesArr, $value);
                }
        }

    }
}

// массив, с которым будем работать
$diskC = array (
    "folder1" => array(
        "subfolder11" => array(
            "txt_file" => "report.txt",
            "pdf_file" => "essay.pdf"
        ),
        "subfolder12" => array(
            "jpg_file" => "picture.jpg",
            "gif_file" => "animation.gif"
        ),
    ),
    "folder2" => array(
        "subfolder21" => array(
            "txt_file" => "report.txt",
            "pdf_file" => "article.pdf"
        ),
        "subfolder22" => array(
            "txt_file" => "sketch.txt",
            "pdf_file" => "essay.pdf"
        )
    )
);

// main
echo "<h2>Искомый массив:</h2>", printTree($diskC);
delSameElements($diskC);
echo "<h2>Массив после обработки функцией:</h2>", printTree($diskC);