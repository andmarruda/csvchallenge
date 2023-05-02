<?php
    /**
     * Generates the CSV file to the challenge to read and calculates it
     * @author Anderson Arruda < andmarruda@gmail.com >
     * @updatedTo PHP 8.1 or greater
     */

    namespace challenge1;
    require_once __DIR__. '/../vendor/autoload.php';

    class csvGen{
        /**
         * Column`s names and positions
         * @var array
         */
        private array $columns = [
            'product_id',           //id of the product
            'product_description',  //description of the product
            'price',                //price of the product
            'purchase_price',       //purchase price to calculate profit margin
            'discount',             //can be string with % or number if number will be already calculated if with % will have to calculate the difference to apply
        ];

        /**
         * Instance of faker
         * @var \Faker\Generator
         */
        private \Faker\Generator $faker;

        /**
         * Receive the path to store the csv file and the number of products that will be generated
         * 
         * @author  Anderson Arruda < andmarruda@gmail.com >
         * @param   private string $csvpath
         * @param   private string $numRows
         * @return  void
         */
        public function __construct(private string $csvpath, private string $numRows){
            $this->faker = \Faker\Factory::create();
            \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($this->faker);
        }

        /**
         * Generates the csv string and put this data into files
         * 
         * @author  Anderson Arruda < andmarruda@gmail.com >
         * @param
         * @return  string
         */
        public function generate() : string
        {
            $csv = implode(';', $this->columns).PHP_EOL;
            for($x=1; $x<=$this->numRows; $x++){
                $price = $this->faker->randomFloat(2, 25, 9999);
                $purchagePercentage = $this->faker->numberBetween(0.3, 0.6);
                $flagDiscount = $this->faker->numberBetween(0, 1); //if returns 1 will use the value as already calculated percentage, if returns 0 will use with % that indicates that have do calculate the value
                $init = $price * 0.01;
                $end = $price * 0.3;
                $percentage = $this->faker->randomFloat(2, $init, $end);
                if(!$flagDiscount){
                    $percentage = $this->faker->randomFloat(2, 0, 30). '%';
                }
                $csv .= $x.';'. $this->faker->productName. ';'. $price. ';'. ($price * $purchagePercentage). ';'. $percentage. PHP_EOL;
            }

            return $csv;
        }

        /**
         * Generates the csv and save as a file
         * 
         * @author  Anderson Arruda < andmarruda@gmail.com >
         * @param
         * @return void
         */
        public function generateAndSave() : void
        {
            if(!is_writable(dirname($this->csvpath)))
                throw new \Exception('Cannot save the file into path desired. Has no permission');

            if(file_exists($this->csvpath)){
                unlink($this->csvpath);
            }

            $csv = $this->generate();
            file_put_contents($this->csvpath, $csv, FILE_APPEND);
        }
    }
?>