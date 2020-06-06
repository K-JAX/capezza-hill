// Attorney bio block
/**
 * Pseudo-code for writing the most basic block structure (from wordpress writing first block type tutorial)
 */

// import module from wordpress blocks library. we'll need registerBlockType for any block
const {registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.editor;
import './attorney-contact-block';



const BLOCKS_TEMPLATE = [
    [ 'core/heading', { placeholder: "Attorney's Display Title" } ],
    [ 'ch-block/attorney-contact', {}],
    [ 'core/paragraph', { placeholder: 'more bio stuff to come' } ],
];

// include any style in an object for your block if you want before calling the main component function
const blockStyle = {
    'backgroundColor': '#dfdfdf', 
}



// call registerBlockType to start your block code
registerBlockType( 'ch-block/attorney-bio', {

    // set whatever attributes are needed
    // title
    title: 'Attorney Bio',
    // icon
    icon: 'id',
    // category
    category: 'layout',
    // [additional needed attributes]


    // create edit function including whatever props are needed
    edit(){
        // return function
        return <InnerBlocks template={BLOCKS_TEMPLATE} />
    },
    // create save function including whatever props are needed
    save(){
        // return function
        return <InnerBlocks.Content />
    }
})