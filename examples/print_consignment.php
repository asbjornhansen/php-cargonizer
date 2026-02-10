<?php

include __DIR__.'/../vendor/autoload.php';

$yaml = new \Symfony\Component\Yaml\Parser;
$settings = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/config.yml'));

try {
    \zaporylie\Cargonizer\Config::set('endpoint', $settings['endpoint']);
    \zaporylie\Cargonizer\Config::set('secret', $settings['secret']);
    \zaporylie\Cargonizer\Config::set('sender', $settings['sender']);

    if (isset($_POST['consignment_id'], $_POST['printer_id'])) {

        /** @var \zaporylie\Cargonizer\Data\Results $result */
        $result = (new \zaporylie\Cargonizer\ConsignmentPrinter)->printConsigment($_POST['consignment_id'], $_POST['printer_id']);
        var_dump($result);
    }
} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTraceAsString());
}

?>

<form method="post">

  <label for="consignment_id">Consignment ID</label>
  <input name="consignment_id" required="required" type="text" <?php echo isset($_POST['consignment_id']) ? 'value="'.$_POST['consignment_id'].'"' : null ?>>

  <label for="printer_id">Printer ID</label>
  <input name="printer_id" required="required" type="text"  <?php echo isset($_POST['printer_id']) ? 'value="'.$_POST['printer_id'].'"' : null ?>>

  <input type="submit" value="Print consignment">
</form>
