<?php

if (!empty(getBody()['id'])) {
    $id = getBody()['id'];
    $sql = "SELECT * FROM services WHERE id=" . $id;
    $serviceDetail = firstRaw($sql);
    if (empty($serviceDetail)) {
        loadError();
    }
} else {
    loadError();
}

$data = [
    'pageTitle' => $serviceDetail['name']
];

layout('header', 'client', $data);

$data['itemParent'] = '<li><a href="' . _WEB_HOST_ROOT . '/modules/services/lists.php' . '">' . getOption('service_title') . '</a></li>';

layout('breadcrumb', 'client', $data);

?>
<!-- Services -->
<section id="services" class="services archives section">
    <div class="container">
        <h1><?php echo !empty($serviceDetail['name']) ? $serviceDetail['name'] : false ?></h1>
        <hr>
        <?php echo !empty($serviceDetail['content']) ? html_entity_decode($serviceDetail['content']) : false ?>
    </div>
</section>
<!--/ End Services -->
<?php
layout('footer', 'client');
