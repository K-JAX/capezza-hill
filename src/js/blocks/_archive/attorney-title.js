// Attorney bio block
/**
 * Pseudo-code for writing the most basic block structure (from wordpress writing first block type tutorial)
 */

// import module from wordpress blocks library. we'll need registerBlockType for any block
const {registerBlockType} = wp.blocks;
import { TextControl } from '@wordpress/components';


// call registerBlockType to start your block code
registerBlockType( 'ch-block/attorney-title', {

    // set whatever attributes are needed
    // title
    title: 'Attorney Title',
    // icon
    icon: 'businessman',
    // category
    category: 'attorney-blocks',
    // [additional needed attributes]
    attributes: {
        blockValue: {
            type: 'string',
            source: 'meta',
            meta: 'attorney_title_block_field',
        },
    },

    // create edit function including whatever props are needed
    edit( { setAttributes, attributes } ){

        function updateBlockValue(blockValue) { {
            setAttributes( {blockValue} );
        }

        }
        
        // return function
        return (
            <div className='block-panel'>
                <h2 className="block-label">Attorney Display Title</h2>
                <TextControl 
                    className="big"
                    placeholder="Fill in title"
                    value={ attributes.blockValue }
                    onChange={ updateBlockValue }
                />
            </div>
        )
    },
    // create save function including whatever props are needed
    save(){
    // return function
        return null;
    }
})