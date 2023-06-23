<?php

?>

</main>


<footer class="footer">

    <div class="container">
        <div class="footer__inner">

			<? //logo?>
            <div class="footer__logo mb-block">
                <a href="/">
                    <img src="<? the_field("logo", 'options'); ?>" alt="">
                    <img class="header__logo-flag" src="/wp-content/themes/skinelly/node/src/img/flag.gif" alt="">
                </a>
            </div>


			<? //контакты?>
            <div class="footer__data mb-block">
                <div class="footer__address">
					<? the_field("address", 'options'); ?>
                </div>
                <div class="footer__contacts">
					<? if (get_field("phone", 'options')) { ?>
                        <a href="tel:<? echo get_phone_link(get_field("phone", 'options')); ?>">
							<? the_field("phone", 'options'); ?>
                        </a>
					<? } ?>
                    <br>
					<? if (get_field("email", 'options')) { ?>
                        <a href="mailto:<? the_field("email", 'options'); ?>">
							<? the_field("email", 'options'); ?>
                        </a>
					<? } ?>
                </div>
            </div>


            <div class="footer__menu footer__menu_first mb-block">
				<?php wp_nav_menu(['theme_location' => 'menu-footer-first']); ?>
            </div>

            <div class="footer__menu  mb-block">
				<?php wp_nav_menu(['theme_location' => 'menu-footer-second']); ?>
            </div>

            <div class="footer__column mb-block">
                <button class="button modal-link" data-href="#popup">Заказать звонок</button>
				<? if (get_field("tg", 'options')): ?>
                    <a class="button button_tel" target="_blank" href="<? the_field("tg", 'options'); ?>">
                        <svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="26" height="21" fill="url(#pattern1)"/>
                            <defs>
                                <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_1_24332" transform="matrix(0.00106157 0 0 0.00131433 0 -0.0112729)"/>
                                </pattern>
                                <image id="image0_1_24332" width="942" height="778" xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>

                        Подписаться
                    </a>
				<? endif; ?>
            </div>
        </div>
    </div>

</footer>


<div id="popup" class="modal" style="display: none">
    <div class="modal__content">
        <form class="form form-modal fetch">
            <div class="form__input-wrap">
                <div class="form__input">
                    <input type="tel" name="phone" class="phone-mask" placeholder="Телефон" autocomplete="off" required>
                    <span class="form__input__placeholder">Номер телефона</span>
                </div>
                <div class="form__input">
                    <input type="text" name="name" placeholder="Ваше имя" autocomplete="off">
                    <span class="form__input__placeholder">Имя</span>
                </div>
                <div class="form__input">
                    <button type="submit" class="button button_white">Отправить</button>
                </div>
            </div>
            <div class="form__policy">
                <input type="checkbox" id="agreed" name="agreed" value="y" checked>
                <label for="agreed">
                    <span>Заполняя форму, вы принимаете условия <a href="">политики конфединциальности</a></span>
                </label>
            </div>

            <div class="form__hidden">
                <input type="hidden" name="email_title" value="Заказать обратный звонок">
                <input type="hidden" name="ya_goal">
            </div>
        </form>
    </div>
</div>


<div id="thanks" class="modal thanks" style="display: none">

    <div class="thanks_wrap">
        <img src="/wp-content/themes/skinelly/node/src/img/thanks.png" alt="">
    </div>

</div>


<?php wp_footer(); ?>


<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>

    <!-- Mna100 -->
    <script>

        (function () {
            window.leadgets = window.leadgets || function () {
                (leadgets.q = leadgets.q || []).push(arguments)
            };
            const u = 'https://cdn.leadgets.ru/', v = 'v1.js', s = {
                link: [{href: u, rel: "dns-prefetch"},
                    {href: u, rel: "preconnect"}, {href: u + v, rel: "preload", as: "script"}],
                script: [{src: u + v, async: ""}]
            };
            Object.keys(s).forEach(function (c) {
                s[c].forEach(function (d) {
                    let e = document.createElement(c), a;
                    for (a in d) e.setAttribute(a, d[a]);
                    document.head.appendChild(e)
                })
            })
        })();
        leadgets('init', '904331838a434597808f121a50f250f5');
    </script>
    <!-- /Mna100 -->


    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(92035751, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true,
            trackHash: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/92035751" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript> <!-- /Yandex.Metrika counter -->

<?php endif; ?>
</body>

</html>
