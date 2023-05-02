<?php
    require_once __DIR__. '/../src/csvReader.php';

    use challenge1\csvReader;
    $file = __DIR__.'/csvs/test1.csv';
    $reader = new csvReader($file);
    $data = $reader->getData();

    $csv = file_get_contents($file);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data presentation example for CSV</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-lg">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#presentation" type="button" role="tab" aria-controls="home" aria-selected="true">Apresentação</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#csv" type="button" role="tab" aria-controls="CSV" aria-selected="false">CSV</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="presentation" role="tabpanel" aria-labelledby="home-tab">
                        <h4>Lista de produtos</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Purchase Price</th>
                                    <th>Expected Margin</th>
                                    <th>Discount</th>
                                    <th>Percentage</th>
                                    <th>Total</th>
                                    <th>Profit Margin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($data as $d){
                                        echo '<tr>
                                            <td>'. $d['product_id']. '</td>
                                            <td>'. $d['product_description']. '</td>
                                            <td>US$ '. round($d['price'], 2). '</td>
                                            <td>US$ '. round($d['purchase_price'], 2). '</td>
                                            <td>'. round($d['expected_margin'], 2). '%</td>
                                            <td>US$ '. round($d['discount_amount'], 2). '</td>
                                            <td>'. round($d['discount_percentage'], 2). '%</td>
                                            <td>US$ '. round($d['total_discount'], 2). '</td>
                                            <td>'. round($d['profit_margin'], 2). '%</td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="csv" role="tabpanel" aria-labelledby="profile-tab">
                        <h4>CSV File</h4>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">CSV File</label>
                            <textarea class="form-control" id="purecsv" rows="200"><?= $csv; ?></textarea>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>