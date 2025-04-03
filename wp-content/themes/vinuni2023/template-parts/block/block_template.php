<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$tex1 = 'Vestibulum sit amet malesuada elit.';
$tex2 = 'Morbi porta ullamcorper pulvinar.';
$arr = ['Sed eget est', 'mollis nulla'];
$url = '';

$test_or = validate_false_ui([$tex1, $tex2, $arr, $url]);
$test_and = validate_false_ui([$tex1, $tex2, $arr, $url], 'and');

var_dump($test_or, $test_and);
?>
<div class="container">
    <!-- block info -->
    <?php echo block_info($block_info); ?>
    <!-- html code -->
</div>