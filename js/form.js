//COLORS
var white = 'rgba(255,255,255,1)',
  whiteTrans = 'rgba(142,233,230,1)',
  trans = 'rgba(255,255,255,0)',
  shadowColor = 'rgba(0,0,0,0.05)',
  green = 'rgba(67,218,212,1)',
  shadow = '4px 9px 6px 0 ' + shadowColor;
  noShadow = '4px 9px 6px 0 ' + trans;

var centerScene = {
  init: function () {
    var scene = $('#slider'),
      cardHeight = $('.card-wrap.active .inner-card').outerHeight(),
      cardWidth = $('.card-wrap.active .inner-card').outerWidth(),
      winHeight = $('#contain').outerHeight(),
      winHeightSpace = winHeight / 2,
      winWidth = $('#contain').width() / 2,
      top = winHeightSpace - (cardHeight / 2),
      left = winWidth - (cardWidth / 2);

    TweenMax.set(scene, { height: cardHeight, top: top, left: left });
  }
};

var fitScene = {
  init: function () {
    var scene = $('#slider'),
      contain = $('#contain'),
      windowHeight = $(window).height(),
      sliderHeight = $('.slider-top').outerHeight() + $('#slider').outerHeight() + $('.slider-bottom').outerHeight();

    console.log(sliderHeight);
    console.log(windowHeight);

    if(windowHeight < sliderHeight) {
      scene.css({
        top: 0,
        left: 0,
        marginTop: $('.slider-top').outerHeight(),
        marginBottom: $('.slider-bottom').outerHeight() + 32
      });
      contain.addClass('mobile');
    }

  }
};

