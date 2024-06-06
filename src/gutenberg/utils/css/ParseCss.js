/* global wp, jQuery, ajaxurl */
import {CssGenerator} from './CssGenerator';

const {select} = wp.data;


const innerBlocks = function (blocks) {
    let type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    let __CSS = '';
    if (type === true) {
        __CSS = '';
        type = false;
    }
    blocks.map((row) => {
        const {attributes, name} = row;
        const [blockType, blockName] = name.split('/');
        if (blockType === 'dowp' && attributes.uniqueId) {
            __CSS += CssGenerator(attributes, blockName, attributes.uniqueId, true);
        }
        if (row.innerBlocks && row.innerBlocks.length > 0) {
            __CSS += innerBlocks(row.innerBlocks);
        }
    });
    return __CSS;
};

const isRtdowpBlock = (blocks) => {
    let hasBlock = false;
    blocks.forEach(function (block) {
        const {name, innerBlocks = []} = block;
        const [blockType, blockName] = name.split('/');
        if (blockType === 'dowp') {
            hasBlock = true;
        }
        if (!hasBlock && innerBlocks.length > 0) {
            hasBlock = isRtdowpBlock(innerBlocks);
        }
    });
    return hasBlock;
}

const getData = pId => {

    jQuery
        .ajax({
            url: ajaxurl,
            dataType: "json",
            type: "POST",
            data: {
                postId: pId,
                action: 'dowp_block_css_get_posts',
                nonce: dowpParams.nonce,
            }
        })
        .then(function (response) {

            if (response.success) {
                const innerBlock = innerBlocks(wp.blocks.parse(response.data), true);
                if (innerBlock.css) {

                    jQuery
                        .ajax({
                            url: ajaxurl,
                            dataType: "json",
                            type: "POST",
                            data: {
                                inner_css: innerBlock.css,
                                post_id: wp.data.select('core/editor').getCurrentPostId(),
                                action: 'dowp_block_css_appended'
                            }
                        })
                        .done(function (res) {
                            if (res.success) {
                                // Save Data
                            }
                        });
                }
            }
        });
};

const parseBlock = blocks => {
    blocks.forEach(function (block) {
        if (block.name.indexOf('core/block') !== -1) {
            getData(block.attributes.ref);
        }
        if (block.innerBlocks && block.innerBlocks.length > 0) {
            parseBlock(block.innerBlocks);
        }
    });
};

const ParseCss = (setDatabase = true) => {
    window.bindCss = true;
    const all_blocks = select('core/block-editor').getBlocks();
    const {getCurrentPostId} = select('core/editor');
    const hasRtdowpBlocks = isRtdowpBlock(all_blocks);
    const blockCss = innerBlocks(all_blocks, true);

    if (setDatabase) {
        parseBlock(all_blocks);
        jQuery
            .ajax({
                url: ajaxurl,
                dataType: "json",
                type: "POST",
                data: {
                    nonce: dowpParams.nonce,
                    block_css: blockCss,
                    post_id: getCurrentPostId,
                    has_block: hasRtdowpBlocks,
                    action: 'dowp_block_css_save'
                }
            });
    }
    setTimeout(function () {
        window.bindCss = false;
    }, 900);
};

export default ParseCss;