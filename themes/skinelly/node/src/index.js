import "./index.scss";

/**
 * Import modules
 */

import Inputmask from "inputmask/dist/inputmask.min.js";
import {Fancybox} from "@fancyapps/ui";
import Swiper from "swiper/bundle";
import ymaps from "ymaps";
import lozad from "lozad";
import Toastify from "toastify-js";


/**
 * Helpers
 */
//console.log("null");
const cyrValue = (str) => {
    return /[^а-яА-ЯёЁ -]/gi.test(str);
};
const fancyboxShow = (src, type) => {
    Fancybox.show([
        {
            src: src,
            type: type,
            autoFocus: false,
            trapFocus: false,
            placeFocusBack: false,
        },
    ]);
};


const toast = (title = "", text = "", type = "info") => {
    let message, messageTitle, messageText;
    message = document.createElement("div");
    messageTitle = document.createElement("p");
    messageTitle.classList.add("title");
    messageTitle.innerHTML = title;
    messageText = document.createElement("p");
    messageText.classList.add("text");
    messageText.innerHTML = text;
    message.append(messageTitle, messageText);

    Toastify({
        className: type,
        close: true,
        destination: false,
        duration: 3000,
        escapeMarkup: false,
        gravity: "bottom",
        position: "right",
        stopOnFocus: true,
        text: message.innerHTML,
        onClick: () => {
        },
    }).showToast();
};

if (document.querySelector("#policy")) {
    document.querySelector("html").style.overflowY = "scroll";
}

/**
 * Fields validation
 */
if (document.querySelector("input[name='agreement']")) {
    document.querySelectorAll("input[name='agreement']").forEach((el) => {
        el.addEventListener("change", (evt) => {
            const status = evt.currentTarget.checked;

            if (status) {
                evt.currentTarget
                    .closest("form")
                    .querySelector("button")
                    .removeAttribute("disabled");
            } else {
                evt.target
                    .closest("form")
                    .querySelector("button")
                    .setAttribute("disabled", "");
            }
        });
    });
}
if (document.querySelectorAll("input[name='name']")) {
    document.querySelectorAll("input[name='name']").forEach((el) => {
        let counter = 0;

        el.addEventListener("keyup", (evt) => {
            if (cyrValue(evt.target.value)) {
                counter++;

                if (counter > 5) {
                    toast("Внимание!", "Имя должно быть на русском языке", "warning");
                    counter = 0;
                }
            }

            evt.target.value = evt.target.value.replace(/[^а-яА-ЯёЁ -]/gi, "");
        });
    });
}
if (document.querySelector("input[name='phone']")) {
    document.querySelectorAll("input[name='phone']").forEach((el) => {
        let im = new Inputmask({
            mask: "+7 (e99) 999-99-99",
            definitions: {
                e: {
                    validator: "[0-7,9]",
                },
            },
        });
        im.mask(el);

        el.addEventListener("blur", (evt) => {
            if (
                evt.currentTarget.value[17] == "_" ||
                evt.currentTarget.value[17] == undefined
            ) {
                toast("Внимание!", "Некорректный номер", "WARNING");
                evt.target.parentNode.classList.add("error");
                evt.target.parentNode.classList.remove("valid");
            } else {
                evt.target.parentNode.classList.add("valid");
                evt.target.parentNode.classList.remove("error");
            }
        });
    });
}
if (document.querySelector("input[required]")) {
    document.querySelectorAll("input[required]").forEach((el) => {
        el.addEventListener("blur", (evt) => {
            if (evt.target.value.length == 0) {
                toast("Внимание!", "Поле обязательно для заполнения", "WARNING");
            }
        });
    });
}
if (document.querySelector("input[type='text'], input[type='email'], textarea")) {
    document
        .querySelectorAll("input[type='text'], input[type='email'], textarea")
        .forEach((el) => {
            el.addEventListener("blur", (evt) => {
                if (evt.target.value.length > 0) {
                    evt.target.parentNode.classList.add("valid");
                } else {
                    evt.target.parentNode.classList.remove("valid");
                }
            });
        });
}


if (document.querySelector("input[name='file_attach[]']")) {
    document.querySelectorAll("input[name='file_attach[]']").forEach((el) => {
        el.addEventListener("change", (evt) => {
            var filename = el.files[0].name;
            evt.currentTarget.closest("form").querySelector("#file-name").innerText = filename;
            evt.currentTarget.closest("form").querySelector(".form__input-file").classList.add("is-loaded");

        });

    });
}

