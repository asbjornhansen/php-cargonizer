<?php

include __DIR__.'/../vendor/autoload.php';

$yaml = new \Symfony\Component\Yaml\Parser;
$settings = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/config.yml'));

try {
    \zaporylie\Cargonizer\Config::set('endpoint', $settings['endpoint']);
    \zaporylie\Cargonizer\Config::set('secret', $settings['secret']);
    \zaporylie\Cargonizer\Config::set('sender', $settings['sender']);

    $agreements = (new \zaporylie\Cargonizer\Agreements)->getAgreements();

    if (isset($_POST['product'], $_POST['postcode'], $_POST['weight'])) {
        $item = new \zaporylie\Cargonizer\Data\Item;
        $items = new \zaporylie\Cargonizer\Data\Items;
        $parts = new \zaporylie\Cargonizer\Data\Parts;
        $consignee = new \zaporylie\Cargonizer\Data\Consignee;
        $consignment = new \zaporylie\Cargonizer\Data\Consignment;
        $consignments = new \zaporylie\Cargonizer\Data\Consignments;

        $item->setPackage('package');
        $item->setAmount(1);
        $item->setWeight($_POST['weight']);

        $items->addItem($item);

        $consignee->setName('Test name');
        $consignee->setCountry('NO');
        $consignee->setPostcode($_POST['postcode']);

        $parts->setConsignee($consignee);

        $product = explode('-', $_POST['product']);
        $consignment->setTransportAgreement($product[0]);
        $consignment->setProduct($product[1]);
        $consignment->setParts($parts);
        $consignment->setItems($items);

        $consignments->addItem($consignment);

        /** @var \zaporylie\Cargonizer\Data\Estimation $result */
        $result = (new \zaporylie\Cargonizer\Estimation)->getEstimation($consignments);
        var_dump($result);
    }

} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTraceAsString());
}

?>

<form method="post">
  <label for="product">Product</label>
  <select name="product">
    <?php
    foreach ($agreements as $agreement) {
        echo '<optgroup label="'.$agreement->getDescription().'">';
        /** @var \zaporylie\Cargonizer\Data\Product $product */
        foreach ($agreement->getProducts() as $product) {
            $id = $agreement->getId().'-'.$product->getIdentifier();
            echo '<option value="'.$id.'" '.(isset($_POST['product']) && $id == $_POST['product'] ? 'selected' : null).'>'.$product->getName().'</option>';
        }
        echo '</optgroup>';
    }
?>
  </select>

  <label for="postcode">Postcode</label>
  <input name="postcode" required="required" type="text" <?php echo isset($_POST['postcode']) ? 'value="'.$_POST['postcode'].'"' : null ?>>

  <label for="weight">Weight</label>
  <input name="weight" required="required" type="number"  <?php echo isset($_POST['weight']) ? 'value="'.$_POST['weight'].'"' : null ?>>

  <input type="submit" value="Get quote">
</form>
