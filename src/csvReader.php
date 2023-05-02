<?php
    /**
     * Read the csv file and do the calculations needed
     * @author Anderson Arruda < andmarruda@gmail.com >
     * @updatedTo PHP 8.1 or greater
     */

    namespace challenge1;

    class csvReader{
        /**
         * Data from csv file
         * @var array
         */
        private array $data;

        /**
         * Column name`s position
         * @var array
         */
        private array $columns;

        /**
         * Receives the file path and prepare csv reader to handle with needs
         * 
         * @author  Anderson Arruda < andmarruda@gmail.com >
         * @param   private string $filepath
         * @return  void
         */
        public function __construct(private string $filepath)
        {
            if(!file_exists($this->filepath))
                throw new \Exception('File doesn\' exists');

            $this->prepare();
        }

        /**
         * Execute the data prepartion
         * 
         * @author  Anderson Arruda < andmarruda@gmail.com >
         * @param   
         * @return  void
         */
        private function prepare() : void
        {
            $handle = fopen($this->filepath, 'r');
            $header = true;
            while(($data = fgetcsv($handle, 8000, ';')) !== FALSE){
                $cols = count($data);
                $temp = [];
                for($x=0; $x<$cols; $x++){
                    if(!$header){
                        $temp[$this->columns[$x]] = $data[$x];
                    } else{
                        $this->columns[$x] = $data[$x];
                    }
                }

                if(count($temp) > 0){
                    if(preg_match('/\%$/', $temp['discount'])){
                        $temp['discount_percentage'] = preg_replace('/\%$/', '', $temp['discount']);
                        $temp['discount_amount'] = $temp['discount_percentage'] / 100 * $temp['price'];
                    } else{
                        if($temp['price'] > 0){
                            $temp['discount_percentage'] = $temp['discount'] * 100 / $temp['price'];
                            $temp['discount_amount'] = $temp['discount'];
                        }
                    }
                    $temp['total_discount'] = $temp['price'] - ($temp['discount_amount'] ?? 0);
                    $temp['profit_margin'] = 100;
                    if($temp['purchase_price'] > 0){
                        $temp['profit_margin'] = round(($temp['total_discount'] / $temp['purchase_price'] - 1) * 100, 2);
                        $temp['expected_margin'] = round(($temp['price'] / $temp['purchase_price'] - 1) * 100, 2);
                    }
                    $this->data[] = $temp;
                }

                $header=false;
            }
            fclose($handle);
        }

        /**
         * Returns all readed data
         * 
         * @author  Anderson Arruda < andmarruda@gmail.com >
         * @param
         * @return array
         */
        public function getData() : array
        {
            return $this->data;
        }
    }
?>