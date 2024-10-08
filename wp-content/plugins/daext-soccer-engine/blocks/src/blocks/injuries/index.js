const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericReactSelect from '../../components/GenericReactSelect';
import MultiReactSelect from '../../components/MultiReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.playerId === 'undefined'){
      this.props.setAttributes({playerId: "0"});
    }
    if(typeof this.props.attributes.injuryTypeId === 'undefined'){
      this.props.setAttributes({injuryTypeId: "0"});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['player', 'age', 'citizenship', 'injury_type', 'start_date', 'end_date']});
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

    const playerIdData = {
      action: 'dase_get_player_list',
      attributeName: 'playerId',
      title: __('Player', 'dase'),
    };

    const injuryTypeIdData = {
      action: 'dase_get_injury_type_list',
      attributeName: 'injuryTypeId',
      title: __('Injury Type', 'dase'),
    };

    const columnsData = {
      action: 'dase_get_columns_injuries',
      attributeName: 'columns',
      title: __('Columns', 'dase'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'dase_get_columns_injuries',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'dase'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'dase_get_columns_injuries',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'dase'),
    };

    const paginationData = {
      action: 'dase_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'dase'),
    };

    return [
      <div className="dase-block-image">{__('Injuries', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={playerIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={injuryTypeIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('dase/injuries', {
  title: __('Injuries', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('injuries', 'dase'),
    __('players', 'dase'),
    __('soccer', 'dase'),
  ],
  attributes: {
    playerId: {
      type: 'string',
    },
    injuryTypeId: {
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
