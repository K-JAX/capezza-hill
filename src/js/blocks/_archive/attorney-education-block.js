// Attorney bio block
/**
 * Pseudo-code for writing the most basic block structure (from wordpress writing first block type tutorial)
 */

// import module from wordpress blocks library. we'll need registerBlockType for any block
const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;

// include any style in an object for your block if you want before calling the main component function




// call registerBlockType to start your block code
registerBlockType( 'ch-block/attorney-education', {

    // set whatever attributes are needed
    // title
    title: 'Attorney Education Info',
    // icon
    icon: 'id',
    // category
    category: 'attorney-blocks',
    // [additional needed attributes]
    attributes: {
        title: {
            type: 'string',
            source: 'meta',
            meta: 'attorney_education_title',
        },
        content: {
            type: 'string',
            source: 'meta',
            meta: 'attorney_education',
        }
    },

    // create edit function including whatever props are needed
    edit( {setAttributes, attributes}){

        function updateTitle(title) { {
            setAttributes( {title} );
        }}
        function updateBlockValue(content) { {
            setAttributes( {content} );
        }}
        
        // return function
        return( 
            <div className='block-panel'>
                <h2 className="block-label">Education Details</h2>
                <RichText
                    tagName="h3"
                    onChange={ updateTitle }
                    value={ attributes.title }
                />
                <RichText
                    tagName="ul"
                    multiline="li"
                    onChange={ updateBlockValue }
                    value={attributes.content}
                />
            </div>
        )
    },
    // create save function including whatever props are needed
    save(){
    // return function
        return null
    }
})