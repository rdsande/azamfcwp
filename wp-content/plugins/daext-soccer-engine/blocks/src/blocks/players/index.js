import MultiReactSelect from '../../components/MultiReactSelect';

const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericDateTimePicker from '../../components/GenericDateTimePicker';
import GenericReactSelect from '../../components/GenericReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.startDateOfBirth === 'undefined'){
      this.props.setAttributes({startDateOfBirth: "1900-01-01"});
    }
    if(typeof this.props.attributes.endDateOfBirth === 'undefined'){
      this.props.setAttributes({endDateOfBirth: "2100-01-01"});
    }
    if(typeof this.props.attributes.citizenship === 'undefined'){
      this.props.setAttributes({citizenship: "0"});
    }
    if(typeof this.props.attributes.foot === 'undefined'){
      this.props.setAttributes({foot: "0"});
    }
    if(typeof this.props.attributes.teamId === 'undefined'){
      this.props.setAttributes({teamId: "0"});
    }
    if(typeof this.props.attributes.squadId === 'undefined'){
      this.props.setAttributes({squadId: "0"});
    }
    if(typeof this.props.attributes.playerPositionId === 'undefined'){
      this.props.setAttributes({playerPositionId: "0"});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['player', 'age', 'citizenship', 'height', 'foot', 'current_club', 'ownership', 'contract_expire']});
    }
    if(typeof this.props.attributes.hiddenColumnsBreakpoint1 === 'undefined'){
      this.props.setAttributes({hiddenColumnsBreakpoint1: []});
    }
    if(typeof this.props.attributes.hiddenColumnsBreakpoint2 === 'undefined'){
      this.props.setAttributes({hiddenColumnsBreakpoint2: []});
    }
    if(typeof this.props.attributes.pagination === 'undefined'){
      this.props.setAttributes({pagination: '10'});
    }

  }

  render() {

    const citizenshipData = {
      action: 'dase_get_citizenship_list',
      attributeName: 'citizenship',
      title: __('Citizenship', 'dase'),
    };

    const startDateOfBirthData = {
      title: __('Start Date of Birth', 'dase'),
      date: this.props.attributes.startDateOfBirth,
      attributeName: 'startDateOfBirth'
    };

    const endDateOfBirthData = {
      title: __('End Date of Birth', 'dase'),
      date: this.props.attributes.endDateOfBirth,
      attributeName: 'endDateOfBirth'
    };

    const footData = {
      action: 'dase_get_foot_list',
      attributeName: 'foot',
      title: __('Foot', 'dase'),
    };

    const squadIdData = {
      action: 'dase_get_squad_list',
      attributeName: 'squadId',
      title: __('Squad', 'dase'),
      actionParameters: '&default_label=0'
    };

    const playerPositionIdData = {
      action: 'dase_get_player_position_list',
      attributeName: 'playerPositionId',
      title: __('Player Position', 'dase'),
    };

    const columnsData = {
      action: 'dase_get_columns_players',
      attributeName: 'columns',
      title: __('Columns', 'dase'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'dase_get_columns_players',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'dase'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'dase_get_columns_players',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'dase'),
    };

    const paginationData = {
      action: 'dase_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'dase'),
    };

    return [
      <div className="dase-block-image">{__('Players', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericDateTimePicker data={startDateOfBirthData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endDateOfBirthData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={citizenshipData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={footData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={playerPositionIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={squadIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <MultiReactSelect data={columnsData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <MultiReactSelect data={hiddenColumnsBreakpoint1Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <MultiReactSelect data={hiddenColumnsBreakpoint2Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={paginationData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('dase/players', {
  title: __('Players', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('players', 'dase'),
    __('soccer', 'dase'),
    __('engine', 'dase'),
  ],
  attributes: {
    startDateOfBirth: {
      type: 'string',
    },
    endDateOfBirth: {
      type: 'string',
    },
    citizenship: {
      type: 'string',
    },
    foot: {
      type: 'string',
    },
    playerPositionId: {
      type: 'string',
    },
    squadId: {
      type: 'string',
    },
    columns: {
      type: 'array',
    },
    hiddenColumnsBreakpoint1: {
      type: 'array',
    },
    hiddenColumnsBreakpoint2: {
      type: 'array',
    },
    pagination: {
      type: 'string',
    }
  },

  /**
   * The edit function describes the structure of your block in the context of the editor.
   * This represents what the editor will render when the block is used.
   *
   * The "edit" property must be a valid function.
   *
   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
   */
  edit: BlockEdit,

  /**
   * The save function defines the way in which the different attributes should be combined
   * into the final markup, which is then serialized by Gutenberg into post_content.
   *
   * The "save" property must be specified and must be a valid function.
   *
   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
   */
  save: function() {

    /**
     * This is a dynamic block and the rendering is performed with PHP:
     *
     * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
     */
    return null;

  },

});