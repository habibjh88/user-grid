import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("gtusers/tpg-category-block", {
    title: __("Category Block", "gutenberg-users"),
    category: "gtusers",
    description: "The post grid block, Grid layout",
    icon: <img src={gtusersParams.plugin_url + "/assets/images/gutenberg/category-block.svg"} alt={__("Grid Layout")} />,
    example: {
        attributes: {
            preview: true
        },
    },
    supports: {
        align: ['center', 'wide', 'full']
    },
    keywords: [
        __("post grid"),
        __("the post grid"),
        __("category block"),
        __("category"),
        __("the post"),
        __("the"),
        __("grid"),
        __("post"),
    ],
    save: () => null,
    edit: Edit
});