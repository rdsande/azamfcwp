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
    if(typeof this.props.attributes.competitionId === 'undefined'){
      this.props.setAttributes({competitionId: '0'});
    }
    if(typeof this.props.attributes.round === 'undefined'){
      this.props.setAttributes({round: '1'});
    }
    if(typeof this.props.attributes.type === 'undefined'){
      this.props.setAttributes({type: '0'});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['date', 'time', 'team_1', 'result', 'team_2']});
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

    const competitionIdData = {
      action: 'dase_get_competition_list',
      attributeName: 'competitionId',
      title: __('Competition', 'dase'),
      actionParameters: '&default_label=1'
    };

    const roundData = {
      action: 'dase_get_round_list',
      attributeName: 'round',
      title: __('Round', 'dase'),
      actionParameters: '&default_label=1'
    };

    const typeData = {
      action: 'dase_get_type_list',
      attributeName: 'type',
      title: __('Type', 'dase'),
      actionParameters: '&default_label=1'
    };

    const columnsData = {
      action: 'dase_get_columns_competition_round',
      attributeName: 'columns',
      title: __('Columns', 'dase'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'dase_get_columns_competition_round',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'dase'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'dase_get_columns_competition_round',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'dase'),
    };

    const paginationData = {
      action: 'dase_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'dase'),
    };

    return [
      <div className="dase-block-image">{__('Competition Round', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={competitionIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={roundData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={typeData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('dase/competition-round', {
  title: __('Competition Round', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('competition round', 'dase'),
    __('soccer', 'dase'),
    __('engine', 'dase'),
  ],
  attributes: {
    competitionId: {
      type: 'string',
    },
    round: {
      type: 'string',
    },
    type: {
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