var slider = {
  init: function () {
    var body = $('body'),
      form = $('#signUp'),
      scene = $('#slider'),
      slideWrap = $('.card-wrap'),
      slides = $('.card'),
      slideBGs = $('.card-bg'),
      slideNos = $('.card-no'),
      title = $('.title'),
      slideInners = $('.inner-card'),
      nextBtn = $('.btn-next'),

      totalSlides = slideWrap.size(),
      middleSlide = slideWrap.eq(Math.floor(totalSlides / 2)),
      middleIndex = middleSlide.index() - 1,

      activeWrap = $('.card-wrap.active'),
      activeCard = activeWrap.find('.card'),
      activeBG = activeCard.find('.card-bg'),
      activeTitle = activeCard.find('.card-title'),
      activeNo = activeCard.find('.card-no'),
      activeInner = activeCard.find('.inner-card'),
      inactiveCards = activeWrap.siblings(),

      first = true,
      slideWait = false;

    function startSlider() {
      //SEPARATE TOP AND BOTTOM SLIDES
      slideWrap.slice(0, middleIndex).wrapAll('<div class="slider-top"/>');
      slideWrap.slice(middleIndex, totalSlides).wrapAll('<div class="slider-bottom"/>');

      //SETUP MINIMIZED VERSIONS
      TweenMax.set(slideInners, { opacity: 0, height: 0, padding: 0 });
      TweenMax.set(slideNos, { color: white, left: '12%' });
      TweenMax.set(slideBGs, { boxShadow: noShadow, scaleX: 0.8, transformOrigin: 'top 50%' });
      TweenMax.set(slideWrap, { height: 0 });
      TweenMax.set(activeInner, { height: 'auto', opacity: 1, padding: '4em 3em 2.5em 3em' });

      //GET FIRST SLIDE READY
      TweenMax.set(activeBG, { background: white, scaleX: 1, boxShadow: shadow });
      TweenMax.set(activeNo, { color: green, left: 26 });
      TweenMax.set(activeTitle, { opacity: 0 });
      TweenMax.set(activeWrap, { height: 0 });
      TweenMax.set(activeCard, { height: 'auto', x: '150%' });

      //SLIDE IN FIRST SLIDE
      TweenMax.to(activeCard, 1.2, { x: '0%', ease: Expo.easeOut });
    }

    startSlider();

    //CLICK TO GO TO NEXT SLIDE
    nextBtn.on('click', function (e) {
      e.preventDefault();
      var currSlide = $(this).closest('.card-wrap'),
        currInputs = currSlide.find('input[type="text"]').not('.optional'),
        currAdd = currSlide.find('.validate'),
        nextSlide = currSlide.next(),
        index = nextSlide.index(),
        back = false
        proceed = true;

      currInputs.each(function() {
        if ($(this).val() == '') {
          if(!$(this).hasClass('required')) {
            $(this).addClass('required');
            var id = $(this).attr('id');
            addRequired($(this), id);
          }
        } else {
          if($(this).hasClass('required')) {
            $(this).removeClass('required');
            var id = $(this).attr('id');
            killRequired(id);
          }
        }
      });

      function addRequired(element, id) {
        var elementHeight = element.outerHeight(),
          elementWidth = element.outerWidth(),
          elementY = element.offset().top,
          elementX = element.offset().left,
          elementTop = elementY + elementHeight + 6,
          elementLeft = elementX + (elementWidth / 2) - 45;

        var tooltipper = '<ins id="tooltip' + id + '" class="dark-tooltip dark small north animated fadeIn red" style="opacity: 0.9; left: ' + elementLeft + 'px; top: ' + elementTop + 'px; display: block;"><div>Required</div><div class="tip"></div></ins>';

        body.append(tooltipper);
      }

      function killRequired(id) {
        $('#tooltip' + id).remove();
      }


      if(currInputs.hasClass('required')) {
        proceed = false;
      }

      if(currAdd.length != 0) {
        if(currAdd.text() == '') {
          var currBtn = currAdd.next('p');
          proceed = false;
          var id = currAdd.attr('id');
          addRequired(currBtn, id);
        } else {
          proceed = true;
          var id = currAdd.attr('id');
          killRequired(id);
        }
      }

      if(proceed) {
        //MOVE TO BOTTOM HALF AFTER TOP HALF IS DONE
        if(!nextSlide.length) {
          nextSlide = scene.find('.slider-bottom').find('.card-wrap').first();
        }

        //IF NEXT BUTTON HAS BEEN CLICKED THEN MIMIC INACTIVE CLICK
        if($(this).hasClass('clicked')) {
          back = true;
        }

        //MARK BUTTON AS CLICKED
        $(this).addClass('clicked');

        goTo(nextSlide, back);
      }
    });

    form.submit(function(e) {
      var user = $('#user'),
        pw = $('#password'),
        pwConf = $('#passwordConfirmation');

      if(pw.val() != '') {
        if(pw.val() == pwConf.val()) {
          if(user.val() != '') {
            return;
          } else {
            addRequired(true, false);
          }
        } else {
          addRequired(false, true);
        }
      } else {
        addRequired(false, true);
      }

      function addRequired(validPW, validUser) {
        var element;

        if(!validPW) {
          element = pwConf;
          message = 'Passwords Must Match';
        } else if(!validUser) {
          element = user;
          message = 'Must Enter Username';
        }
        var elementHeight = element.outerHeight(),
          elementWidth = element.outerWidth(),
          elementY = element.offset().top,
          elementX = element.offset().left,
          elementTop = elementY + elementHeight + 6,
          elementLeft = elementX + (elementWidth / 2) - 100;

        var tooltipper = '<ins class="dark-tooltip dark small north animated fadeIn red" style="opacity: 0.9; left: ' + elementLeft + 'px; top: ' + elementTop + 'px; display: block;"><div>' + message + '</div><div class="tip"></div></ins>';

        body.append(tooltipper);
      }

      function killRequired() {
        $('.dark-tooltip').remove();
      }

      e.preventDefault();
    });

    //CLICK INACTIVE SLIDE
    body.on('click', '.clickable', function() {
      var currClick = $(this),
        currPosition = currClick.parent('div'),
        currSiblings = currPosition.find('.card-wrap'),
        index = currClick.index();

      $('.dark-tooltip').remove();

      goTo(currSiblings.eq(index), true);
    });

    //GO TO NEXT SLIDE
    function goTo(nextSlide, back) {

      //WAIT FOR FUNCTION TO COMPLETE BEFORE PROCEEDING
      if (slideWait) {
        return;
      } else {
        slideWait = true;
      }

      var index = nextSlide.index(),
        totalSlides = slideWrap.size(),
        middleSlide = slideWrap.eq(Math.floor(totalSlides / 2)),
        activeSlide = slideWrap.filter('.active'),
        minSlides = slideWrap.filter('.show').not('active'),
        totalMinSlides = minSlides.size(),
        tl = new TimelineLite();

      tl.timeScale(1).pause();

      //REMOVE ACTIVE FORM ALL SLIDES, MAKE OLD ACTIVE SLIDE CLICKABLE, MAKE NEXT SLIDE ACTIVE
      tl.call(function() {
        slideWrap.removeClass('active');
        activeSlide.addClass('clickable');
        nextSlide.removeClass('clickable').addClass('active show');
      }, 0);

      if(first) {
        //ANIMATE THE TITLE OUT ON FIRST SLIDE
        tl.to(title, 0.6, { y: -100, opacity: 0, ease: Power4.easeOut });
        tl.set(title, { display: 'none' });
      }

      //ANIMATE THE ACTIVE SLIDE TO A MINIMIZED SLIDE
      activeSlide.each(function() {
        var currWrap = $(this),
          showIndex = currWrap.index(),
          midForm = (slideWrap.size() / 2),
          currSlide = currWrap.find('.card'),
          currSlideBG = currSlide.find('.card-bg'),
          currSlideInner = currSlide.find('.inner-card'),
          currNo = currSlide.find('.card-no'),
          currTitle = currSlide.find('.card-title');

        tl.to(currSlideInner, 0.1, { height: 0, opacity: 0, padding: 0 }, 0);
        tl.to(currNo, 0.1, { color: white, left: '12%' }, 0);
        tl.to(currTitle, 0.1, { opacity: 1 }, 0);
        tl.to(currWrap, 1, { height: 68, ease: Expo.easeOut }, 0);
        tl.to(currSlide, 0.5, { height: 56, y: 0, ease: Expo.easeOut }, 0);
        tl.to(currSlideBG, 0.5, { background: whiteTrans, scaleX: 0.8, boxShadow: noShadow, ease: Expo.easeOut }, 0);
      });

      //ANIMATE IN NEXT SLIDE
      nextSlide.each(function() {
        var currWrap = $(this),
          showIndex = currWrap.index(),
          midForm = (slideWrap.size() / 2),
          currPosition = currWrap.parent('div'),
          currSlide = currWrap.find('.card'),
          currSlideInner = currSlide.find('.inner-card'),
          currSlideBG = currSlide.find('.card-bg'),
          currNo = currSlide.find('.card-no'),
          currTitle = currSlide.find('.card-title'),
          sceneHeight = currSlide.find('.inner-card').outerHeight(),

          innerHeight = 'auto',
          innerOpacity = 1,
          innerPadding = '4em 3em 2.5em 3em',
          noColor = green,
          noPos = 26,
          titleOpacity = 0,
          wrapHeight = 0,
          bgColor = white,
          bgScale = 1,
          bgShadow = shadow,
          slideHeight = 'auto',
          slideY = 0;

        if(back) {
          //IF INACTIVE SLIDE WAS CLICKED
          tl.to(currNo, 0.1, { color: noColor, left: noPos }, 0);
          tl.to(currTitle, 0.1, { opacity: titleOpacity }, 0);
          tl.to(currWrap, 0.3, { height: wrapHeight }, 0);
          tl.to(currSlideBG, 0.3, { background: bgColor, scaleX: bgScale, boxShadow: bgShadow }, 0);
          tl.to(currSlide, 0.3, { height: slideHeight, y: slideY }, 0);
          tl.to(currSlideInner, 0.1, { height: innerHeight, opacity: innerOpacity, padding: innerPadding, onComplete: displayNav }, 0);
        } else {
          //IF NEXT BUTTON WAS CLICKED
          tl.set(currNo, { color: noColor, left: noPos }, 0);
          tl.set(currTitle, { opacity: titleOpacity }, 0);
          tl.set(currWrap, { height: wrapHeight }, 0);
          tl.set(currSlideBG, { background: bgColor, scaleX: bgScale, boxShadow: bgShadow }, 0);
          tl.set(currSlide, { height: slideHeight, y: slideY, x: '150%', opacity: 0 }, 0);
          tl.set(currSlideInner, { height: innerHeight, opacity: innerOpacity, padding: innerPadding, onComplete: displayNext }, 0);
        }

        if(currWrap.hasClass('loading')) {
          var showList = $('#showList'),
          showLoader = $('#showLoader'),
          showPricing = $('#showPricing'),
          progress = $('.loader-progress');

          //SHOW AND ANIMATE LOADER
          TweenMax.set(showLoader, { display: 'block', delay: 0.2 });
          TweenMax.set(showPricing, { opacity: 0 });
          TweenMax.fromTo(progress, 1, { rotation: 0, transformOrigin: '50% 50%'},{ rotation: 360, repeat: 1, ease: Sine.easeInOut, onComplete: showPrices });

          //BUILD APPROVAL LIST AND REMOVE LOADER
          function showPrices() {
            TweenMax.to(showLoader, 0.5, { opacity: 0 });
            TweenMax.set(showLoader, { display: 'none', delay: 0.5 });

            TweenMax.set(showPricing, { display: 'block', delay: 1 });
            TweenMax.from(showPricing, 0.5, { height: 0, delay: 1 });
            TweenMax.to(showPricing, 0.5, { opacity: 1, delay: 1 });
          }
        }

        //SLIDE IN THE NEXT SLIDE WHEN NEXT BUTTON PRESSED
        function displayNext() {
          if(currPosition.hasClass('slider-bottom')) {
            $('.slider-bottom').addClass('active');

            var resizeHeight = currSlideInner.outerHeight(),
              multiplier = showIndex,
              newTop = -(resizeHeight) - (68 * multiplier) - 12;

            TweenMax.to(scene, 0.3, { height: resizeHeight, ease: Expo.easeOut });
            TweenMax.set(currSlide, { height: 'auto', y: newTop, x: '150%', opacity: 0 });
          } else {
            $('.slider-bottom').removeClass('active');
          }

          TweenMax.to(currSlide, 1.2, { x: '0%', opacity: 1, ease: Expo.easeOut, delay: 0.3 });
        }

        //MOVE CLICKED SLIDE TO MIDDLE
        function displayNav() {
          var slidesShowing = currPosition.find('.show').size(),
            multiplier = slidesShowing - showIndex,
            newTop = (68 * multiplier) - 68,
            resizeHeight = currSlideInner.outerHeight();

          if(currPosition.hasClass('slider-bottom')) {
            multiplier = showIndex;
            newTop = -(resizeHeight) - (68 * multiplier) - 12;
          }

          TweenMax.to(scene, 0.3, { height: resizeHeight, ease: Expo.easeOut });
          TweenMax.to(currSlide, 0.3, { y: newTop, ease: Expo.easeOut });
        }

      });

      //READY TO PLAY
      tl.call(function() {
        slideWait = false;
        first = false;
        fitScene.init();
      });

      //START ANIMATION SEQUENCE
      tl.play();
    }
  }
};

