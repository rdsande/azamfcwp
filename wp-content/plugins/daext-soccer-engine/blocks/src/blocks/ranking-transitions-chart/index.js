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
    if(typeof this.props.attributes.teamId1 === 'undefined'){
      this.props.setAttributes({teamId1: '0'});
    }
    if(typeof this.props.attributes.teamId2 === 'undefined'){
      this.props.setAttributes({teamId2: '0'});
    }
    if(typeof this.props.attributes.teamId3 === 'undefined'){
      this.props.setAttributes({teamId3: '0'});
    }
    if(typeof this.props.attributes.teamId4 === 'undefined'){
      this.props.setAttributes({teamId4: '0'});
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

  }

  render() {

    const teamId1Data = {
      action: 'dase_get_team_list',
      attributeName: 'teamId1',
      title: __('Team 1', 'dase'),
      actionParameters: '&default_label=1'
    };

    const teamId2Data = {
      action: 'dase_get_team_list',
      attributeName: 'teamId2',
      title: __('Team 2', 'dase'),
      actionParameters: '&default_label=1'
    };

    const teamId3Data = {
      action: 'dase_get_team_list',
      attributeName: 'teamId3',
      title: __('Team 3', 'dase'),
      actionParameters: '&default_label=1'
    };

    const teamId4Data = {
      action: 'dase_get_team_list',
      attributeName: 'teamId4',
      title: __('Team 4', 'dase'),
      actionParameters: '&default_label=1'
    };

    const rankingTypeIdData = {
      action: 'dase_get_ranking_type_list',
      attributeName: 'rankingTypeId',
      title: __('Ranking Type', 'dase'),
      actionParameters: '&default_label=1'
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

    return [
      <div className="dase-block-image">{__('Ranking Transitions Chart', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={teamId1Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamId2Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamId3Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamId4Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={rankingTypeIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={startDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('dase/ranking-transitions-chart', {
  title: __('Ranking Transitions Chart', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('ranking transitions chart', 'dase'),
    __('soccer', 'dase'),
    __('engine', 'dase'),
  ],
  attributes: {
    teamId1: {
      type: 'string',
    },
    teamId2: {
      type: 'string',
    },
    teamId3: {
      type: 'string',
    },
    teamId4: {
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