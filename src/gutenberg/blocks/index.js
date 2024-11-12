import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("usgr/user-grid", {
    title: __("Custom Users Block", "user-grid"),
    category: "usgr",
    description: "Custom Users Block",
    icon: <img src={usgrParams.plugin_url + "/assets/images/icon.svg"} alt={__("Custom Users Block")} />,
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
        __("user-grid"),
        __("users"),
    ],
    save: () => null,
    edit: Edit
});