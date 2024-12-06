import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("usgr/user-grid", {
    title: __("User Grid", "user-grid"),
    category: "usgr",
    description: "Display WordPress Users anywhere",
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
        __("Users Grid"),
        __("user-grid"),
        __("users"),
    ],
    save: () => null,
    edit: Edit
});