if (document.querySelector(".file-delete")) {
    document.querySelectorAll(".file-delete").forEach((el) => {
        el.addEventListener("click", (evt) => {
            evt.currentTarget.closest("form").querySelector("#file-name").innerText = "";
            evt.currentTarget.closest("form").querySelector(".form__input-file").classList.remove("is-loaded");

        });

    });
}

/**
 * Form
 */
if (document.querySelector("form.fetch")) {

    document.querySelectorAll("form.fetch").forEach((form) => {
        form.addEventListener("submit", (evt) => {
                evt.preventDefault();
                //let yaGoal = form.querySelector("input[name='ya_goal']").value;

                let phone = form.querySelector("input[name='phone']").value;
                let name = form.querySelector("input[name='name']").value;

                if (phone.length[17] === "_" || phone.length === 0) {
                    document.querySelector("input[name='phone']").classList.add("is-error");
                } else if (name.length === 0) {
                    document.querySelector("input[name='name']").classList.add("is-error");
                } else {
                    if (form.querySelector("input[type='submit']"))
                        form
                            .querySelector("input[type='submit']")
                            .setAttribute("disabled", "");
                    if (form.querySelector("button[type='submit']"))
                        form
                            .querySelector("button[type='submit']")
                            .setAttribute("disabled", "");

                    let data = new FormData(form);

                    leadgets('lead', data, (r) => {
                        console.log(r)
                        if (r.status === 1) {

                            if (form.querySelector("#file_presentation")) {
                                let link = form.querySelector("#file_presentation").value;
                                var link_form = document.createElement('a');

                                link_form.setAttribute('href', link);
                                link_form.setAttribute('download', 'Презентация');
                                onload = link_form.click();
                            }

                            Fancybox.close();
                            if (form.querySelector("input[type='submit']"))
                                form
                                    .querySelector("input[type='submit']")
                                    .removeAttribute("disabled", "");
                            if (form.querySelector("button[type='submit']"))
                                form
                                    .querySelector("button[type='submit']")
                                    .removeAttribute("disabled", "");

                            form.querySelectorAll("input").forEach((inp) => {
                                if (
                                    inp.type !== "submit" &&
                                    inp.type !== "checkbox" &&
                                    inp.type !== "radio" &&
                                    inp.type !== "hidden"
                                ) {
                                    inp.value = "";
                                    inp.parentNode.classList.remove("valid");
                                }
                            });
                            if (form.querySelector("textarea")) {
                                form.querySelector("textarea").value = "";
                                form
                                    .querySelector("textarea")
                                    .parentNode.classList.remove("valid");
                            }
                            if (form.querySelector("input[type='checkbox']")) {
                                form.querySelectorAll("input[type='checkbox']").forEach((el) => {
                                    if (el.name != "agreement") el.checked = false;
                                });
                            }

                            setTimeout(() => {
                                fancyboxShow("#thanks", "inline");
                            }, 150);
                            setTimeout(() => {
                                Fancybox.close();
                            }, 5000);

                            /* if (typeof ym == "function") {
                                 ym("XXXXXXXX", "reachGoal", yaGoal);
                                 console.log("Цель достигнута: " + yaGoal);
                             }*/
                            if (typeof gtag == "function") {
                                //gtag("event", "form_lead", {"event_category": "lead", "event_action": "zayavka"});
                            }
                        } else {
                            toast("Внимание!", "Ошибка ! " + r.message, "WARNING");

                            Fancybox.close();

                        }
                    });
                }
            }
        );
    });
}


/**
 * Modal
 */
