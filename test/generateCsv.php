<?php
    //lets generate a csv with 1000 lines
    require_once __DIR__.'/../src/csvGen.php';
    use challenge1\csvGen;
    
    //the path is current directory added with csvs folder and the file name test1.csv, with a 1000 lines of fake products
    $gen = new csvGen(__DIR__.'/csvs/test1.csv', 1000);
    $gen->generateAndSave();
?>