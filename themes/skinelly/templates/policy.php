<?php /* Template Name: Политика обработки персональных данных */
get_header();
$id = get_the_ID();
?>

<div class="container">
    <? the_field("policy_text", $id); ?>
</div>
<?php get_footer(); ?>