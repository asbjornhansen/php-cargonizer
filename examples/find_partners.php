<?php

include __DIR__.'/../vendor/autoload.php';

$yaml = new \Symfony\Component\Yaml\Parser;
$settings = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/config.yml'));

try {
    \zaporylie\Cargonizer\Config::set('endpoint', $settings['endpoint']);
    \zaporylie\Cargonizer\Config::set('secret', $settings['secret']);
    \zaporylie\Cargonizer\Config::set('sender', $settings['sender']);

    $agreements = (new \zaporylie\Cargonizer\Agreements)->getAgreements();

    if (isset($_POST['carrier'], $_POST['postcode'], $_POST['country'])) {

        /** @var \zaporylie\Cargonizer\Data\Results $result */
        $result = (new \zaporylie\Cargonizer\Partners)->getPickupPoints($_POST['country'], $_POST['postcode'], $_POST['carrier']);
        echo '<pre>';
        var_dump($result);
        echo '</pre>';
    }

} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTraceAsString());
}

?>

<form method="post">
  <label for="carrier">Carrier</label>
  <select name="carrier">
    <?php
    foreach ($agreements as $agreement) {
        $id = $agreement->getCarrier()->getIdentifier();
        echo '<option value="'.$id.'" '.(isset($_POST['carrier']) && $id == $_POST['carrier'] ? 'selected' : null).'>'.$agreement->getCarrier()->getName().'</option>';
    }
?>
  </select>

  <label for="postcode">Postcode</label>
  <input name="postcode" required="required" type="text" <?php echo isset($_POST['postcode']) ? 'value="'.$_POST['postcode'].'"' : null ?>>

  <label for="country">Country</label>
  <input name="country" required="required" type="text"  <?php echo isset($_POST['country']) ? 'value="'.$_POST['country'].'"' : null ?>>

  <input type="submit" value="Get list of partners">
</form>