var forms = {
  init: function () {
    //FORM INPUTS
    var form = $('#signUp'),
      formInputs = form.find('input'),
      userName = 'userName',
      userEmail = 'userEmail',
      userPractice = 'userPractice',
      userNameVal = '',
      userEmailVal = '',
      userPracticeVal = '';

    formInputs.each(function(index) {
      var inputID = $(this).attr('id');
      $(this).change(function() {
        switch(true) {
          case (inputID == userName):
            userNameVal = $(this).val();
            break;
          case (inputID == userEmail):
            userEmailVal = $(this).val();
            break;
          case (inputID == userPractice):
            userPracticeVal = $(this).val();
            break;
        }

        if(userPracticeVal) {
          $('.client-name').empty().text(userPracticeVal);
        } else {
          $('.client-name').empty().text('Your Practice');
        }

        if(userEmailVal) {
          $('#user').val(userEmailVal);
        } else {
          $('#user').val('');
        }

      });
    });

    var popupSelect = $('.popup-select'),
      popupChooser = $('#popupChooser'),
      optionsContainer = $('#optionsContainer'),
      optionsTitle = $('#optionsTitle'),
      optionsList = $('#optionsList'),
      optionsSave = $('#optionsSave'),
      insurance = allInsurance.slice(0),
      ehr = allEHR.slice(0);

    //CONSTRUCT POPUP WITH ALL OPTIONS
    function buildOptions(field, fieldName) {
      optionsList.empty();
      optionsTitle.empty();

      optionsTitle.text(fieldName);

      for(var i = 0; i < field.length; i++) {
        var checked = '',
          current = 'checked="checked"';

        //ADD CHECKED IF ACTIVE
        if(field[i].active == true) {
          checked = current;
        }

        addOptionItem(field[i], fieldName, checked);
      }

      //ADD OTHER ITEM
      var li = '<li>';
      li += '<input id="custom' + fieldName + '" name="user' + fieldName + 'Custom" type="checkbox" value="Other">';
      li += '<label for="custom' + fieldName + '">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += 'Other: <input type="text" id="user' + fieldName + 'Custom" name="user' + fieldName + 'Custom" class="text-inline optional" placeholder="Submit ' + fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + ' Name">';
      li += '</label></li>';

      optionsList.append(li);
    }

    //BUILD EACH POPUP ITEM
    function addOptionItem(fieldItem, fieldName, checked) {
      var li = '<li>';
      li += '<input name="user' + fieldName + '" type="checkbox" id="' + fieldItem.id + '" value="' + fieldItem.name + '"' + checked + '>';
      li += '<label for="' + fieldItem.id + '">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += fieldItem.name;
      li += '</label></li>';

      optionsList.append(li);
    }

    //POPUP FORMS
    popupSelect.on('click', function (e) {
      e.preventDefault();

      var currField = $(this),
        fieldName = currField.attr('data-select'),
        field = currField.attr('data-select');

      if(field == 'ehr') {
        fieldArray = ehr;
      } else if('insurance') {
        fieldArray = insurance;
      }

      buildOptions(fieldArray, fieldName);

      $.magnificPopup.open({
        removalDelay: 300,
        mainClass: 'mfp-fade',
        items: {
          src: '#popupChooser',
          type: 'inline',
        },
        callbacks: {
          open: function() {
            $('.dark-tooltip').remove();
            this.content.find('#optionsSave').attr('data-field', field);
            if(popupChooser.find('.limit-height').outerHeight() >= 500) {
              popupChooser.find('.popup-footer').addClass('scrollable');
            }
          },
          close: function() {
            optionsList.empty();
            popupChooser.find('.popup-footer').removeClass('scrollable');
            TweenMax.killAll();

            var eachP = $('#ehrList');
            TweenMax.staggerTo(eachP, 0.5, { opacity: 1, y: 0, ease: Expo.easeOut }, 0.2);
          }
        }
      });

    });

    function buildOptionsList(fieldArray, field) {

      //OUTPUT SELECTIONS SEPARATED BY COMMAS
      var row = fieldArray.map(function(e, index) {
        if(e.active) {
          return e.name;
        }
      })
      .filter(function(e) {
        return e != undefined;
      })
      .join(', ');

      $('#' + field + 'List').empty().append(row);

      var scene = $('#slider'),
        resizeHeight = $('.card-wrap.active').find('.inner-card').outerHeight(),
        pushUp = $('.card-wrap.active').find('.card'),
        pushUpHeight = pushUp.find('.validate').outerHeight() + 20,
        eachP = $('#ehrList');

      TweenMax.set(eachP, { opacity: 0, y: 30 });
      TweenMax.to(pushUp, 0.3, { y: '-=' + pushUpHeight, ease: Expo.easeOut });
      TweenMax.to(scene, 0.3, { height: resizeHeight, ease: Expo.easeOut });
    }

    optionsSave.on('click', function () {
      var field = $(this).attr('data-field');

      if(field == 'ehr') {
        fieldArray = ehr;
      } else if('insurance') {
        fieldArray = insurance;
      }

      $('input[name="user'+ field + '"]').each(function() {
        updateID = $(this).attr('id');
        if($(this).is(':checked')) {
          for(var i = 0; i < fieldArray.length; i++) {
            if (fieldArray[i].id == updateID) {
              fieldArray[i].active = true;
            }
          }
        } else {
          for(var i = 0; i < fieldArray.length; i++) {
            if (fieldArray[i].id == updateID) {
              fieldArray[i].active = false;
            }
          }
        }
      });

      buildOptionsList(fieldArray, field);
    });
  }
};

