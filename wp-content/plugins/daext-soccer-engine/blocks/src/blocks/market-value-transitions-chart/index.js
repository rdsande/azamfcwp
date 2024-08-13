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
    if(typeof this.props.attributes.playerId1 === 'undefined'){
      this.props.setAttributes({playerId1: '0'});
    }
    if(typeof this.props.attributes.playerId2 === 'undefined'){
      this.props.setAttributes({playerId2: '0'});
    }
    if(typeof this.props.attributes.playerId3 === 'undefined'){
      this.props.setAttributes({playerId3: '0'});
    }
    if(typeof this.props.attributes.playerId4 === 'undefined'){
      this.props.setAttributes({playerId4: '0'});
    }
    if(typeof this.props.attributes.startDate === 'undefined'){
      this.props.setAttributes({startDate: '1900-01-01'});
    }
    if(typeof this.props.attributes.endDate === 'undefined'){
      this.props.setAttributes({endDate: '2100-01-01'});
    }

  }

  render() {

    const playerId1Data = {
      action: 'dase_get_player_list',
      attributeName: 'playerId1',
      title: __('Player 1', 'dase'),
      actionParameters: '&default_label=1'
    };

    const playerId2Data = {
      action: 'dase_get_player_list',
      attributeName: 'playerId2',
      title: __('Player 2', 'dase'),
      actionParameters: '&default_label=1'
    };

    const playerId3Data = {
      action: 'dase_get_player_list',
      attributeName: 'playerId3',
      title: __('Player 3', 'dase'),
      actionParameters: '&default_label=1'
    };

    const playerId4Data = {
      action: 'dase_get_player_list',
      attributeName: 'playerId4',
      title: __('Player 4', 'dase'),
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
      <div className="dase-block-image">{__('Market Value Transitions Chart', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={playerId1Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={playerId2Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={playerId3Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={playerId4Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={startDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('dase/market-value-transitions-chart', {
  title: __('Market Value Transitions Chart', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('market value transitions chart', 'dase'),
    __('soccer', 'dase'),
    __('engine', 'dase'),
  ],
  attributes: {
    playerId1: {
      type: 'string',
    },
    playerId2: {
      type: 'string',
    },
    playerId3: {
      type: 'string',
    },
    playerId4: {
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