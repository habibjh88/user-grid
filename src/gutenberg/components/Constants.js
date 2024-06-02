import icons from "./icon/icons";

const {__} = wp.i18n;

const img_path = dowpParams.plugin_url + '/assets/images';
export const CATEGORY_PREVIEW = <img src={`${img_path}/preview/user-preview.png`} alt={__('User Preview')}/>;

export const BACKGROUND_TYPE = [
    {label: __("Classic", "user-grid"), value: "classic"},
    {label: __("Gradient", "user-grid"), value: "gradient"}
];

export const GRID_LAYOUT_OPT = [
    {value: 'grid', icon: icons.layout1, label: __('Grid Layout')},
    {value: 'list', icon: icons.layout2, label: __('List Layout')},
];

export const BACKGROUND_POSITION = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("Left Top", "user-grid"), value: "left top"},
    {label: __("Left Center", "user-grid"), value: "left center"},
    {label: __("Left Bottom", "user-grid"), value: "left bottom"},
    {label: __("Right Top", "user-grid"), value: "right top"},
    {label: __("Right Center", "user-grid"), value: "right center"},
    {label: __("Right Bottom", "user-grid"), value: "right bottom"},
    {label: __("Center Top", "user-grid"), value: "center top"},
    {label: __("Center Center", "user-grid"), value: "center center"},
    {label: __("Center Bottom", "user-grid"), value: "center bottom"}
];

export const BACKGROUND_SIZE = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("Auto", "user-grid"), value: "auto"},
    {label: __("Cover", "user-grid"), value: "cover"},
    {label: __("Contain", "user-grid"), value: "contain"}
];

export const BACKGROUND_REPEAT = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("No Repeat", "user-grid"), value: "no-repeat"},
    {label: __("Repeat", "user-grid"), value: "repeat"},
    {label: __("Repeat X", "user-grid"), value: "repeat-x"},
    {label: __("Repeat Y", "user-grid"), value: "repeat-y"}
];

export const BACKGROUND_ATTACHMENT = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("Scroll", "user-grid"), value: "scroll"},
    {label: __("Fixed", "user-grid"), value: "fixed"}
];

export const TEXT_TRANSFORM = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("None", "user-grid"), value: "none"},
    {label: __("Lowercase", "user-grid"), value: "lowercase"},
    {label: __("Capitalize", "user-grid"), value: "capitalize"},
    {label: __("Uppercase", "user-grid"), value: "uppercase"}
];
export const TEXT_DECORATION = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("None", "user-grid"), value: "none"},
    {label: __("Underline", "user-grid"), value: "underline"},
    {label: __("Overline", "user-grid"), value: "overline"},
    {label: __("Line Through", "user-grid"), value: "line-through"},
    {label: __("Underline Overline", "user-grid"), value: "underline overline"}
];

export const FONT_WEIGHTS = [
    {label: __("Default", "user-grid"), value: ""},
    {label: __("Light", "user-grid"), value: "300"},
    {label: __("Normal", "user-grid"), value: "400"},
    {label: __("Medium", "user-grid"), value: "500"},
    {label: __("Semi Bold", "user-grid"), value: "600"},
    {label: __("Bold", "user-grid"), value: "700"},
    {label: __("Extra Bold", "user-grid"), value: "800"},
    {label: __("Heavy Bold", "user-grid"), value: "900"}
];

export const HEADING = [
    {label: __("H1", "user-grid"), value: "h1"},
    {label: __("H2", "user-grid"), value: "h2"},
    {label: __("H3", "user-grid"), value: "h3"},
    {label: __("H4", "user-grid"), value: "h4"},
    {label: __("H5", "user-grid"), value: "h5"},
    {label: __("H6", "user-grid"), value: "h6"}
];

export const COL_OPTIONS = [
    {value: 0, label: __('Default', 'user-grid')},
    {value: 1, label: __('1 Col', 'user-grid')},
    {value: 2, label: __('2 Col', 'user-grid')},
    {value: 3, label: __('3 Col', 'user-grid')},
    {value: 4, label: __('4 Col', 'user-grid')},
    {value: 5, label: __('5 Col', 'user-grid')},
    {value: 6, label: __('6 Col', 'user-grid')}
];

export const COL_OPTIONS_GRID = [
    {value: 0, label: __('Default', 'user-grid')},
    {value: 12, label: __('1 Col', 'user-grid')},
    {value: 6, label: __('2 Col', 'user-grid')},
    {value: 4, label: __('3 Col', 'user-grid')},
    {value: 3, label: __('4 Col', 'user-grid')},
    {value: 24, label: __('5 Col', 'user-grid')},
    {value: 2, label: __('6 Col', 'user-grid')}
];

export const USER_ORDER_BY = [
    {value: '', label: __('-Select-', 'user-grid')},
    {value: 'ID', label: __('ID', 'user-grid')},
    {value: 'display_name', label: __('Display Name', 'user-grid')},
    {value: 'include', label: __('Include', 'user-grid')},
    {value: 'user_login', label: __('User Login', 'user-grid')},
    {value: 'user_nicename', label: __('User Nicename', 'user-grid')},
    {value: 'user_email', label: __('User Email', 'user-grid')},
    {value: 'post_count', label: __('Post Count', 'user-grid')},
];

export const POST_SORT_ORDER = [
    {value: 'ASC', label: __('ASC', 'user-grid')},
    {value: 'DESC', label: __('DESC', 'user-grid')}
];

export const BUTTON_STYLE = [
    {value: 'btn-default', label: __('Default', 'user-grid')},
    {value: 'btn-dark', label: __('Dark Button', 'user-grid')},
    {value: 'btn-light', label: __('Light Button', 'user-grid')},
    {value: 'btn-primary', label: __('Primary Button', 'user-grid')},
];

export const SOCIAL_STYLE = [
    {value: 'social-default', label: __('Default', 'user-grid')},
    {value: 'social-border-square', label: __('Border Square', 'user-grid')},
    {value: 'social-border-round', label: __('Border Round', 'user-grid')},
    {value: 'social-bg-square', label: __('Background Square', 'user-grid')},
    {value: 'social-bg-round', label: __('Background Round', 'user-grid')},
];

export const FORMATE_USERS = (data, field) => {
    if (!data) {
        return;
    }
    return data.map((user) => ({
        value: user.id,
        label: user.name + (field ? " - " + user[field] : ''),
    }));
}

export const NORMAL_HOVER = [
    {label: "Normal", value: "normal"},
    {label: "Hover", value: "hover"}
];
export const UserGrid_COLOR_PALATE = [
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