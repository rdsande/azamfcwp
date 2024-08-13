(function($) {

  'use strict';

  $(document).ready(function() {

    // let matchId = parseInt($('#match_id').val(), 10);
    // updateTeamField(matchId);
    //
    // $('#match_id').on('change', function() {
    //
    //   let matchId = parseInt($(this).val(), 10);
    //   updateTeamField(matchId);
    //
    // });
    //
    // $('#team_slot').on('change', function() {
    //
    //   let teamSlot = parseInt($(this).val(), 10);
    //   updatePlayerField(parseInt($('#match_id').val()), teamSlot);
    //
    // });

    showHideFields($('#data').val());

    $('#data').on('change', function() {

      showHideFields($(this).val());

      // let data = parseInt($(this).val(), 10);
      // let affectedFields = $('.tr_player_id, .tr_player_id_substitution_out, .tr_player_id_substitution_in, .tr_staff_id, .tr_part, .tr_time, .tr_additional_time, .tr_description');
      //
      // if(data === 0){
      //
      //   affectedFields.hide();
      //
      // }else{
      //
      //   affectedFields.show();
      //
      // }

    });

  });

  function showHideFields(data){

    data = parseInt(data, 10);
    let affectedFields = $('.tr_player_id, .tr_player_id_substitution_out, .tr_player_id_substitution_in, .tr_staff_id, .tr_part, .tr_time, .tr_additional_time, .tr_description');

    if(data === 0){

      affectedFields.hide();

    }else{

      affectedFields.show();

    }


    $('table.daext-form > tbody > tr:visible:last > th, table.daext-form > tbody > tr:visible:last > td').css('border-bottom', 'none');
    $('table.daext-form > tbody > tr:visible:not(:last) > th, table.daext-form > tbody > tr:visible:not(:last) > td').css('border-bottom', '1px solid #e3e3e3');

  }

  // function updateTeamField(matchId){
  //
  //   let eventId = 0;
  //   if(parseInt($('input[name="update_id"]').val(), 10) > 0){
  //     eventId = parseInt($('input[name="update_id"]').val(), 10);
  //   }
  //
  //   //prepare ajax request
  //   var data = {
  //     'action': 'dase_get_teams_of_event',
  //     'security': window.daseNonce,
  //     'match_id': matchId,
  //     'event_id': eventId
  //   };
  //
  //   //send ajax request
  //   $.post(window.daseAjaxUrl, data, function(jsonData) {
  //
  //     let data_a = JSON.parse(jsonData);
  //
  //     //Generate the select options
  //     let selectOptions = '<option value="' + data_a.team_slot_1 + '">' + data_a.team_slot_1_name + '</option>' +
  //         '<option value="' + data_a.team_slot_2 + '">' + data_a.team_slot_2_name + '</option>';
  //
  //     //Update the Team Field
  //     $('#team_slot').empty();
  //     $('#team_slot').append(selectOptions);
  //
  //     if(data_a.hasOwnProperty('selected_team_slot')){
  //       $('#team_slot').val(data_a.selected_team_slot);
  //     }
  //
  //     $('#team_slot').trigger("chosen:updated");
  //
  //     updatePlayerField(matchId, parseInt($('#team_slot').val()));
  //
  //   });
  //
  // }

  // function updatePlayerField(matchId, teamSlot){
  //
  //   let eventId = 0;
  //   if($('input[name=update_id]').length > 0){
  //     eventId = $('input[name=update_id]').val();
  //   }
  //
  //   //prepare ajax request
  //   var data = {
  //     'action': 'dase_get_players_of_match',
  //     'security': window.daseNonce,
  //     'match_id': matchId,
  //     'team_slot': teamSlot,
  //     'event_id': eventId
  //   };
  //
  //   //send ajax request
  //   $.post(window.daseAjaxUrl, data, function(jsonData) {
  //
  //     let data = JSON.parse(jsonData);
  //
  //     //Generate the select options
  //     let selectOptions = '';
  //     $.each(data.players_list, function(index, value) {
  //       selectOptions += '<option value="' + value.player_id + '">' + value.player_name + '</option>';
  //     });
  //
  //     //Update the Player Fields
  //     $('#player_id, #player_id_substitution_out, #player_id_substitution_in').empty();
  //     $('#player_id, #player_id_substitution_out, #player_id_substitution_in').append(selectOptions);
  //
  //     //If we are in edit mode select the proper player
  //     $('#player_id').val(parseInt(data.selected_player_id, 10));
  //     $('#player_id_substitution_out').val(parseInt(data.selected_player_id_substitution_out, 10));
  //     $('#player_id_substitution_in').val(parseInt(data.selected_player_id_substitution_in, 10));
  //
  //     if($("#player_id").chosen().val() === null){
  //       $('#player_id').val(0);
  //     }
  //
  //     if($("#player_id_substitution_out").chosen().val() === null){
  //       $('#player_id_substitution_out').val(0);
  //     }
  //
  //     if($("#player_id_substitution_in").chosen().val() === null){
  //       $('#player_id_substitution_in').val(0);
  //     }
  //
  //     //Update chosen
  //     $('#player_id, #player_id_substitution_out, #player_id_substitution_in').trigger("chosen:updated");
  //
  //   });
  //
  // }

}(window.jQuery));