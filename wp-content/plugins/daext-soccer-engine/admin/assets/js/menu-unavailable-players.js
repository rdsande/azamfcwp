(function($) {

  'use strict';

  $(document).ready(function() {

    //jQuery UI Datepicker ---------------------------------------------------------------------------------------------

    /**
     * Localize the jQuery UI Datepicker.
     */
    switch(window.objectL10n.locale){
      case 'it_IT':
        $.datepicker.setDefaults(window.daseJqueryUiDatepickerLocalizationIt);
        break;
    }

    /**
     * Initialize the date picker and set the format of the alternative field and the selector of the alternative field.
     *
     * Ref: http://api.jqueryui.com/datepicker/
     */
    let dpBaseConfig = {
      changeMonth: true,
      changeYear: true,
      yearRange: '1800:2100',
      altFormat: "yy-mm-dd",
    };
    $( "#start-date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#start-date-alt-field"}
    });
    $( "#end-date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#end-date-alt-field"}
    });

    /**
     * Do not allow to enter data in the input field associated with the date picker
     */
    $('.hasDatepicker').keypress(function(event){
      event.preventDefault();
    });

    /**
     * Do not allow to enter data in the input field associated with the date picker
     */
    $('.hasDatepicker').keypress(function(event){
      event.preventDefault();
    });

    /**
     * Set the date of the date picker based on the value available in the alternative field #date-alt-field.
     *
     * Note that before applying this change the format of the date available in teh alternative field #date-alt-field
     * should be changed.
     *
     */
    if($('#start-date').length){
      let dateOfBirth = $.datepicker.parseDate( "yy-mm-dd", $('#start-date-alt-field').val() );
      $( "#start-date" ).datepicker( "setDate", dateOfBirth );
    }
    if($('#end-date').length){
      let dateOfDeath = $.datepicker.parseDate( "yy-mm-dd", $('#end-date-alt-field').val() );
      $( "#end-date" ).datepicker( "setDate", dateOfDeath );
    }

  });

}(window.jQuery));