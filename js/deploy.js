var nav = {
  init: function () {
    var dropTarget = $('.drop-target'),
      dropdown = $('.dropdown'),
      alert = $('.alert'),
      alertClose = alert.find('.alert-close');

    //PAGE LOAD ANIMATION
    $(window).load(function(){
      content = $('.load-content');

      TweenMax.set(content, { opacity: 0, y: 50 });
      TweenMax.to(content, 2, { opacity: 1, y: 0, delay: 0.2, ease: Expo.easeOut });
    });

    //OPEN & CLOSE DROPDOWN
    dropTarget.click(function (e) {
      var activeTarget = $(this),
        targetDrop = activeTarget.find('.dropdown');

      if (activeTarget.hasClass('active')) {
        //CLOSE
        activeTarget.removeClass('active');
        targetDrop.removeClass('open').hide();
      } else {
        //OPEN
        dropTarget.removeClass('active');
        dropdown.removeClass('open').hide();
        activeTarget.addClass('active');
        targetDrop.addClass('open').show();
      }
    });

    //CLICK OFF DROPDOWN
    $(document).bind('click', function(e) {
      if($(e.target).closest('.drop-target').length === 0) {
        if (dropTarget.hasClass('active')) {
          $('.drop-target.active .dropdown').removeClass('open').hide();
          $('.drop-target.active').removeClass('active');
        }
      }
    });

    //CLOSE ALERT
    alertClose.click(function (e) {
      e.preventDefault();
      TweenMax.to(alert, 0.3, { height: 0, padding: 0, ease: Expo.easeOut });
    });
  }
};

var tables = {
  init: function () {
    var btnFade = $('.btn-fade');

    //FADE OUT TABLE ROW AFTER DOWNLOADING OR CANCELING & REMOVE FROM DOM
    btnFade.on('click', function (e) {
      var currRow = $(this).parent('.t-cell').parent('.t-row');

      if ($(this).hasClass('confirm')) {
        var batchID = currRow.attr('id');
        //OPEN CONFIRM POPUP & ADD BATCH ID TO CONFIRM BUTTON
        $.magnificPopup.open({
          removalDelay: 300,
          mainClass: 'mfp-fade',
          items: {
            src: '#confirm-popup',
            type: 'inline',
          },
          callbacks: {
            open: function() {
              this.content.find('.confirm-fade').attr('data-batch-ref', batchID);
            }
          }
        });
      } else {
        fadeRow(currRow);
      }
    });

    //REMOVE ROW AFTER CONFIRMATION
    $('.confirm-fade').on('click', function (e) {
      var batchRef = $(this).attr('data-batch-ref');
      batchRow = $('#' + batchRef);
      fadeRow(batchRow);
    });

    //FUNCTION TO FADE OUT A ROW
    function fadeRow(currRow) {
      TweenMax.to(currRow, 0.5, { opacity: 0, delay: 0.2 });
      TweenMax.to(currRow, 1, { height: 0, marginBottom: 0, delay: 0.5, ease: Expo.easeOut, onComplete: killRow });
      function killRow() {
        currRow.remove();
      }
    }

  }
};

