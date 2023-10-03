<?php

?>

</main>


<footer class="footer">
    <div class="container">
        <div class="footer__inner">

			<?
				//logo
			?>
            <div class="footer__logo mb-block">
                <a href="/">
                    <img src="<? the_field("logo", 'options'); ?>" alt="">
                    <img class="header__logo-flag" src="/wp-content/themes/skinelly/node/src/img/flag.gif" alt="">
                </a>
            </div>


			<?
				// контакты
			?>
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
				<? if (get_field("tg", 'options')) : ?>
                    <a class="button button_tel " target="_blank" href="<? the_field("tg", 'options'); ?>">


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
            <input type="hidden" name="form_id" value="6">
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
				<? if (get_field("form_text", 'options')) : ?>
                    <label for="agreed">
                        <span class="home-form__agree">
                            <? the_field("form_text", 'options'); ?>
                        </span>
                    </label>
				<? endif; ?>
            </div>

            <div class="form__hidden">
                <input type="hidden" name="email_title" value="Заказать обратный звонок">
                <input type="hidden" name="ya_goal" value="callback">
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
            const u = 'https://cdn.leadgets.ru/',
                v = 'v1.js',
                s = {
                    link: [{
                        href: u,
                        rel: "dns-prefetch"
                    },
                        {
                            href: u,
                            rel: "preconnect"
                        }, {
                            href: u + v,
                            rel: "preload",
                            as: "script"
                        }
                    ],
                    script: [{
                        src: u + v,
                        async: ""
                    }]
                };
            Object.keys(s).forEach(function (c) {
                s[c].forEach(function (d) {
                    let e = document.createElement(c),
                        a;
                    for (a in d) e.setAttribute(a, d[a]);
                    document.head.appendChild(e)
                })
            })
        })();
        leadgets('init', '904331838a434597808f121a50f250f5');
    </script>
    <!--/Mna100 -->
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
<!-- Roistat Counter Start -->
<script>
    (function (w, d, s, h, id) {
        w.roistatProjectId = id;
        w.roistatHost = h;
        var p = d.location.protocol == "https:" ? "https://" : "http://";
        var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init?referrer=" + encodeURIComponent(d.location.href);
        var js = d.createElement(s);
        js.charset = "UTF-8";
        js.async = 1;
        js.src = p + h + u;
        var js2 = d.getElementsByTagName(s)[0];
        js2.parentNode.insertBefore(js, js2);
    })(window, document, 'script', 'cloud.roistat.com', '115d0594106852dbe69c02ff2c0c13e0');
</script>
<!-- Roistat Counter End -->
</body>

</html>
