// Attorney bio block
/**
 * Pseudo-code for writing the most basic block structure (from wordpress writing first block type tutorial)
 */

// import module from wordpress blocks library. we'll need registerBlockType for any block
const { registerBlockType } = wp.blocks;
import { TextControl, FormFileUpload } from '@wordpress/components';


const BLOCKS_TEMPLATE = [
    [ 'core/paragraph', { label: 'email', placeholder: "email details" } ],
    [ 'core/columns', { columns: 2 }, [
        ['core/column', {}, [
        ['core/paragraph']
    ]],
        ['core/column', {}, [
        ['core/file']
    ]],
    ]]
];

// include any style in an object for your block if you want before calling the main component function




// call registerBlockType to start your block code
registerBlockType( 'ch-block/attorney-contact', {

    // set whatever attributes are needed
    // title
    title: 'Attorney Contact',
    // icon
    icon: 'id',
    // category
    category: 'attorney-blocks',
    // [additional needed attributes]
    attributes: {
        email: {
            type: 'string',
            source: 'meta',
            meta: 'attorney_contact_email',
        },
        phone: {
            type: 'string',
            source: 'meta',
            meta: 'attorney_contact_phone_number',
        },
        vCard: {
            type: 'string',
            source: 'meta',
            meta: 'attorney_contact_vcard',
        },
    },

    // create edit function including whatever props are needed
    edit( {setAttributes}){
        
        // return function
        return( 
            <div className='block-panel'> 
                <h2 className="block-label">Contact Details</h2>
                <TextControl
                    className=""
                    placeholder="john@email.com"
                    // value={attributes.email}
                    onChange={ function( value ) { setAttributes( {email: value } ) } }
                />
                <TextControl
                    className="half"
                    placeholder="###-###-####"
                    // value={attributes.phone}
                    onChange={ function( value ) { setAttributes( {phone: value } ) } }
                />
                {/* <FormFileUpload
                    accept=".pdf"
                    className="half"
                >
                    Upload
                </FormFileUpload> */}
            </div> 
        )
    },
    // create save function including whatever props are needed
    save(){
    // return function
        return null
    }
})