if (document.querySelector(".modal-link")) {
    document.querySelectorAll(".modal-link").forEach((el) => {
        el.addEventListener("click", (evt) => {
            evt.preventDefault();

            const button = evt.currentTarget,
                target = button.dataset.dataHref || button.dataset.href,
                popup = document.querySelector(target),
                title = button.dataset.modalTitle,
                content = button.dataset.modalContent,
                footer = button.dataset.modalFooter,
                submit = button.dataset.modalSubmit,
                yagoal = button.dataset.modalYagoal,
                email = button.dataset.modalEmail,
                services = button.dataset.modalServices,
                files = button.dataset.modalFiles;

            if (title) popup.querySelector(".modal__title").innerHTML = title;
            if (submit) popup.querySelector(".form__submit .button").innerHTML = submit;
            if (yagoal) popup.querySelector("input[name='ya_goal']").value = yagoal;
            if (email) popup.querySelector("input[name='email_title']").value = email;
            if (target) fancyboxShow(target, "inline");

            let filesArray;
            let filesStroke

            if (files) {
                filesStroke = files.slice(0, -1);
                filesArray = filesStroke.split(',');
            }

            if (services) {
                let wrap_select = popup.querySelector(".form__options");
                if (!(wrap_select.classList.contains("filled"))) {
                    wrap_select.classList.add("filled");
                    const servicesStroke = services.slice(0, -1);
                    const servicesArray = servicesStroke.split(',');
                    servicesArray.forEach(function (item, index) {
                        var div = document.createElement('div');
                        div.classList.add("form__options-item");
                        div.textContent = item;
                        if (files) {
                            div.dataset.fileUrl = filesArray[index];
                        }
                        div.addEventListener("click", function () {
                            popup.querySelector("input[name='select_service']").value = item;
                            popup.querySelector(".form__select__toggle").innerHTML = item;

                            if (files) {
                                popup.querySelector("input[name='file_presentation']").value = this.dataset.fileUrl;
                            }

                            popup.querySelector(".form__select__toggle").classList.remove("form__select__toggle--opened");
                            popup.querySelector(".form__options").classList.remove("form__options--opened");
                        });
                        wrap_select.appendChild(div);
                    })

                }
            }

        });
    });
}


/**
 * Lazy load
 */
const observer = lozad('.lozad', {
    load: function (el) {
        el.classList.add('loading');
        el.src = el.getAttribute('data-src');
    },
    loaded: function (el) {
        el.classList.remove('loading');
    }
});
observer.observe();


/**
 * Mobile menu
 */
if (document.querySelector(".menu-burger")) {
    document.querySelector(".menu-burger").addEventListener("click", (evt) => {
        let buttonClasslist = evt.currentTarget.classList;
        buttonClasslist.toggle("active");

        if (buttonClasslist.contains("active")) {
            document.querySelector(".menu").classList.add("active");
            document.querySelector("html").style.overflowY = "hidden";
        } else {
            document.querySelector(".menu").classList.remove("active");
            document.querySelector("html").style.overflowY = "auto";
        }
    });
}


//SCROLL TO
const scrollTo = (target) => {
    document
        .querySelector(target)
        .scrollIntoView({block: "start", behavior: "smooth"});
};

if (document.querySelector(".menu-list")) {
    document.querySelectorAll(".menu-list a").forEach((link) => {
        link.addEventListener("click", (evt) => {
            evt.preventDefault();
            scrollTo(link.hash);

            setTimeout(() => {
                document.querySelector(".menu-burger").classList.toggle("active");
                document.querySelector(".menu").classList.remove("active");
                document.querySelector("html").style.overflowY = "auto";
            }, 500);
        });
    });
}


//TABS PRODUCT

if (document.querySelector(".card-tab") && document.querySelector(".card-tabs__inner")) {
    let productTabs = document.querySelectorAll(".card-tab");
    let productTabsInner = document.querySelectorAll(".card-tabs__inner");

    productTabs.forEach((tab) => {

        tab.addEventListener("click", function (e) {

            let tabIndex = tab.dataset.tab;

            for (let i = 0; i < productTabs.length; i++) {
                productTabs[i].classList.remove('card-tab-active');
            }

            tab.classList.add('card-tab-active');


            productTabsInner.forEach(function (inner, index) {

                if (index == tabIndex) {
                    inner.classList.add("card-tabs__inner--active");
                } else {
                    inner.classList.remove("card-tabs__inner--active");
                }

            });


        });

    });

}


//PLAY VIDEO

document.querySelectorAll(".card-video__wrap").forEach((element) => {
    let play_btn = element.querySelector(".card-video__play");
    let previewVideo = element.querySelector(".card-video__preview");
    let video = element.querySelector("video");
    play_btn.addEventListener('click', function () {
        if (video.paused) {
            if (previewVideo)
                previewVideo.classList.add("fade-out");
            play_btn.classList.add("fade-out");
            video.classList.add("play");
            video.play();
        } else {
            if (previewVideo)
                previewVideo.classList.remove("fade-out");
            play_btn.classList.remove("fade-out");
            video.classList.remove("play");
            video.pause();
        }
    });


    // function stopMedia() {
    //   $(".goods__video__preview").fadeIn();
    //   $(".goods__video_mobile .goods__video__wrap").removeClass("show_video");
    //   video.pause();
    //   video.currentTime = 0;
    //   play_btn.setAttribute('data-play','paused');
    // }
    // video.addEventListener('click', stopMedia);
})


