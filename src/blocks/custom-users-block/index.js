import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("gtusers/custom-users-block", {
    title: __("Custom Users Block", "gutenberg-users"),
    category: "gtusers",
    description: "Custom Users Block",
    icon: <img src={gtusersParams.plugin_url + "/assets/images/gutenberg/category-block.svg"} alt={__("Custom Users Block")} />,
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