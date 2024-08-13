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
    $( "#assignment-date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#assignment-date-alt-field"}
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
    if($('#assignment-date').length){
      let assignmentDate = $.datepicker.parseDate( "yy-mm-dd", $('#assignment-date-alt-field').val() );
      $( "#assignment-date" ).datepicker( "setDate", assignmentDate );
    }

  });

}(window.jQuery));