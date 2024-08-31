<?php include "../view/header.php"?>
<?php include "../db/userdb.php"?>
<main>
    <h1 style="text-align:center;" class="white" > <?php echo $categoryName; ?> </h1>
        <article>
            <h1 class ="white"> <php? echo $usrname ></php></h1>   
        <section>
            <table class ="table table-light table-striped w-50">
                <tr>
                    <thead>
                        return $showall_posts;
                    </thead> 
                </tr>
                <tbody>
                    <?php 
                        foreach($products as $product){
                            echo "<tr>";
                            echo "td> " . $product['productCode'] . " </td";
                            echo "td> " . $product['productName'] . " </td";
                            echo "td> " . $product['listPrice'] . " </td";
                            echo "td> " . $product['productID'] . " </td";

                        }
                    ?>
                </tbody>

            </table>
        </section>
        </article>
</main>
<?php
include '../view/footer.php'
?>