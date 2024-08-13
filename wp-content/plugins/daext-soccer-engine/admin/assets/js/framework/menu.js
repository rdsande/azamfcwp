(function($) {

  'use strict';

  $(document).ready(function() {

    'use strict';

    if($('#cancel').length){
      $('#cancel').click(function() {
        event.preventDefault();
        window.location.replace($('#cancel').attr('data-url'));
      });
    }

  });

}(window.jQuery));