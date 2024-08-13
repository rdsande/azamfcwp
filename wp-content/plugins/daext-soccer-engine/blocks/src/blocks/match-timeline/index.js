const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericReactSelect from '../../components/GenericReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.matchId === 'undefined'){
      this.props.setAttributes({matchId: '0'});
    }
    if(typeof this.props.attributes.matchEffect === 'undefined'){
      this.props.setAttributes({matchEffect: '0'});
    }

  }

  render() {

    const matchIdData = {
      action: 'dase_get_match_list',
      attributeName: 'matchId',
      title: __('Match', 'dase'),
      actionParameters: '&default_label=1'
    };

    const matchEffectData = {
      action: 'dase_get_match_effect_list',
      attributeName: 'matchEffect',
      title: __('Match Effect', 'dase'),
    };

    return [
      <div className="dase-block-image">{__('Match Timeline', 'dase')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={matchIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={matchEffectData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('dase/match-timeline', {
  title: __('Match Timeline', 'dase'),
  icon: BallIcon,
  category: 'dase-soccer-engine',
  keywords: [
    __('match timeline', 'dase'),
    __('soccer', 'dase'),
    __('engine', 'dase'),
  ],
  attributes: {
    matchId: {
      type: 'string',
    },
    matchEffect: {
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
