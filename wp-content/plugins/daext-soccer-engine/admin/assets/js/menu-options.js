jQuery(document).ready(function($) {

  //document -> ready - EVENT LISTENER
  initialize_spectrum();

  /*
  Initialize the spectrum color picker
   */
  function initialize_spectrum(){

    $(".spectrum-input").spectrum({

      //options --------------------------------------------------------------------------------------------------
      color: 'rgba(0,117,165,1)',
      showAlpha: true,
      cancelText: objectL10n.cancelText,
      chooseText: objectL10n.chooseText,
      preferredFormat: 'rgb',

      //events ---------------------------------------------------------------------------------------------------
      change: function(color) {

        //get the name of the element involved
        var element_name = $(this).attr('id').substr(0, ( $(this).attr('id').length - 9 ) )

        //prepare the values of the color components
        var red = parseInt(color._r, 10);
        var green = parseInt(color._g, 10);
        var blue = parseInt(color._b, 10);
        var alpha = Math.round( color._a * 10 ) / 10;

        //generate the color in the rgba format
        var rgba_color = 'rgba(' + red + ',' + green + ',' + blue + ',' + alpha + ')';

        //if the related field is not empty add a comma and the color, otherwise add only the color
        if( $("#" + element_name).val().trim().length > 0 ){
          $("#" + element_name).val( $("#" + element_name).val().trim() + ',' + rgba_color );
        }else{
          $("#" + element_name).val( rgba_color );
        }

      }

    });

    //.spectrum-toggle -> click - EVENT LISTENER (a click on the colored circle that activates the color picker modal window)
    $(".spectrum-toggle").click(function() {

      //get the name of the element involved
      var element_name = $(this).attr('id').substr(0, ( $(this).attr('id').length - 16 ) )

      //toggle the colorpicker
      $("#" + element_name + "-spectrum").spectrum("toggle");

      //get the container of the color picker
      var container = $("#" + element_name + "-spectrum").spectrum("container");

      //add a data attribute to the color picker used during the resize event to identify the element involved
      $(container).attr('data-element-involved', element_name);

      //position the container of the color picker on the right of the toggle
      var toggle_position = $("#" + element_name + "-spectrum-toggle").offset();

      if( $(document).width() - 227 > toggle_position.left ){

        //if there is enough space on the right of the color picker show the color picker on the right of the toggle
        container.css('left', toggle_position.left + 28);

      }else{

        //otherwise show the color picker on the left of the toogle
        container.css('left', toggle_position.left - 202);

      }
      container.css('top', toggle_position.top + -2);

      //save the element name in a global variable, so that will be used during the resize event
      window.dase_element_name = element_name;

      return false;

    });

    //window -> resize - EVENT LISTENER
    jQuery(window).resize(function(){

      //get the element from a global variable
      var element_name = window.dase_element_name;

      //disable the color picker
      var container = $("#" + element_name + "-spectrum").spectrum("disable");

    });

    //window -> load - EVENT LISTENER (page completely loaded)
    $(window).bind("load", function() {

      $('.spectrum-toggle, .spectrum-input').css('visibility', 'visible');

    });

  }

});