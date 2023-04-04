import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("rgbcode/custom-users-block", {
    title: __("Custom Users Block", "the-post-grid"),
    category: "rgbcode",
    description: "Custom Users Block",
    icon: <img src={rttpgParams.plugin_url + "/assets/images/gutenberg/category-block.svg"} alt={__("Custom Users Block")} />,
    example: {
        attributes: {
            preview: true
        },
    },
    supports: {
        align: ['center', 'wide', 'full']
    },
    keywords: [
        __("Custom Users Block"),
        __("custom-users-block"),
        __("users"),
    ],
    save: () => null,
    edit: Edit
});