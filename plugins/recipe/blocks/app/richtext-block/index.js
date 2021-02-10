import block_icons from '../icons/index';

/**
 * 1. Import Neccessary Components
 * 2. Define the attributes
 * 3. Load the components in the edit()
 * 4. Render the block
 */

const { registerBlockType }         =   wp.blocks;
const { RichText }                  =   wp.editor;
const { __ }                        =   wp.i18n;

registerBlockType( 'prince/rich-text', {
    title:                              __( 'Rich Text Example', 'recipe' ),
    description:                        __( 'Rich text example', 'recipe' ),
    category:                           'common',
    icon:                               block_icons.wapuu,
    attributes: {
        message: {
            type:                       'array',
            source:                     'children',
            selector:                   '.message-ctr'
        }

    },
    edit: ( props ) => {
        return (
            <div className={ props.className }>
                <h3>Rich Text Example Block</h3>
                <RichText tagName="div"
                          multiline="p"
                          placeholder={ __( 'Add your content here', 'recipe' ) }
                          onChange={ ( new_val ) => {
                              props.setAttributes({ message: new_val })
                          } }
                          value={ props.attributes.message }

                />
            </div>
        );
    },
    save: ( props ) => {
        return (
            <div>
                <h3>Rich Text Example Demo</h3>
                <div className="message-ctr">{ props.attributes.message }</div>
            </div>
        );
    }
});