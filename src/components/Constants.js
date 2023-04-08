import icons from "./icon/icons";
import {Icon} from '@wordpress/components';
import renderControlIcons from './icon/renderControlIcons'

const {__} = wp.i18n;

const img_path = gtusersParams.plugin_url + '/assets/images';
export const CATEGORY_PREVIEW = <img src={`${img_path}/preview/user-preview.png`} alt={__('User Preview')}/>;

export const BACKGROUND_TYPE = [
    {label: __("Classic", "guten-blocks"), value: "classic"},
    {label: __("Gradient", "guten-blocks"), value: "gradient"}
];

export const BACKGROUND_POSITION = [
    {label: __("Default", "guten-blocks"), value: ""},
    {label: __("Left Top", "guten-blocks"), value: "left top"},
    {label: __("Left Center", "guten-blocks"), value: "left center"},
    {label: __("Left Bottom", "guten-blocks"), value: "left bottom"},
    {label: __("Right Top", "guten-blocks"), value: "right top"},
    {label: __("Right Center", "guten-blocks"), value: "right center"},
    {label: __("Right Bottom", "guten-blocks"), value: "right bottom"},
    {label: __("Center Top", "guten-blocks"), value: "center top"},
    {label: __("Center Center", "guten-blocks"), value: "center center"},
    {label: __("Center Bottom", "guten-blocks"), value: "center bottom"}
];

export const BACKGROUND_SIZE = [
    {label: __("Default", "guten-blocks"), value: ""},
    {label: __("Auto", "guten-blocks"), value: "auto"},
    {label: __("Cover", "guten-blocks"), value: "cover"},
    {label: __("Contain", "guten-blocks"), value: "contain"}
];

export const BACKGROUND_REPEAT = [
    {label: __("Default", "guten-blocks"), value: ""},
    {label: __("No Repeat", "guten-blocks"), value: "no-repeat"},
    {label: __("Repeat", "guten-blocks"), value: "repeat"},
    {label: __("Repeat X", "guten-blocks"), value: "repeat-x"},
    {label: __("Repeat Y", "guten-blocks"), value: "repeat-y"}
];

export const BACKGROUND_ATTACHMENT = [
    {label: __("Default", "guten-blocks"), value: ""},
    {label: __("Scroll", "guten-blocks"), value: "scroll"},
    {label: __("Fixed", "guten-blocks"), value: "fixed"}
];

export const TEXT_TRANSFORM = [
    {label: __("None", "guten-blocks"), value: "none"},
    {label: __("Lowercase", "guten-blocks"), value: "lowercase"},
    {label: __("Capitalize", "guten-blocks"), value: "capitalize"},
    {label: __("Uppercase", "guten-blocks"), value: "uppercase"}
];

export const FONT_WEIGHTS = [
    {label: __("Default", "guten-blocks"), value: "default"},
    {label: __("Light", "guten-blocks"), value: "300"},
    {label: __("Normal", "guten-blocks"), value: "400"},
    {label: __("Medium", "guten-blocks"), value: "500"},
    {label: __("Semi Bold", "guten-blocks"), value: "600"},
    {label: __("Bold", "guten-blocks"), value: "700"},
    {label: __("Extra Bold", "guten-blocks"), value: "800"},
    {label: __("Heavy Bold", "guten-blocks"), value: "900"}
];

export const HEADING = [
    {label: __("H1", "guten-blocks"), value: "h1"},
    {label: __("H2", "guten-blocks"), value: "h2"},
    {label: __("H3", "guten-blocks"), value: "h3"},
    {label: __("H4", "guten-blocks"), value: "h4"},
    {label: __("H5", "guten-blocks"), value: "h5"},
    {label: __("H6", "guten-blocks"), value: "h6"}
];

export const COL_OPTIONS = [
    {value: 0, label: __('Default', 'gutenberg-users')},
    {value: 1, label: __('1 Col', 'gutenberg-users')},
    {value: 2, label: __('2 Col', 'gutenberg-users')},
    {value: 3, label: __('3 Col', 'gutenberg-users')},
    {value: 4, label: __('4 Col', 'gutenberg-users')},
    {value: 5, label: __('5 Col', 'gutenberg-users')},
    {value: 6, label: __('6 Col', 'gutenberg-users')}
];

export const COL_OPTIONS_GRID = [
    {value: 0, label: __('Default', 'gutenberg-users')},
    {value: 12, label: __('1 Col', 'gutenberg-users')},
    {value: 6, label: __('2 Col', 'gutenberg-users')},
    {value: 4, label: __('3 Col', 'gutenberg-users')},
    {value: 3, label: __('4 Col', 'gutenberg-users')},
    {value: 24, label: __('5 Col', 'gutenberg-users')},
    {value: 2, label: __('6 Col', 'gutenberg-users')}
];

export const USER_ORDER_BY = [
    {value: '', label: __('-Select-', 'gutenberg-users')},
    {value: 'ID', label: __('ID', 'gutenberg-users')},
    {value: 'display_name', label: __('Display Name', 'gutenberg-users')},
    {value: 'include', label: __('Include', 'gutenberg-users')},
    {value: 'user_login', label: __('User Login', 'gutenberg-users')},
    {value: 'user_nicename', label: __('User Nicename', 'gutenberg-users')},
    {value: 'user_email', label: __('User Email', 'gutenberg-users')},
    {value: 'post_count', label: __('Post Count', 'gutenberg-users')},
];

export const POST_SORT_ORDER = [
    {value: 'DESC', label: __('DESC', 'gutenberg-users')},
    {value: 'ASC', label: __('ASC', 'gutenberg-users')}
];

export const FORMATE_USERS = users => {
    if (! users) {
        return;
    }
    return users.map((user) => ({
        value: user.id,
        label: __(user.name, 'gutenberg-users')
    }));
}

export const NORMAL_HOVER = [
    {label: "Normal", value: "normal"},
    {label: "Hover", value: "hover"}
];
export const GTUSERS_COLOR_PALATE = [
    {name: 'Color 1', color: '#72aee6'},
    {name: 'Color 2', color: '#0074FF'},
    {name: 'Color 3', color: '#15D38E'},
    {name: 'Color 4', color: '#00D4FF'},
    {name: 'Color 5', color: '#FF2D00'},
    {name: 'Color 6', color: '#AE2D00'},
    {name: 'Color 7', color: '#000000'},
    {name: 'Color 8', color: '#AAAAAA'},
    {name: 'Color 9', color: '#FFFFFF'},
];