var specialtiesHandler = {
  init: function () {
    var specialties = allSpecialties.slice(0),
      specialtiesList = $('#specialtiesList'),
      specialtiesCurr = $('#specialtiesCurr'),
      specialtiesEdit = $('#specialtiesEdit'),
      specialtiesOpen = $('#specialtiesOpen'),
      specialtiesSave = $('#specialtiesSave'),
      specialtiesPricing = $('#specialtiesPricing'),
      pricingApproval = $('#pricingApproval'),
      showList = $('#showList'),
      showLoader = $('#showLoader'),
      showPricing = $('#showPricing');

    //ALPHABETIZE SPECIALTIES LIST
    specialties.sort(function(a,b) {
      var x = a.name.toLowerCase();
      var y = b.name.toLowerCase();
      return x < y ? -1 : x > y ? 1 : 0;
    });

    //CONSTRUCT POPUP WITH ALL SPECIALTIES
    function buildPopup() {
      specialtiesList.empty();

      for(var i = 0; i < specialties.length; i++) {
        var checked = '',
          current = 'checked="checked"';

        //ADD CHECKED IF ACTIVE
        if(specialties[i].active == true) {
          checked = current;
        }

        addPopupItem(specialties[i], checked);
      }

      //ADD OTHER ITEM
      var li = '<li>';
      li += '<input id="customSpecialty" name="userSpecialties" type="checkbox" value="Other">';
      li += '<label for="customSpecialty">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += 'Other: <input type="text" name="userSpecialtiesCustom" id="userSpecialtiesCustom" class="text-inline optional" placeholder="Specialty Name">';
      li += '</label></li>';

      specialtiesList.append(li);
    }

    //BUILD EACH POPUP ITEM
    function addPopupItem(specialty, checked) {
      var li = '<li>';
      li += '<input name="userSpecialties" type="checkbox" id="' + specialty.id + '" value="' + specialty.name + '"' + checked + '>';
      li += '<label for="' + specialty.id + '">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += specialty.name;
      li += '</label></li>';

      specialtiesList.append(li);
    }

    //CONSTRUCT LIST WITH ACTIVE SPECIALTIES
    function buildList() {
      specialtiesCurr.find('.t-row').not('.t-heading').remove();
      specialtiesEdit.find('p').remove();

      for(var i = 0; i < specialties.length; i++) {
        //ONLY SHOW ACTIVE SPECIALTIES
        if(specialties[i].active == true) {
          addListItem(specialties[i], specialtiesCurr);
          addListEdit(specialties[i], specialtiesEdit);
        }
      }
    }

    //BUILD EACH ACTIVE LIST ITEM
    function addListItem(specialty, table) {
      var row = '<div class="t-row"><div>';
      row += specialty.name;
      row += '</div><div>';
      row += specialty.emPrice;
      row += '</div><div>';
      row += specialty.procedurePrice;
      row += '</div></div>';

      table.append(row);
    }

    function addListEdit(specialty, list) {
      var row = '<p>';
      row += specialty.name;
      row += '</p>';

      list.append(row);

      var scene = $('#slider'),
        resizeHeight = $('.card-wrap.active').find('.inner-card').outerHeight(),
        eachP = $('#specialtiesEdit').find('p');

      TweenMax.set(eachP, { opacity: 0, y: 30 });
      TweenMax.to(scene, 0.3, { height: resizeHeight, ease: Expo.easeOut });
    }

    //POPULATE INITIAL SPECIALTY LIST
    buildList();

    //OPEN SPECIALTY POPUP
    specialtiesOpen.on('click', function (e) {
      e.preventDefault();

      //ALWAYS RESET SPECIALTY POPUP ON OPEN
      buildPopup();

      $.magnificPopup.open({
        removalDelay: 300,
        mainClass: 'mfp-fade',
        items: {
          src: '#chooseSpecialties',
          type: 'inline',
        },
        callbacks: {
          open: function() {
            $('.dark-tooltip').remove();
            if(showList.find('.limit-height').outerHeight() >= 500) {
              showList.find('.popup-footer').addClass('scrollable');
            }
          },
          close: function() {
            showLoader.attr('style', '');
            showPricing.attr('style', '');
            showList.attr('style', '');
            showList.find('.popup-footer').removeClass('scrollable');
            $('#userSpecialtiesCustom').val('');
            $('.custom-info').remove();
            TweenMax.killAll();

            var eachP = $('#specialtiesEdit').find('p');
            TweenMax.staggerTo(eachP, 0.5, { opacity: 1, y: 0, ease: Expo.easeOut }, 0.2);
            centerScene.init();
          }
        }
      });
    });

    //SHOW LOADER & GET SPECIALTY PRICING LIST
    specialtiesPricing.on('click', function () {
      var progress = $('.loader-progress'),
        approvalSpecialties = [];

      //CREATE DUMMY ARRAY FOR SPECIALTY APPROVAL
      for (var i = 0, len = specialties.length; i < len; i++) {
        approvalSpecialties[i] = {}; // empty object to hold properties added below
        for (var prop in specialties[i]) {
          approvalSpecialties[i][prop] = specialties[i][prop]; // copy properties from arObj to ar2
        }
      }

      //MARK SPECIALTIES AS ACTIVE OR NOT
      $('input[name="userSpecialties"]').each(function() {
        updateID = $(this).attr('id');
        if($(this).is(':checked')) {
          for(var i = 0; i < approvalSpecialties.length; i++) {
            if (approvalSpecialties[i].id == updateID) {
              approvalSpecialties[i].active = true;
            }
          }
        } else {
          for(var i = 0; i < approvalSpecialties.length; i++) {
            if (approvalSpecialties[i].id == updateID) {
              approvalSpecialties[i].active = false;
            }
          }
        }
      });

      //CONSTRUCT LIST FOR PRICING APPORVAL
      function buildApprovalList() {
        pricingApproval.find('.t-row').not('.t-heading').remove();

        for(var i = 0; i < approvalSpecialties.length; i++) {
          //ONLY SHOW ACTIVE SPECIALTIES
          if(approvalSpecialties[i].active == true) {
            addListItem(approvalSpecialties[i], pricingApproval);
          }
        }

        if($('input[id="userSpecialtiesCustom"]').val()) {
          var customText = $('input[id="userSpecialtiesCustom"]').val();
          showPricing.find('.pricing-accept').append('<p class="custom-info"><strong>' + customText + ':</strong> You will be contacted shortly concerning pricing.</p>');
        }

      }

    });

    //ACCEPT PRICING & SAVE ALL SELECTED SPECIALTIES
    specialtiesSave.on('click', function () {
      $('input[name="userSpecialties"]').each(function() {
        updateID = $(this).attr('id');
        if($(this).is(':checked')) {
          for(var i = 0; i < specialties.length; i++) {
            if (specialties[i].id == updateID) {
              specialties[i].active = true;
            }
          }
        } else {
          for(var i = 0; i < specialties.length; i++) {
            if (specialties[i].id == updateID) {
              specialties[i].active = false;
            }
          }
        }
      });

      buildList();
    });
  }
};

var tooltip = {
  init: function () {
    //ADD TOOLTIPS USING DARKTOOLTIP PLUGIN
    $(".tooltip").darkTooltip({
      animation: 'fadeIn',
      size: 'small',
      gravity: 'south'
    });
  }
};

var popups = {
  init: function () {
    //START INLINE POPUP WITH MAGNIFIC PLUGIN
    $('.popup-link').magnificPopup({
      type:'inline',
      removalDelay: 300,
      mainClass: 'mfp-fade',
      showCloseBtn: false
    });
  }
};

var resizeId;

//START ALL FUNCTIONS
$(function () {
  slider.init();
  centerScene.init();
  forms.init();
  specialtiesHandler.init();
  tooltip.init();
  popups.init();
});

function onResize() {
  centerScene.init();
  fitScene.init();
}

$(window).resize(function(){
  clearTimeout(resizeId);
  resizeId = setTimeout(onResize, 100);
});
