//Get the registerBlockType() function used for the registration of the block
const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericDateTimePicker from '../../components/GenericDateTimePicker';
import GenericReactSelect from '../../components/GenericReactSelect';
import MultiReactSelect from '../../components/MultiReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.teamId === 'undefined'){
      this.props.setAttributes({teamId: '0'});
    }
    if(typeof this.props.attributes.rankingTypeId === 'undefined'){
      this.props.setAttributes({rankingTypeId: '0'});
    }
    if(typeof this.props.attributes.startDate === 'undefined'){
      this.props.setAttributes({startDate: '1900-01-01'});
    }
    if(typeof this.props.attributes.endDate === 'undefined'){
      this.props.setAttributes({endDate: '2100-01-01'});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['team', 'ranking_type', 'date', 'value']});
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

    const teamIdData = {
      action: 'dase_get_team_list',
      attributeName: 'teamId',
      title: __('Team', 'dase'),
    };

    const rankingTypeIdDate = {
      action: 'dase_get_ranking_type_list',
      attributeName: 'rankingTypeId',
      title: __('Ranking Type', 'dase'),
    };

    const startDateData = {
      title: __('Start Date', 'dase'),
      date: this.props.attributes.startDate,
      attributeName: 'startDate'
    };

    const endDateData = {
      title: __('End Date', 'dase'),
      date: this.props.attributes.endDate,
      attributeName: 'endDate'
    };

    const columnsData = {
      action: 'dase_get_columns_ranking_transitions',
      attributeName: 'columns',
      title: __('Columns', 'dase'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'dase_get_columns_ranking_transitions',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'dase'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'dase_get_columns_ranking_transitions',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'dase'),
    };

    const paginationData = {
      action: 'dase_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'dase'),
    };

    return [
      <div className="dase-block-image">{__('Ranking Transitions', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={teamIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={rankingTypeIdDate} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={startDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('dase/ranking-transitions', {
  title: __('Ranking Transitions', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('ranking transitions', 'dase'),
    __('soccer', 'dase'),
    __('engine', 'dase'),
  ],
  attributes: {
    teamId: {
      type: 'string',
    },
    rankingTypeId: {
      type: 'string',
    },
    startDate: {
      type: 'string',
    },
    endDate: {
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