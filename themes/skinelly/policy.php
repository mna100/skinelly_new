<?php /* Template Name: Политика */
	get_header(); ?>
	
	
	
	<div id="policy" class="policy">
		
		<header id="header" class="header-policy">
			
			<div class="panel-bar panel-bar--left">
				
				<div class="panel-logo panel-logo-animate">
					<img src="<? the_field("logotype", "options");?>" alt="">
				</div>
				
				<div class="panel-contacts">
					<div class="panel-phone panel-phone-animate">
						<a href="tel:<? the_field("phone", "options");?>">
							<? the_field("phone", "options");?>
						</a>
					</div>
					<div class="panel-mail panel-mail-animate">
						<a href="mailto:<? the_field("email", "options");?>">
							<? the_field("email", "options");?>
						</a>
					</div>
				</div>
				
				<div class="panel-line"></div>
				
				<? $btn_call= get_field("btn_call", "options");?>
				<div class="panel-call">
      <span class="modal-link"
            data-href="#popup"
            data-modal-title="<?= $btn_call["title_popup"];?>"
            data-modal-submit="<?= $btn_call["text_popup"];?>"
            data-modal-email="<?= $btn_call["title_email"];?>"
      >
        <?= $btn_call["text"];?>
      </span>
				</div>
			
			</div>
			
			<div class="panel-bar panel-bar--right">
				
				<button class="menu-burger menu-burger-animate">
					<span class="menu-burger-line menu-burger-line--top"></span>
					<span class="menu-burger-line menu-burger-line--bottom"></span>
					<span class="menu-burger-text">меню</span>
				</button>
				
				<div class="menu">
					<div class="menu-content">
						<div class="menu-list">
							<ul>
								<li>
									<span>01</span>
									<a href="#header">Начало</a>
								</li>
								<li>
									<span>02</span>
									<a href="#refrigerator-section">Холодильно-отопительные установки</a>
								</li>
								<li>
									<span>03</span>
									<a href="#catalog">каталог запчастей</a>
								</li>
								<li>
									<span>04</span>
									<a href="#contacts">контакты</a>
								</li>
							</ul>
						</div>
						<div class="menu-contacts">
							<div class="menu-links">
								<a href="">8 800 101-73-09</a>
								<a href="">info@refika.ru</a>
								<a href="">Telegram</a>
								<a href="">WhatsApp</a>
							</div>
							<div class="menu-managers">
								<div class="menu-managers__item">
									<a href="">+7 (967) 706-50-50</a>
									<span>Менеджер по продажам</span>
								</div>
								<div class="menu-managers__item">
									<a href="">+7 (841) 245-80-20</a>
									<span>Техническая поддержка</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="panel-social">
					
					<a class="panel-social__link panel-social-tg" href="">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M20.6492 3.20458L1.70284 10.5485C0.940408 10.8905 0.682532 11.5754 1.51856 11.9471L6.37912 13.4997L18.1313 6.19906C18.773 5.74074 19.43 5.86296 18.8647 6.36714L8.7711 15.5534L8.45404 19.441C8.74771 20.0413 9.28543 20.0441 9.62843 19.7457L12.421 17.0897L17.2036 20.6896C18.3144 21.3506 18.9189 20.924 19.1579 19.7125L22.2949 4.78162C22.6206 3.29029 22.0651 2.63319 20.6492 3.20458Z" fill="#005CA9"/>
						</svg>
					</a>
					
					<a class="panel-social__link panel-social-call" href="">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6.08737 2.58905C0.999832 5.88908 -0.512679 12.6266 2.64984 17.8517C5.81237 22.9392 12.6874 24.5892 17.775 21.2892L18.1875 21.0142L22.3125 22.1142L21.2125 17.9892L21.4875 17.5767C22.45 15.7892 23 13.8641 23 11.9391C23 9.87661 22.45 7.81409 21.35 6.02658C18.05 0.939037 11.3124 -0.573471 6.08737 2.58905ZM16.675 5.47657C17.5 6.02658 18.05 6.71408 18.1875 7.67659C18.1875 8.22659 18.4625 8.9141 17.3625 11.6641C16.2624 14.0016 14.4749 15.9267 12.4124 17.3017C11.4499 18.1267 10.2124 18.5392 8.97489 18.6767C7.87489 18.6767 6.91238 18.2642 6.22487 17.5767C5.94987 17.3017 5.81237 17.0267 5.81237 16.7517V16.0642C5.81237 15.7892 5.81237 15.5141 6.36237 15.3766C7.04988 15.1016 8.69989 14.4141 8.83739 14.4141C8.97489 14.2766 9.2499 14.2766 9.3874 14.4141C9.6624 14.2766 9.9374 14.4141 10.0749 14.5516C10.2124 14.6891 10.4874 14.8266 10.6249 14.9641C10.7624 15.2391 11.0374 15.3766 11.3124 15.2391C12.1374 14.6891 12.9624 14.0016 13.6499 13.3141C14.3374 12.4891 14.8874 11.6641 15.2999 10.7016C15.4374 10.4266 15.4374 10.1516 15.1624 10.0141C14.8874 9.87661 14.1999 9.1891 13.9249 8.9141C13.6499 8.6391 13.6499 8.5016 13.7874 8.22659L14.8874 6.02658C15.0249 5.75158 15.1624 5.47657 15.2999 5.33907C15.7124 5.20157 16.2624 5.20157 16.675 5.47657Z" fill="#005CA9"/>
						</svg>
					</a>
				
				</div>
				
				<div class="panel-line"></div>
				
				
				<? $btn_consult= get_field("btn_consult", "options");?>
				<div class="panel-call">
      <span class="modal-link"
            data-href="#popup"
            data-modal-title="<?= $btn_consult["title_popup"];?>"
            data-modal-submit="<?= $btn_consult["text_popup"];?>"
            data-modal-email="<?= $btn_consult["title_email"];?>"
      >
        <?= $btn_consult["text"];?>
      </span>
				</div>
			
			</div>
		
		</header>
		
		<div class="container">
			<?php the_content()?>
		</div>
		
		
		<footer class="footer">
			<div class="container">
				<div class="footer-row">
					<div class="footer-item">
						<p>© 2022. ООО «Рефика», Все права защищены.</p>
					</div>
					<div class="footer-item">
						<a href="/policy">Политика конфиденциальности </a>
					</div>
					<div class="footer-item">
						<p class="footer-developer">Разработка — <a href="https://marketing-na100.ru/" target="_blank">Маркетинг на 100</a></p>
					</div>
				</div>
			</div>
		</footer>
		
	</div>
	
	

<?php get_footer();