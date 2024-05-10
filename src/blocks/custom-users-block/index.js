import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("dowp/custom-users-block", {
    title: __("Custom Users Block", "user-grid"),
    category: "dowp",
    description: "Custom Users Block",
    icon: <img src={dowpParams.plugin_url + "/assets/images/icon.svg"} alt={__("Custom Users Block")} />,
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