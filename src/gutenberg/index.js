/* global wp */
const {__} = wp.i18n;
const {render} = wp.element;
import ParseCss from "./utils/css/ParseCss";
import {updateCategory} from '@wordpress/blocks';

window.usgrDevice = 'lg';

//Impost post grid block
import "./blocks";

const allCustomBlocks = ['usgr/user-grid'];
// Save Style CSS within Database/File
window.bindCss = false;
wp.data.subscribe(() => {
    try {
        const {getBlockOrder, getBlock} = wp.data.select('core/block-editor');
        const blockIds = getBlockOrder();
        const blocks = blockIds.map((blockId) => getBlock(blockId))
        const ourBlocks = blocks.filter(item => allCustomBlocks.includes(item.name));
        const _wp$data$select = wp.data.select("core/editor");
        if (!_wp$data$select || 0 == ourBlocks.length) {
            return;
        }
        const isSavingPost = _wp$data$select.isSavingPost;
        const isAutoSavingPost = _wp$data$select.isAutosavingPost;

        if (isSavingPost() && !isAutoSavingPost()) {
            ParseCss();
        }
    } catch (err) {
        console.error(err);
    }
});


//UPDATE BLOCK CATEGORY ICON
updateCategory("usgr", {
    icon: (
        <img
            src={usgrParams.plugin_url + "/assets/images/block-cat.svg"}
            alt={__("User Grid")}
        />
    ),
});

document.addEventListener('DOMContentLoaded', function() {
    jQuery('body').on('click', '.usgr-users-block-wrapper a', function (e){
       e.preventDefault();
    })
});
