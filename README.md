# csvchallenge

I'm trying to improve my PHP portfolio so i asked for chatgpt some challenge to do in PHP to do so.

Here's the challenge:

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Great! Here's a PHP challenge that you can use to impress tech recruiters:
Write a script that takes in a CSV file containing a list of products with their respective prices and discounts, and outputs the total amount after applying the discounts.
Here are the requirements:

1. The CSV file should have the following format: product_name, price, discount_percentage.
2. The script should read the CSV file and calculate the total amount after applying the discounts.
3. The output should display the total amount, the total discount, and the net amount (total amount minus total discount).
4. The script should be written in PHP and should be able to handle large CSV files.
5. You can use any PHP libraries or frameworks you like, but you should be able to explain your choices.
6. Bonus points if you write tests for your code.

Here are some tips to help you get started:

1. Use the fgetcsv function to read the CSV file.
2. Create a function that takes in the product price and discount percentage and calculates the discounted price.
3. Use a loop to iterate through the CSV file and calculate the total amount and total discount.
4. Use the number_format function to format the output.

Good luck!

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

I decided to improve this challenge creating a system that generates this files using Faker and improve the difficult putting purchase_price to calculate product's profit margin.

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

I will explain how to use here:

## Generate is quitly simple
### Saving directly to a file
```
<?php
    //lets generate a csv with 1000 lines
    require_once __DIR__.'/../src/csvGen.php';
    use challenge1\csvGen;
    
    //the path is current directory added with csvs folder and the file name test1.csv, with a 1000 lines of fake products
    $gen = new csvGen(__DIR__.'/csvs/test1.csv', 1000);
    $gen->generateAndSave();
?>
```

### Returning as string
```
<?php
    //lets generate a csv with 1000 lines
    require_once __DIR__.'/../src/csvGen.php';
    use challenge1\csvGen;
    
    //the path is current directory added with csvs folder and the file name test1.csv, with a 1000 lines of fake products
    $gen = new csvGen(__DIR__.'/csvs/test1.csv', 1000);
    $str = $gen->generate();
?>
```

## Read the file

You can see in the test/readCsv.php the example.
[Test file](https://github.com/andmarruda/csvchallenge/blob/main/test/readCsv.php)
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
