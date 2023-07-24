import "./index.scss";

/**
 * Import modules
 */

import Inputmask from "inputmask/dist/inputmask.min.js";
import { Fancybox } from "@fancyapps/ui";
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
    onClick: () => {},
  }).showToast();
};

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
if (
  document.querySelector("input[type='text'], input[type='email'], textarea")
) {
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

if(document.querySelector(".file-delete")) {
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
      // let fileAttach;
      // if(form.querySelector('input[type=file]')) {
      //   fileAttach = form.querySelector('input[type=file]');
      // }
      // if (fileAttach) {
      //   fileAttach.value = '';
      //   fileAttach.closest('.attachment').querySelector('.file__name').innetText = '';
      //   fileAttach.closest('.attachment').querySelector('.file__info').classList.remove('is-loaded');
      // }

      if (phone.length[17] === "_" || phone.length === 0) {
        document.querySelector("input[name='phone']").classList.add("is-error");
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
        mna100("email", data, (r) => {
          if (r.status === 1) {
  
            if (form.querySelector("#file_presentation")) {
              let link = form.querySelector("#file_presentation").value;
              var link_form = document.createElement('a');
    
              link_form.setAttribute('href',link);
              link_form.setAttribute('download','Презентация');
              onload=link_form.click();
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

            if (typeof ym == "function") {
              ym("XXXXXXXX", "reachGoal", yaGoal);
              console.log("Цель достигнута: " + yaGoal);
            }
            if (typeof gtag == "function") {
              //gtag("event", "form_lead", {"event_category": "lead", "event_action": "zayavka"});
            }
          } else {
            toast("Внимание!", "Ошибка ! " + r.message, "WARNING");

            Fancybox.close();

          }
        });
      }
    });
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

      if (title) popup.querySelector(".modal__title span").innerHTML = title;
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
        if(!(wrap_select.classList.contains("filled"))) {
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
              
              if(files) {
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
const observer = lozad();
observer.observe();


/**
 * Mobile menu
 */
if (document.querySelector(".header__humburger-btn")) {
  document.querySelector(".header__humburger-btn").addEventListener("click", (evt) => {
    let buttonClasslist = evt.currentTarget.classList;

    buttonClasslist.toggle("active");

    if (buttonClasslist.contains("active")) {
      document.querySelector(".header__mobile").classList.add("active");
      document.querySelector("body").style.overflow = "hidden";
      document.querySelector("html").style.overflow = "hidden";
    } else {
      document.querySelector(".header__mobile").classList.remove("active");
      document.querySelector("body").style.overflow = "auto";
      document.querySelector("html").style.overflow = "auto";
    }
  });
}
if (document.querySelector(".header__mobile .menu-item-has-children")) {
  document
    .querySelectorAll(".header__mobile .menu-item-has-children")
    .forEach((el) => {
      let row = document.createElement("div");
      row.classList.add("menu-arrow");
      el.querySelector("a").after(row);
      
  
      row.addEventListener("click", (evt) => {
        el.classList.toggle("active");
      });
    });
}



/**
 * Ymaps
 */
if (document.querySelector("#contacts-map")) {
  const maps_observer = lozad(".map-lazy", {
    loaded: (el) => {
      const coords = el.dataset.coords.split(", "),
        apiKey = el.dataset.key,
        icon = el.dataset.icon,
        label = el.dataset.label,
        clientWidth = document.body.clientWidth;

      let center = coords;
      // if (clientWidth > 1199) {
      //   center = [Number(coords[0]), Number(coords[1]) - 0.003];
      // } else if (clientWidth < 992) {
      //   center = [Number(coords[0]) - 0.0001, Number(coords[1])];
      // }

      ymaps
        .load("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=" + apiKey)
        .then((maps) => {
          const myMap = new maps.Map("contacts-map", {
              center: center,
              zoom: 17,
              controls: ["fullscreenControl", "zoomControl"],
            }),
            myPlacemark = new maps.Placemark(
              coords,
              {
                hintContent: label,
                balloonContent: label,
              },
              {
                iconLayout: "default#image",
                iconImageHref: icon,
                iconImageSize: [100, 100],
                iconImageOffset: [-50, -115],
              }
            );
          myMap.behaviors.disable("scrollZoom");
          myMap.geoObjects.add(myPlacemark);
        });
    },
  });
  maps_observer.observe();
}


if (document.querySelector("#company-map")) {
  let countriesMap,
    objectManager,
    countriesData = [],
    icon = document.querySelector("#company-map").dataset.iconMap;
  
  document.querySelectorAll(".company-map__coord").forEach((city) => {
    countriesData.push({
      type: "FeatureCollection",
      features: [
        {
          type: "Feature",
          id: city.dataset.id,
          geometry: {
            type: "Point",
            coordinates: city.dataset.coords.split(","),
          },
          options: {
            iconLayout: "default#image",
            iconImageSize: [32, 38],
            iconImageHref: icon,
          },
        },
      ],
    });
  });
  
  // инициализация карты
  ymaps
    .load(
      "https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=db6a9a83-461e-485a-8185-ac08e42c46e1"
    )
    .then((maps) => {
      countriesMap = new maps.Map("company-map", {
        center: [51.660781, 39.200296],
        zoom: 5,
        controls: ["fullscreenControl", "zoomControl"],
      });
      countriesMap.behaviors.disable("scrollZoom");
      
      objectManager = new maps.ObjectManager({
        clusterize: true,
        gridSize: 64,
      });
      objectManager.clusters.options.set(
        "preset",
        "islands#invertedRedClusterIcons"
      );
      countriesMap.geoObjects.add(objectManager);
      
      countriesData.forEach((city) => objectManager.add(city));
    })
    .catch((error) => console.log("Failed to load Yandex Maps", error));
}




if (document.querySelector(".swiper.catalog-video__slider")) {
  var videoSwiper = new Swiper(".catalog-video__slider", {
    navigation: {
      nextEl: ".catalog-video__pagination-next",
      prevEl: ".catalog-video__pagination-prev",
    },
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
      el: '.catalog-video__timeline',
      type: 'progressbar'
    },
  });
  
  
  // videoSwiper.on('slideChange', function (e) {
  //
  //   let currVideo = videoCollections[videoSwiper.activeIndex].querySelector("video");
  //   currVideo.play();
  // });
  
 
  
  
}





/**
 * ANIMATION
 */


document.addEventListener("DOMContentLoaded", function() {

  //HEADER ANIMATION
  
  function headerLoadingAnimate() {
    if (document.querySelector(".header-logotype")) {
      document.querySelector(".header-logotype").classList.add("fade-down");
    }
    if (document.querySelector(".header-smoke")) {
      document.querySelector(".header-smoke").classList.add("fade-in-down");
    }
    if (document.querySelector(".menu-burger-animate")) {
      document.querySelector(".menu-burger-animate").classList.add("fade-in-left");
    }
    if (document.querySelector(".panel-logo-animate")) {
      document.querySelector(".panel-logo-animate").classList.add("fade-in-right");
    }
    if(document.querySelector(".panel-mail-animate")) {
      document.querySelector(".panel-mail-animate").classList.add("fade-in-right");
    }
    if(document.querySelector(".panel-phone-animate")) {
      document.querySelector(".panel-phone-animate").classList.add("fade-in-right");
    }
    if(document.querySelector(".panel-social-tg")) {
      document.querySelector(".panel-social-tg").classList.add("fade-in-right");
    }
    if(document.querySelector(".panel-social-call")) {
      document.querySelector(".panel-social-call").classList.add("fade-in-right");
    }
    if (document.querySelector(".panel-line")) {
      document.querySelector(".panel-bar--right .panel-line").classList.add("animate-line");
      document.querySelector(".panel-bar--left .panel-line").classList.add("animate-line");
    }
    if (document.querySelector(".panel-call")) {
      document.querySelector(".panel-bar--right .panel-call").classList.add("fade-in-up");
      document.querySelector(".panel-bar--left .panel-call").classList.add("fade-in-up");
    }
    if(document.querySelector(".header-video-wrap")) {
      document.querySelector(".header-video-wrap").classList.add("animate-video-card");
    }
    if(document.querySelector(".header-video__logos")) {
      document.querySelector(".header-video__logos").classList.add("fade-in");
    }
    const main_title = gsap.timeline();
  
    main_title.fromTo(".header-title__top", {y: '50%', opacity: 0, duration: 1}, {y: 0, delay: 3, opacity: 1, duration: 1});
    main_title.fromTo(".header-title__bottom", {y: '50%', opacity: 0, duration: 1}, {y: 0, delay: 3, opacity: 1, duration: 1}, "-=3");
  }
  
  let teamVideo = document.getElementById("team-video");
  function playClip(media) {
    media.play();
  }
  function stopClip(media) {
    media.pause();
  }
  
  setTimeout(function() {
    headerLoadingAnimate();
  }, 2000);
  
  setTimeout(function() {
    playClip(teamVideo);
    document.querySelector("html").style.overflowY = "scroll";
  }, 2000);
  setTimeout(function() {
    stopClip(teamVideo);
  }, 10500);
  

  
  var scroll = document.querySelector(".section-header-scroll");
  
  let wheelBool = true;
  
  
  const sections = document.querySelectorAll('.refrigerator-slide');
  const wrapIndex = gsap.utils.wrap(0, sections.length);
  let curIndex = 0;
  let timeout;
  let newScroll = true;
  let transition = gsap.to(sections[0], {autoAlpha: 1});
  let commonScroll = true;
  

  
  let refri = document.querySelector("#refrigerator-section");
  let scrollOffsetDown = refri.offsetTop;
  let scrollOffsetUp = refri.offsetTop + refri.offsetHeight;
  
  
  let count = 0;
  
  
  // document.addEventListener('wheel', changeSection);
  
  function changeSection(e) {
    
    let windowCenter = (window.innerHeight / 2) + window.scrollY;
    
    if (windowCenter >= scrollOffsetDown && windowCenter <= scrollOffsetUp) {
      
      
  
      const dir = e.wheelDelta < 0 ? 1 : -1;
  
      const newIndex = wrapIndex(curIndex + dir);
  
      if(timeout) {
        clearTimeout(timeout);
      }
      timeout = setTimeout(() => {
        newScroll = true
      }, 800);
  
      if(!newScroll)
        return false;
  
      if(!transition.isActive()) {
  
        
        
        // count++;
        // console.log(count);
        // if (count == 4) {
        //   document.querySelector("body").style.overflowY = "scroll";
        //   commonScroll = true;
        //   newScroll = false;
        //   count = 0;
        //   if (dir == 1) {
        //     document.querySelector("#catalog").scrollIntoView({block: "start", inline: "center", behavior: "smooth"});
        //     console.log("down");
        //   } else {
        //     document.querySelector(".section-form").scrollIntoView({block: "center", inline: "center", behavior: "smooth"});
        //     console.log("up");
        //   }
        // }
    
        transition = gsap.timeline({onComplete: () => {
            curIndex = newIndex;
    
            if(commonScroll) {
              console.log("центр");
              window.scrollTo({
                top: (refri.offsetTop + (refri.offsetHeight / 2))  - window.innerHeight / 2,
                behavior: "smooth"
              });
              document.querySelector("body").style.overflowY = "hidden";
              commonScroll = false;
            }
    
            count++;
            console.log(count);
            if (count == 4) {
              document.querySelector("body").style.overflowY = "scroll";
              commonScroll = true;
              newScroll = false;
              count = 0;
              if (dir == 1) {
                document.querySelector("#catalog").scrollIntoView({block: "start", inline: "center", behavior: "smooth"});
                console.log("down");
              } else {
                document.querySelector(".section-form").scrollIntoView({block: "center", inline: "center", behavior: "smooth"});
                console.log("up");
              }
            }
            
          }});
  
        sections[curIndex].classList.remove("refrigerator-slide--active");
        sections[newIndex].classList.add("refrigerator-slide--active");
        transition.to(sections[curIndex], {autoAlpha: 0});
        
        transition.to(sections[newIndex], {autoAlpha: 1});
  
        if (dir == 1) {
          if(sections[0].classList.contains("refrigerator-slide--active")) {
            sections[0].classList.add("refrigerator-slide--first");
            sections[0].classList.remove("refrigerator-slide--second");
            sections[1].classList.add("refrigerator-slide--second");
            sections[1].classList.remove("refrigerator-slide--third");
            sections[2].classList.add("refrigerator-slide--third");
            sections[2].classList.remove("refrigerator-slide--first");
          }
          if(sections[1].classList.contains("refrigerator-slide--active")) {
            sections[1].classList.remove("refrigerator-slide--second");
            sections[1].classList.add("refrigerator-slide--first");
            sections[0].classList.add("refrigerator-slide--third");
            sections[0].classList.remove("refrigerator-slide--first");
            sections[2].classList.add("refrigerator-slide--second");
            sections[2].classList.remove("refrigerator-slide--third");
          }
          if(sections[2].classList.contains("refrigerator-slide--active")) {
            sections[2].classList.add("refrigerator-slide--first");
            sections[2].classList.remove("refrigerator-slide--second");
            sections[0].classList.remove("refrigerator-slide--third");
            sections[0].classList.add("refrigerator-slide--second");
            sections[1].classList.remove("refrigerator-slide--first");
            sections[1].classList.add("refrigerator-slide--third");
          }
        } else {
          if(sections[0].classList.contains("refrigerator-slide--active")) {
            sections[0].classList.add("refrigerator-slide--first");
            sections[0].classList.remove("refrigerator-slide--third");
            sections[1].classList.add("refrigerator-slide--second");
            sections[1].classList.remove("refrigerator-slide--first");
            sections[2].classList.add("refrigerator-slide--third");
            sections[2].classList.remove("refrigerator-slide--second");
          }
          if(sections[1].classList.contains("refrigerator-slide--active")) {
            sections[1].classList.add("refrigerator-slide--first");
            sections[1].classList.remove("refrigerator-slide--third");
            sections[0].classList.add("refrigerator-slide--third");
            sections[0].classList.remove("refrigerator-slide--second");
            sections[2].classList.add("refrigerator-slide--second");
            sections[2].classList.remove("refrigerator-slide--first");
          }
          if(sections[2].classList.contains("refrigerator-slide--active")) {
            sections[2].classList.add("refrigerator-slide--first");
            sections[2].classList.remove("refrigerator-slide--third");
            sections[0].classList.remove("refrigerator-slide--first");
            sections[0].classList.add("refrigerator-slide--second");
            sections[1].classList.remove("refrigerator-slide--second");
            sections[1].classList.add("refrigerator-slide--third");
          }
        }
        
        
      }
      
    }
    
    
  }
  
  
  var showScrollTop = () =>{
    const currentScrollPosition = window.pageYOffset;
    const advantagesOffsetTop = document.getElementById("advantages-section").offsetTop;
    const elementHeight = document.getElementById("advantages-section").offsetHeight
    const offsetTranslate = 600;
    
    if ((currentScrollPosition > (advantagesOffsetTop - offsetTranslate)) && (currentScrollPosition < (advantagesOffsetTop + elementHeight/2))){
      var scrollY = window.scrollY - (advantagesOffsetTop - offsetTranslate);
      scroll.style.transform = "translate3d("+scrollY+"px, 0px, 0px)";
    }
    
    // let refri = document.querySelector("#refrigerator-section");
    // let windowCenter = (window.innerHeight / 2) + window.scrollY;
    // let scrollOffset = refri.offsetTop + (refri.offsetHeight / 2);
    
    
    // if(windowCenter >= scrollOffset && windowCenter <= (scrollOffset + refri.offsetHeight / 2)) {
    //   if (wheelBool) {
    //     document.querySelector("body").style.overflowY = "hidden";
    //     // wheelRefri(refri);
    //
    //     wheelBool = false;
    //   }
    //
    // }
    
  }
  
  // window.addEventListener('scroll', showScrollTop);
  
  
  // function func() {
  //   setInterval(function () {
  //     document.querySelectorAll(".advantages-card").forEach(item => {
  //       if (item.classList.contains("advantages-card--first-card")) {
  //         item.classList.remove("advantages-card--first-card");
  //         item.classList.add("advantages-card--fade-left");
  //         setTimeout(function () {
  //           item.classList.add("advantages-card--four-card");
  //           item.classList.remove("advantages-card--fade-left");
  //         }, 1000);
  //       } else if (item.classList.contains("advantages-card--second-card")) {
  //         item.classList.remove("advantages-card--second-card");
  //         item.classList.add("advantages-card--first-card");
  //       } else if (item.classList.contains("advantages-card--third-card")) {
  //         item.classList.remove("advantages-card--third-card");
  //         item.classList.add("advantages-card--second-card");
  //       } else if (item.classList.contains("advantages-card--four-card")) {
  //         item.classList.remove("advantages-card--four-card");
  //         item.classList.add("advantages-card--third-card");
  //       }
  //
  //     });
  //   }, 2000);
  // }
  
  
  const letters_logotype = gsap.timeline();
  const title_scroll_advantages = gsap.timeline();
  const title_scroll_catalog = gsap.timeline();
  const title_scroll_team = gsap.timeline();
  const title_scroll_contacts = gsap.timeline();
  const t2 = gsap.timeline();
  const t_form_image = gsap.timeline();
  const t_r = gsap.timeline();
  const team_image = gsap.timeline();
  
  
  letters_logotype.to("#logotype-letter-1", {x: "-100%", duration: 1});
  letters_logotype.to("#team-video", {y: "-100%", opacity: 0, duration: 1}, "-=1");
  letters_logotype.to(".header-video .header-title", {y: "-100%", opacity: 0, duration: 1}, "-=1");
  letters_logotype.to("#logotype-letter-6", {x: "100%", duration: 1}, "-=1");
  letters_logotype.to("#logotype-letter-2", {x: "-100%", duration: 1}, "-=1");
  letters_logotype.to("#logotype-letter-5", {x: "100%", duration: 1}, "-=1");
  letters_logotype.to("#logotype-letter-3", {x: "-100%", duration: 1}, "-=1");
  letters_logotype.to("#logotype-letter-4", {x: "100%", duration: 1}, "-=1");
  
  
  
  title_scroll_advantages.to("#scroll-title-1", {x: '-70%', duration: 1});
  title_scroll_catalog.to("#scroll-title-2", {x: '-70%', duration: 1});
  title_scroll_team.to("#scroll-title-3", {x: '-70%', duration: 1});
  title_scroll_contacts.to("#scroll-title-4", {x: '-70%', duration: 1});
  
  t2.to(".advantages-card--four-card", {opacity: 1, duration: 4});
  t2.to(".advantages-card--four-card", {x: -10, duration: 10});
  t2.from(".advantages-card--four-card", {x: -300, scale: 1, filter: 'brightness(1)', duration: 1});
  t2.to(".advantages-card--third-card", {x: "-500", duration: 1});
  t2.to(".advantages-card--third-card", {opacity: 1, duration: 4});
  t2.to(".advantages-card--third-card", {x: -10, duration: 10});
  t2.from(".advantages-card--third-card", {x: -300, scale: 1, filter: 'brightness(1)', duration: 1});
  t2.to(".advantages-card--second-card", {x: "-500", duration: 1});
  t2.to(".advantages-card--second-card", {opacity: 1, duration: 4});
  t2.to(".advantages-card--second-card", {x: -10, duration: 10});
  t2.from(".advantages-card--second-card", {x: -300, scale: 1, filter: 'brightness(1)', duration: 1});
  t2.to(".advantages-card--first-card", {opacity: 1, duration: 4});
  t2.to(".advantages-card--first-card", {x: -10, duration: 10});
  t2.from(".advantages-card--first-card", {x: 0, scale: 1, filter: 'brightness(1)', duration: 1});
  
  
  t_form_image.from(".get-catalog__image", {x: 300, opacity: 0, duration: 2});
  t_form_image.from(".get-catalog__title--top", {x: -100, opacity: 0, duration: 2,}, "-=2");
  t_form_image.from(".get-catalog__title--bottom", {x: -100, opacity: 0, duration: 1,}, "-=1");
  t_form_image.from(".form-animate-width", {x: gsap.utils.wrap([-10, -100, -200, -300, -400]), width: 0, opacity: 0, delay: .5, stagger: 0.1}, "-=2");
  t_form_image.from(".form__policy-animate", {y: 100, opacity: 0}, "-=1");
  t_form_image.from(".section-form", { backgroundImage: "linear-gradient(to bottom, #273065 0%, #273065 85%)"}, "-=1")
  
  
  
  
  t_r.to(".refrigerator-slide--first .refrigerator-slide__image", {scale: 1.5, duration: 10});
  t_r.to(".refrigerator-slide--first .refrigerator-slide__smoke", {opacity: 1, duration: 10}, "-=10");
  t_r.to(".refrigerator-slide--first", {filter: 'brightness(0.2) blur(10px)', scale: 0.6, duration: 5});
  t_r.to(".refrigerator-slide--first .refrigerator-slide__name", {color: "#9AD0FD", duration: 2});
  t_r.to(".refrigerator-slide--first .refrigerator-slide__btn", {opacity: 0, duration: 2}, "-=2");
  
  t_r.to(".refrigerator-slide--first .refrigerator-slide__image", {scale: 1, duration: 5});
  t_r.to(".refrigerator-slide--first", {x: "200%", duration: 2});
  t_r.to(".refrigerator-slide--second", {x: "0%", duration: 1}, "-=2");
  t_r.to(".refrigerator-slide--third", {x: "100%", duration: 2}, "-=2");
  t_r.to(".refrigerator-slide--first", {scale: 1, zIndex: 1, filter: 'brightness(1) blur(0px)', duration: 2});
  
  
  t_r.to(".refrigerator-slide--second .refrigerator-slide__name", {color: "#005CA9", duration: 2});
  t_r.to(".refrigerator-slide--second .refrigerator-slide__btn", {opacity: 1, duration: 2}, "-=2");
  t_r.to(".refrigerator-slide--second .refrigerator-slide__image", {scale: 1.5, duration: 10});
  t_r.to(".refrigerator-slide--second .refrigerator-slide__smoke", {opacity: 1, duration: 10}, "-=10");
  t_r.to(".refrigerator-slide--second", {filter: 'brightness(0.2) blur(10px)', scale: 0.6, duration: 5});
  t_r.to(".refrigerator-slide--second .refrigerator-slide__name", {color: "#9AD0FD", duration: 2});
  t_r.to(".refrigerator-slide--second .refrigerator-slide__btn", {opacity: 0, duration: 2}, "-=2");
  t_r.to(".refrigerator-slide--second .refrigerator-slide__image", {scale: 1, duration: 5});
  t_r.to(".refrigerator-slide--second", {x: "200%", duration: 2});
  t_r.to(".refrigerator-slide--third", {x: "0%", duration: 1}, "-=2");
  t_r.to(".refrigerator-slide--first", {x: "100%", duration: 1}, "-=2");
  t_r.to(".refrigerator-slide--second", {scale: 1, filter: 'brightness(1) blur(0px)', duration: 2});
  
  
  
  t_r.to(".refrigerator-slide--third .refrigerator-slide__name", {color: "#005CA9", duration: 2});
  t_r.to(".refrigerator-slide--third .refrigerator-slide__btn", {opacity: 1, duration: 2}, "-=2");
  t_r.to(".refrigerator-slide--third .refrigerator-slide__image", {scale: 1.5, duration: 10});
  t_r.to(".refrigerator-slide--third .refrigerator-slide__smoke", {opacity: 1, duration: 10}, "-=10");
  
  
  
  team_image.to(".team-member__image", {y: 0, duration: 3});
  team_image.to(".team-member__smoke", {height: "100%", duration: 3});
  
  
  
  
  
  //SCENES
  
  //LOGOTYLE LETTERS
  ScrollTrigger.create({
    animation: letters_logotype,
    trigger: '#advantages-section',
    start: 'top-=130%',
    end: "top-=30%",
    scrub: true,
    ease: "power2",
    //markers: true,
  });
  
  //TITLE SCROLLS
  ScrollTrigger.create({
    animation: title_scroll_advantages,
    trigger: '#advantages-section',
    start: 'top-=20%',
    end: "3600",
    scrub: true,
    ease: "power2",
    //markers: true,
  });
  ScrollTrigger.create({
    animation: title_scroll_catalog,
    trigger: '#catalog',
    start: 'top-=40%',
    end: "bottom+=40%",
    scrub: true,
    ease: "power2",
    // markers: true,
  });
  ScrollTrigger.create({
    animation: title_scroll_team,
    trigger: '#team',
    start: 'top-=40%',
    end: "bottom+=40%",
    scrub: true,
    ease: "power2",
    // markers: true,
  });
  ScrollTrigger.create({
    animation: title_scroll_contacts,
    trigger: '#contacts',
    start: 'top-=40%',
    end: "10%",
    scrub: true,
    ease: "power2",
    // markers: true,
  });
  
  
  ScrollTrigger.create({
    animation: t2,
    trigger: '#advantages-section',
    start: '-10%',
    end: "2400",
    scrub: true,
    ease: "power2",
    pin: true,
    //markers: true,
    fastScrollEnd: false,
    preventOverlaps: false,
  });
  
  
  ScrollTrigger.create({
    animation: t_form_image,
    trigger: '#form-section',
    start: '-100%',
    end: "0",
    scrub: true,
    // markers: true,
    fastScrollEnd: false,
    preventOverlaps: false,
  });
  
  
  ScrollTrigger.create({
    animation: t_r,
    trigger: '#refrigerator-section',
    start: '-10%',
    end: "3000",
    scrub: true,
    //markers: true,
    pin: true,
    fastScrollEnd: false,
    preventOverlaps: false,
    onUpdate(self) {
      if (self.direction === -1 && self.progress > 0.5) {
        self.scroll(self.start);
      }
      console.log(self.progress);
    }
  });
  
  ScrollTrigger.create({
    animation: team_image,
    trigger: '#team',
    start: '-20%',
    end: "0%",
    //markers: true,
    scrub: true,
  });
  
  let catalogRows = document.querySelectorAll(".catalog-list__item");
  const t_catalog = gsap.timeline();
  
  t_catalog.to(catalogRows[0], {opacity: 1, x: 40,});
  t_catalog.to(catalogRows[0].querySelector(".catalog-list__name"), {fontSize: "40px"});
  t_catalog.to(catalogRows[0].querySelector(".catalog-list__number"), {opacity: 1});
  
  t_catalog.to(catalogRows[1], {opacity: "1"});
  t_catalog.to(catalogRows[2], {opacity: "0.3"});
  t_catalog.to(catalogRows[3], {opacity: "0.2"});
  t_catalog.to(catalogRows[4], {opacity: "0.1"});
  t_catalog.to(catalogRows[5], {opacity: "0.05"});
  t_catalog.to(catalogRows[5], {opacity: "0.01"});
  
  
  t_catalog.to(catalogRows[0], {opacity: 0.4, x: 0});
  t_catalog.to(catalogRows[0].querySelector(".catalog-list__name"), {fontSize: "32px"});
  t_catalog.to(catalogRows[0].querySelector(".catalog-list__number"), {opacity: 0});
  
  t_catalog.to(catalogRows[1], {opacity: 1, x: 40});
  t_catalog.to(catalogRows[1].querySelector(".catalog-list__name"), {fontSize: "40px"});
  t_catalog.to(catalogRows[1].querySelector(".catalog-list__number"), {opacity: 1});
  
  t_catalog.to(catalogRows[3], {opacity: "0.3"});
  t_catalog.to(catalogRows[4], {opacity: "0.2"});
  t_catalog.to(catalogRows[5], {opacity: "0.1"});
  t_catalog.to(catalogRows[5], {opacity: "0.05"});
  
  t_catalog.to(".catalog-list-scroll", {y: "-100%", ease:'slow', duration: 10,});
  
  ScrollTrigger.create({
    animation: t_catalog,
    trigger: '#catalog',
    start: '-10%',
    end: "1500",
    //markers: true,
    scrub: true,
    pin: true,
  });
  
  const t_company = gsap.timeline();
  
  t_company.from(".company-main h2", {opacity: 0, x: "-100%", y: "-50%", rotate: 15, duration: 1,});
  t_company.from(".company-main p", {opacity: 0, x: "-100%", rotate: -15, duration: 1,}, "-=1");
  t_company.from(".company-main__logos img", {opacity: 0, y: "50%", stagger: 1, rotate: 360, duration: 1});
  
  t_company.from(".company-description__text p", {x: "100%", opacity: 0, stagger: 2, duration: 1})
  
  
  
  ScrollTrigger.create({
    animation: t_company,
    trigger: '#company',
    start: '-60%  top',
    end: "bottom-=50%",
    markers: true,
    scrub: true,
    pin: true,
  });
  
  
  const t_contacts = gsap.timeline();
  
  t_contacts.to( ".contacts-wrap", { className: '+=contacts-wrap contacts-wrap-active' });
  
  ScrollTrigger.create({
    animation: t_contacts,
    trigger: '#contacts',
    start: '-20%',
    end: '0%',
    markers: true,
    scrub: 0,
  });
  

  
  
  

//
//
//
//   let easeInOutQuint = t => t<.5 ? 16*t*t*t*t*t : 1+16*(--t)*t*t*t*t; // Easing function found at https://gist.github.com/gre/1650294
//
// // With this attempt I tried to make the scroll by mouse wheel look smooth
//   let delay = ms => new Promise(res => setTimeout(res, ms));
//   let dy = 0;
//   window.addEventListener("wheel", async e => {
//
//     // Prevent the default way to scroll the page
//     e.preventDefault();
//
//     dy += e.deltaY;
//     let _dy = dy; // Store the value of "dy"
//     await delay(150); // Wait for .15s
//
//     // If the value hasn't changed during the delay, then scroll to "start + dy"
//     if (_dy === dy) {
//       let start = window.scrollY || window.pageYOffset;
//       customScrollTo(start + dy, 600, easeInOutQuint);
//       dy = 0;
//     }
//   }, { passive: false });
//
//   function customScrollTo(to, duration, easingFunction) {
//     let start = window.scrollY || window.pageYOffset;
//
//     let time = Date.now();
//     let timeElapsed = 0;
//
//     let speed = (to - start) / duration;
//
//     (function move() {
//
//       if (timeElapsed > duration) {
//         return;
//       }
//
//       timeElapsed = Date.now() - time;
//
//       // Get the displacement of "y"
//       let dy = speed * timeElapsed;
//       let y = start + dy;
//
//       // Map "y" into a range from 0 to 1
//       let _y = (y - start) / (to - start);
//       // Fit "_y" into a curve given by "easingFunction"
//       _y = easingFunction(_y);
//       // Expand "_y" into the original range
//       y = start + (to - start) * _y;
//
//       window.scrollTo(0, y);
//       window.requestAnimationFrame(move);
//     })();
//   }



  
});