var forms = {
  init: function () {
    var edit = $('.field-edit').not('.popup-select'),
      save = $('.field-save'),
      popupSelect = $('.popup-select'),
      popupChooser = $('#popupChooser'),
      optionsContainer = $('#optionsContainer'),
      optionsTitle = $('#optionsTitle'),
      optionsList = $('#optionsList'),
      optionsSave = $('#optionsSave'),
      insurance = allInsurance.slice(0),
      ehr = allEHR.slice(0);

    //EDIT FORM FIELDS
    edit.on('click', function (e) {
      e.preventDefault();
      var currEdit = $(this),
        field = currEdit.parent('.field'),
        saveBtn = field.find('.field-save'),
        fieldInput = field.find('.field-hide'),
        fieldHolder = field.find('.field-input');

      field.addClass('active');
      fieldHolder.hide();
      fieldInput.show();
      saveBtn.css({
        display: 'flex'
      })
      currEdit.hide();
      fieldInput.focus();
      fieldInput.val(fieldInput.val());
    });

    //SAVE FORM FIELDS
    save.on('click', function (e) {
      e.preventDefault();
      var currSave = $(this),
        field = currSave.parent('.field'),
        editBtn = field.find('.field-edit'),
        fieldInput = field.find('.field-hide'),
        fieldHolder = field.find('.field-input');

      field.removeClass('active');
      fieldHolder.html(fieldInput.val().replace(/\r\n|\r|\n/g,"<br />")).show();
      fieldInput.hide();
      editBtn.css({
        display: 'flex'
      });
      currSave.hide();
    });

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
      li += '<input id="custom' + fieldName + '" name="' + fieldName + '-custom" type="checkbox" value="">';
      li += '<label for="custom' + fieldName + '">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += 'Other: <input type="text" id="custom' + fieldName + 'Request" class="text-inline" placeholder="Submit ' + fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + ' Name">';
      li += '</label></li>';

      optionsList.append(li);
    }

    //BUILD EACH POPUP ITEM
    function addOptionItem(fieldItem, fieldName, checked) {
      var li = '<li>';
      li += '<input name="' + fieldName + '" type="checkbox" id="' + fieldItem.id + '" value="' + fieldItem.name + '"' + checked + '>';
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
        fieldContainer = currField.parent('.field'),
        fieldName = fieldContainer.prev().attr('for'),
        field = fieldContainer.prev().attr('for');

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
            this.content.find('#optionsSave').attr('data-field', field);
            if(popupChooser.find('.limit-height').outerHeight() >= 500) {
              popupChooser.find('.popup-footer').addClass('scrollable');
            }
          },
          close: function() {
            optionsList.empty();
            popupChooser.find('.popup-footer').removeClass('scrollable');
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

      $('label[for="' + field + '"]').next().find('.field-input').empty().append(row);
    }

    optionsSave.on('click', function () {
      var field = $(this).attr('data-field');

      if(field == 'ehr') {
        fieldArray = ehr;
      } else if('insurance') {
        fieldArray = insurance;
      }

      $('input[name="'+ field + '"]').each(function() {
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

      /*if($('input[id="custom' + field + 'Request"]').val()) {
        $('label[for="' + field + '"]').next().append('<span class="field-input-other">Other</span>');
      }*/

      buildOptionsList(fieldArray, field);
    });
  }
};

var upload = {
  init: function () {
    var uploadIcon =
      '<svg class="ico-upload" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 48"><path d="M54,27.2c-0.4,5-4.3,10.5-11.9,10.5c-3.5,0-5.4,0-5.4,0c-1.3,0-2.3-1-2.3-2.3c0-1.3,1-2.2,2.3-2.2h0c0,0,1.9-0.1,5.3-0.1 c4.8,0,7.1-3.2,7.4-6.3c0.2-3.2-1.8-6.7-6.7-7.4c-0.6-0.1-1.2-0.4-1.6-1c-0.4-0.5-0.5-1.2-0.3-1.8c0.6-2.7,0-4.8-1.8-5.8 C37.4,10,35,10,33.1,12c-0.5,0.5-1.2,0.7-2,0.6c-0.7-0.1-1.3-0.6-1.7-1.2c-3.3-6.3-8.5-6.6-11.9-5c-3.3,1.6-5.9,5.4-3.9,10.3 c0.3,0.6,0.2,1.3,0,1.9c-0.3,0.6-0.8,1-1.4,1.2c-6.9,2.1-6.7,6.7-6.5,8.1c0.4,2.5,2.4,5.1,5.5,5.1l7.2,0.1c1.3,0,2.3,1.1,2.3,2.4 c0,1.3-1,2.4-2.3,2.4h0l-7.2-0.2c-5,0-9.3-3.9-10.1-9.1c-0.6-4.1,1.1-9.5,7.5-12.4c-1.5-6.3,2.1-11.7,6.9-14 c5-2.3,11.9-1.7,16.5,4.7c2.9-1.6,6.3-1.7,9.1-0.1c2.4,1.4,4.6,4.3,4.4,8.6C51.8,17.3,54.3,22.6,54,27.2z"/><path d="M35.6,29.1c0.4,0.5,1,0.7,1.6,0.7c0.6,0,1.2-0.2,1.6-0.7c0.9-0.9,0.9-2.4,0-3.3l-9.8-9.8c-0.4-0.4-1-0.7-1.6-0.7 c-0.6,0-1.2,0.2-1.6,0.7l-9.8,9.8c-0.9,0.9-0.9,2.4,0,3.3c0.9,0.9,2.4,0.9,3.3,0l5.8-5.9l0.1,21.5c0,1.3,1,2.3,2.3,2.3h0 c1.3,0,2.3-1,2.3-2.3l-0.1-21.5L35.6,29.1z"/></svg>',
      messageHTML = uploadIcon,
      submitBtn = $('#submitBtn'),
      filePreviews = $('#uploadPreviews'),
      success = $('#submit-success'),
      countContainer = $('#file-count'),
      btnDisplay,
      fileAppend,
      fileCount = 0,
      color = '';

    //ADD MESSAGING TO DRAG/DROP UPLOAD BOX
    messageHTML += '<span class="text-label"> Drop files here to upload or </span> ';
    messageHTML += '<a class="btn">Select Files</a>';

    //TURN OFF AUTOMATIC DISCOVERY OF DROPZONE
    Dropzone.autoDiscover = false;

    //IF #chartUpload EXISTS THEN MAKE INTO DROPZONE FOR UPLOADING
    if($('#chartUpload').length != 0) {
      $('#chartUpload').dropzone({
        autoProcessQueue: false,
        parallelUploads: 100,
        dictDefaultMessage: messageHTML,
        previewTemplate: $('#chartUploadInner').html(),
        previewsContainer: '#uploadPreviews',
        createImageThumbnails: false,
        init: function() {
          var submitButton = $("#submitBtn"),
            myDropzone = this;

          myDropzone.on("addedfile", function(file) {
            //FIND EXTENSION OF UPLOAD
            var extension = file.name.substr( (file.name.lastIndexOf('.') +1) );

            //COLOR CODE EXTENSIONS USING CSS CLASSES
            if (extension == 'pdf') {
              color = 'red-t';
            } else if (extension == 'jpg' || extension == 'png') {
              color = 'ltBlue-t';
            }

            //PASS THE EXTENSION TO THE FILE ICON
            //done(extension);

            //PASS THE COLOR AND FILE OBJECT AND PROCEED TO SHOW BUTTON FUNCTION
            showButton(color, file.previewElement, extension);
          });

          //IF A FILE IS REMOVED THEN REDUCE THE COUNT BY 2 (SHOW BUTTON FUNCTION WILL ALWAYS ADD 1)
          myDropzone.on("removedfile", function(file) {
            fileCount = fileCount - 2;
            showButton(color);
          });

          submitButton.on("click", function() {
            myDropzone.processQueue();

            if (fileCount < 2) {
              fileAppend = ' file';
            } else {
              fileAppend = ' files';
            }
            countContainer.text(fileCount + fileAppend);

            TweenMax.to(filePreviews, 1, { opacity: 0, onComplete: emptyPreviews });
            TweenMax.to(submitBtn, 1, { opacity: 0 });
            TweenMax.set(success, { opacity: 0, y: 50, display: 'block' });
            TweenMax.to(success, 2, { opacity: 1, y: 0, delay: 1, ease: Expo.easeOut });
            function emptyPreviews () {
              filePreviews.empty();
              fileCount = 0;
            }
          });
          myDropzone.on("complete", function() {
            myDropzone.removeAllFiles();
          });
        }
      });
    }

    function showButton(color, theObject, extension) {
      //ADD 1 TO FILE COUNT
      fileCount = fileCount + 1;

      //USE SINGULAR OR PLURAL OF FILES & SHOW OR HIDE SUBMIT BUTTON
      if (fileCount < 1) {
        fileAppend = ' file';
        btnDisplay = 'none';
      } else if (fileCount < 2) {
        fileAppend = ' file';
        btnDisplay = 'inline-block';
      } else {
        fileAppend = ' files';
        btnDisplay = 'inline-block';
      }

      //ADD COLOR CLASS TO FILE OBJECT
      $(theObject).find('.dz-extension').addClass(color);
      $(theObject).find('.dz-extension').find('span').text(extension);

      //SHOW OR HIDE SUBMIT BUTTON AND ADD COUNT TO BUTTON
      success.css({ opacity: 0 });
      filePreviews.css({ opacity: 1 });
      submitBtn.css({ display: btnDisplay, opacity: 1 }).text('Submit ' + fileCount + fileAppend);
    }

    //SHOW SUCCESS WHEN UPLOAD IS SUBMITTED

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

var specialtiesHandler = {
  init: function () {
    var specialties = allSpecialties.slice(0),
      specialtiesList = $('#specialtiesList'),
      specialtiesCurr = $('#specialtiesCurr'),
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
      li += '<input id="customSpecialty" name="specialties-custom" type="checkbox" value="">';
      li += '<label for="customSpecialty">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += 'Other: <input type="text" id="customSpecialtyRequest" class="text-inline" placeholder="Specialty Name">';
      li += '</label></li>';

      specialtiesList.append(li);
    }

    //BUILD EACH POPUP ITEM
    function addPopupItem(specialty, checked) {
      var li = '<li>';
      li += '<input name="specialties" type="checkbox" id="' + specialty.id + '" value="' + specialty.name + '"' + checked + '>';
      li += '<label for="' + specialty.id + '">';
      li += '<div class="check-control"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"/><circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over" /></svg></div>';
      li += specialty.name;
      li += '</label></li>';

      specialtiesList.append(li);
    }

    //CONSTRUCT LIST WITH ACTIVE SPECIALTIES
    function buildList() {
      specialtiesCurr.find('.t-row').not('.t-heading').remove();

      for(var i = 0; i < specialties.length; i++) {
        //ONLY SHOW ACTIVE SPECIALTIES
        if(specialties[i].active == true) {
          addListItem(specialties[i], specialtiesCurr);
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
            if(showList.find('.limit-height').outerHeight() >= 500) {
              showList.find('.popup-footer').addClass('scrollable');
            }
          },
          close: function() {
            showLoader.attr('style', '');
            showPricing.attr('style', '');
            showList.attr('style', '');
            showList.find('.popup-footer').removeClass('scrollable');
            $('#customSpecialtyRequest').val('');
            $('.custom-info').remove();
            TweenMax.killAll();
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
      $('input[name="specialties"]').each(function() {
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

        if($('input[id="customSpecialtyRequest"]').val()) {
          var customText = $('input[id="customSpecialtyRequest"]').val();
          showPricing.find('.pricing-accept').append('<p class="custom-info"><strong>' + customText + ':</strong> You will be contacted shortly concerning pricing.</p>');
        }

      }

      //SHOW AND ANIMATE LOADER
      TweenMax.to(showList, 0.3, { opacity: 0 });
      TweenMax.set(showLoader, { display: 'block', delay: 0.2 });
      TweenMax.fromTo(progress, 1, { rotation: 0, transformOrigin: '50% 50%'},{ rotation: 360, repeat: 1, ease: Sine.easeInOut, onComplete: showPrices });

      //BUILD APPROVAL LIST AND REMOVE LOADER
      function showPrices() {
        buildApprovalList();

        TweenMax.to(showLoader, 0.5, { opacity: 0 });
        TweenMax.set(showLoader, { display: 'none', delay: 0.5 });
        TweenMax.to(showList, 0.5, { height: 0, delay: 0.5 });
        TweenMax.set(showList, { display: 'none', delay: 1 });

        TweenMax.set(showPricing, { display: 'block', delay: 1 });
        TweenMax.from(showPricing, 0.5, { height: 0, delay: 1 });
        TweenMax.to(showPricing, 0.5, { opacity: 1, delay: 1 });
      }

    });

    //ACCEPT PRICING & SAVE ALL SELECTED SPECIALTIES
    specialtiesSave.on('click', function () {
      $('input[name="specialties"]').each(function() {
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

//START ALL FUNCTIONS
$(function () {
  nav.init();
  tables.init();
  forms.init();
  upload.init();
  popups.init();
  specialtiesHandler.init();
  tooltip.init();
});
