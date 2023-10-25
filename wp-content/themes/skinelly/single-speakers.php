<?php /* Template Name: Мероприятие */
get_header();
$id = get_the_ID();
?>

<div class="speakers-post">
    <div class="container">
        <div class="speakers-post__inner">
            <? $img = get_the_post_thumbnail($post->ID, 'full'); ?>
            <div class="speakers-post__title-wrap">
                <h1 class="speakers-post__title"><?= (get_meta($id)["h1"]) ? get_meta($id)["h1"] : the_title(); ?></h1>
            </div>
            <div class="speakers-post__bottom-img">
                <? if ($img) : ?>
                    <? echo $img; ?>
                <? else : ?>
                    <img src="<?= get_template_directory_uri() . '/public/no-photo.png' ?>" alt="<? the_title(); ?>">
                <? endif; ?>
            </div>

            <? if (get_field('spicker_text_detail', $id)) : ?>
                <div class="speakers-post__bottom-text"><?= get_field('spicker_text_detail', $id); ?></div>
            <? endif; ?>
        </div>

        <? //третий блок - основной контентент
        ?>
        <div class="events__content editor">
            <? the_content(); ?>
        </div>

    </div>
</div>

<?php if (get_field('speakers_video_id')) { ?>
    <div class="speakers-video">
        <div class="container">
            <h2>Видео-визитка</h2>
            <div class="speakers-video-inner">
                <img id="<?php echo get_field('speakers_video_id', $page_id); ?>" class="video__frame lozad" src="#" data-src="<?php echo get_field('speakers_video_img', $page_id); ?>" src="#" alt="Видео">
            </div>

        </div>
    </div>
<?php } else { ?>

<?php } ?>


<? include_once TEMPLATEPATH . '/templates/form-events.php'; ?>
<?php get_footer(); ?>