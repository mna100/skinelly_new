<?php /* Template Name: Карточка товара */
get_header();
$id = get_the_ID();
$cardResult = get_field("products_results", $id);
$videofile = get_field("product_video", $id);
$videopreview = get_field("product_video_preview", $id);
?>



<div class="card-header">
  <div class="container-small">
    <h1><? the_field("seo_meta_page_h1", $id); ?></h1>
    <div class="card-banner">
      <img src="<? the_field("product_banner", $id); ?>" alt="">
    </div>
    <div class="card-banner__name">
      <? the_field("product_name", $id); ?>
    </div>
  </div>
</div>

<div class="card-main" style="--product-color:<? the_field("product_color", $id); ?>">

  <div class="container">

    <div class="card-tabs">
      <button class="card-tab card-tab-active" data-tab="0">ХАРАКТЕРИСТИКИ ПРЕПАРАТА</button>
      <button class="card-tab" data-tab="1">ПОКАЗАНИЯ</button>
      <button class="card-tab" data-tab="2">ОБЛАСТИ И ТЕХНИКА ВВЕДЕНИЯ</button>
      <? if ($videofile) { ?>
        <div class="card-tabs-hr"></div>
        <button class="card-tab" data-tab="3">Видео</button>
      <? } ?>
      <? if ($cardResult) { ?>
        <button class="card-tab" data-tab="4">РЕЗУЛЬТАТЫ</button>
      <? } ?>
    </div>

    <div class="card-tabs__container">


      <div class="card-tabs__inner card-tabs__inner--active" data-tab-container="0">

        <div class="card-chars" style="--bg-chars-color: <? the_field("color_table", $id); ?>; --text-chars-color: <? the_field("color_table_text", $id); ?>;">

          <? $chars = get_field("product_chars", $id); ?>

          <? foreach ($chars as $item) { ?>

            <div class="card-chars-row">
              <div class="card-chars-td card-chars-name">
                <?= $item["left"]; ?>
              </div>

              <div class="card-chars-td card-chars-value">
                <?= $item["right"]; ?>
              </div>
            </div>

          <? } ?>

        </div>

      </div>


      <div class="card-tabs__inner" data-tab-container="1">

        <div class="card-testimony">

          <div class="card-testimony__photo">
            <a href="<? the_field("testimony_image", $id); ?>" data-fancybox>
              <img src="<? the_field("testimony_image", $id); ?>" alt="">
            </a>
          </div>

          <div class="card-testimony__info">
            <div class="card-testimony__subtitle">
              <? the_field("testimony_title", $id); ?>
            </div>
            <div class="card-testimony__text">
              <? the_field("testimony_text", $id); ?>
            </div>
          </div>

        </div>

      </div>



      <div class="card-tabs__inner" data-tab-container="2">

        <div class="card-injection">

          <div class="card-injection__photo">
            <a href="<? the_field("injection_image", $id); ?>" data-fancybox>
              <img src="<? the_field("injection_image", $id); ?>" alt="">
            </a>
          </div>

          <div class="card-injection__info">

            <? $injection_text = get_field("injection_text", $id); ?>

            <? foreach ($injection_text as $text_block) : ?>

              <div class="card-injection__info-block">
                <div class="card-injection__subtitle">
                  <?= $text_block["subtitle"]; ?>
                </div>
                <div class="card-injection__text">
                  <?= $text_block["text"]; ?>
                </div>
              </div>

            <? endforeach; ?>

          </div>

        </div>

      </div>



      <div class="card-tabs__inner" data-tab-container="3">

        <div class="card-video">

          <? if ($videofile) { ?>

            <div class="card-video__wrap">
              <? if ($videopreview) : ?>
                <div class="card-video__preview">
                  <img src="<?= $videopreview; ?>" alt="">
                </div>
              <? endif; ?>
              <div class="card-video__play">
                <svg width="166" height="193" viewBox="0 0 166 193" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M166 96.5L0.250002 0.804197L0.25 192.196L166 96.5Z" fill="#323232" />
                </svg>
              </div>
              <div class="card-video__media">
                <video src="<?= $videofile; ?>" controls></video>
              </div>
            </div>

          <? } else {
            echo "<p>Нет видео</p>";
          } ?>

        </div>

      </div>


      <div class="card-tabs__inner" data-tab-container="4">

        <div class="card-results">

          <div class="swiper card-results__slider">
            <div class="swiper-wrapper">
              <? foreach ($cardResult as $item) { ?>
                <div class="swiper-slide">
                  <img src="<?= $item["image"]; ?>" alt="">
                </div>
              <? } ?>
            </div>
          </div>
          <div class="swiper-button-next-results">
            <svg width="52" height="109" viewBox="0 0 52 109" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 2L47.4289 47.4289C51.3342 51.3342 51.3342 57.6658 47.4289 61.5711L2 107" stroke="black" stroke-width="3" />
            </svg>
          </div>
          <div class="swiper-button-prev-results">
            <svg width="52" height="109" viewBox="0 0 52 109" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M50 2L4.97013 47.4629C1.10989 51.3602 1.10989 57.6398 4.97013 61.5372L50 107" stroke="black" stroke-width="3" />
            </svg>
          </div>

        </div>

      </div>

    </div>


    <div class="card-advantages" style="--color-advantages: <? the_field("color_advantages", $id); ?>">

      <div class="card-advantages__title"><? the_field("advantages_subtitle", $id); ?></div>

      <? $advantages = get_field("advantages"); ?>

      <div class="card-advantages__list">
        <? foreach ($advantages as $key => $el) : ?>
          <? $key++; ?>
          <? if ($key == 1 or $key == 4) : ?>
            <div class="card-advantages__column">
            <? endif; ?>
            <div class="card-advantages__item">
              <div class="card-advantages__number"><?= $key; ?></div>
              <div class="card-advantages__text">
                <?= $el["item"]; ?>
              </div>
            </div>
            <? if ($key == 3 or $key == 6) : ?>
            </div>
          <? endif; ?>
        <? endforeach; ?>
      </div>

    </div>


    <div class="home-form">

      <div class="container">


        <div class="title-section">
          <h2>ПОЛУЧИТЬ КП</h2>
        </div>


        <div class="home-form__wrap">

          <form class="form fetch">
            <div class="home-form__row">
              <div class="home-form__col form__input">
                <input type="text" name="name" placeholder="Ваше имя">
              </div>
              <div class="home-form__col form__input">
                <input type="tel" name="phone" placeholder="Номер телефона">
              </div>
              <div class="home-form__col form__submit">
                <input type="submit" value="Отправить">
              </div>
            </div>
            <div class="form__hidden">
              <input type="hidden" name="email_title" value="Заказать обратный звонок">
              <input type="hidden" name="ya_goal">
            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>


<?php get_footer(); ?>