if (document.querySelector(".header__toggle")) {
    document.querySelector(".header__toggle").addEventListener("click", (evt) => {
        document.querySelector(".popup-menu").classList.add("opened");
    });
}

if (document.querySelector(".popup-menu__close")) {
    document.querySelector(".popup-menu__close").addEventListener("click", (evt) => {
        document.querySelector(".popup-menu").classList.remove("opened");
    });
}
//## new
document.addEventListener('DOMContentLoaded', function () {

    //блок палитра на главной
    if (document.querySelectorAll('.home-pallet__card').length && window.innerWidth > 769) {
        let card = Array.from(document.querySelectorAll('.home-pallet__card'));
        window.addEventListener("scroll", function (event) {
            if (document.querySelector('.home-pallet__card.active'))
                document.querySelector('.home-pallet__card.active').classList.remove('active');
        });

        card.forEach(function (e) {
            e.addEventListener("mouseover", showCard);
            e.addEventListener("click", showCard);
            e.addEventListener("mouseout", hiddenCard);
        })

        function showCard() {
            if (document.querySelector('.home-pallet__card.active'))
                document.querySelector('.home-pallet__card.active').classList.remove('active');
            this.classList.add('active');
        }

        function hiddenCard() {
            this.classList.remove('active')
        }
    }

    //блок принципиальные особенности
    /*    if (document.querySelectorAll('.home-prop__card').length && window.innerWidth < 1024) {
            let card = Array.from(document.querySelectorAll('.home-prop__card'));
            window.addEventListener("scroll", function (event) {
                if (document.querySelector('.home-prop__card.active'))
                    document.querySelector('.home-prop__card.active').classList.remove('active');
            });

            card.forEach(function (e) {
                e.addEventListener("click", function () {
                    if (document.querySelector('.home-prop__card.active'))
                        document.querySelector('.home-prop__card.active').classList.remove('active');
                    this.classList.add('active');
                });
            })

        }*/
    //слайдер на странице товара
    var swiper = new Swiper(".slider__small", {
        spaceBetween: 70,
        slidesPerView: 3,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            320: {
                spaceBetween: 20,
            },
            769: {
                spaceBetween: 50,
            },
            912: {
                spaceBetween: 70,
            },

        }


    });
    var swiper2 = new Swiper(".slider__big", {
        slidesPerView: 1,
        spaceBetween: 30,
        thumbs: {
            swiper: swiper,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

//скрол
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    /*
        let cardMobile = Array.from(document.querySelectorAll('.card-tab-mobile'));
        if (cardMobile.length) {
            cardMobile.forEach(function (elem) {
                elem.addEventListener('click', function () {
                    let panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        panel.classList.add('card-tabs__inner--active');
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    }
                })
            })
        }*/
    if (document.querySelectorAll('[data-tab-mobile]').length && window.innerWidth < 912) {

        let tabMobile = Array.from(document.querySelectorAll('[data-tab-mobile]'));
        tabMobile.forEach(function (elem) {
            elem.addEventListener('click', function () {
                let num = elem.dataset.tabMobile,
                    containerArr = Array.from(document.querySelectorAll('[data-tab-container]')),
                    container = document.querySelector(`[data-tab-container="${num}"]`);
                if (elem.classList.contains('card-tab-mobile_active')) {
                    elem.classList.remove('card-tab-mobile_active');
                } else {
                    tabMobile.forEach(function (e) {
                        e.classList.remove('card-tab-mobile_active');
                    });
                    elem.classList.add('card-tab-mobile_active');
                }
                if (container.classList.contains('card-tabs__inner--active')) {
                    container.classList.remove('card-tabs__inner--active');
                } else {
                    containerArr.forEach(function (e) {
                        e.classList.remove('card-tabs__inner--active');
                    });
                    container.classList.add('card-tabs__inner--active');
                }
                //document.querySelector(`[data-tab="${num}"]`).click();

            });
        });
    }
});