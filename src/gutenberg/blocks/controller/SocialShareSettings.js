import {__} from "@wordpress/i18n";
import {__experimentalNumberControl as NumberControl, Button, PanelBody, SelectControl} from '@wordpress/components';
import {Dimension, Color} from "../../components/Components";

const {useState} = wp.element;
import {SOCIAL_POSITION, SOCIAL_STYLE, NORMAL_HOVER} from "../../components/Constants";

function SocialShareSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    const [styleTab, setStyleTab] = useState('normal');
    //All attribute
    const {
        hasPro, social_style, social_position, social_show_on, icon_font_size, social_spacing, social_color, social_color_hover, social_bg, social_bg_hover, social_border_color, social_border_color_hover, social_share_bg, social_share_bg_hover,
    } = attributes;

    return (<PanelBody title={__('Social Share', 'user-grid')} initialOpen={false}>

        <SelectControl
            label={__("Icon Style", "user-grid")}
            className="usgr-control-field label-inline usgr-expand"
            value={social_style}
            options={SOCIAL_STYLE}
            onChange={(social_style) => {
                setAttributes({social_style})
                changeQuery()
            }}
        />

        <SelectControl
            label={__("Icon Position", "user-grid")}
            className={`usgr-control-field label-inline usgr-expand ${hasPro ? '' : 'pro-field'}`}
            value={social_position}
            options={SOCIAL_POSITION(hasPro)}
            onChange={(social_position) => {
                setAttributes({social_position})
                changeQuery()
            }}
        />

        {social_position !== 'spos-d' && <SelectControl
            label={__("Icon Visibility", "user-grid")}
            className={`usgr-control-field label-inline usgr-expand`}
            value={social_show_on}
            options={[{value: '', label: __('Show on Hover', 'user-grid')}, {value: 'social-show-always', label: __('Always Show', 'user-grid')}, {value: 'social-show-always hide-share', label: __('Always Show except Share Icon', 'user-grid')},]}
            onChange={(social_show_on) => {
                setAttributes({social_show_on})
                changeQuery()
            }}
        />}

        <NumberControl
            isShiftStepEnabled
            label={__("Font Size", "user-grid")}
            min={5}
            max={100}
            value={icon_font_size}
            onChange={(icon_font_size) => {
                setAttributes({icon_font_size})
            }}
            placeholder={__("Eg. 10", "user-grid")}
            shiftStep={4}
            step="1"
            className="usgr-control-field label-inline"
        />

        <Dimension
            label={__("Spacing", "user-grid")}
            type="margin" responsive
            value={social_spacing}
            onChange={(value) => {
                setAttributes({social_spacing: value})
            }}
        />

        <div className="usgr-btn-hover-group">
            {NORMAL_HOVER.map((item, key) => (<Button
                key={key}
                isPrimary={styleTab === item.value}
                isSecondary={styleTab !== item.value}
                onClick={() => setStyleTab(item.value)}
            >
                {item.label}
            </Button>))}
        </div>

        {styleTab === 'normal' && <>
            <Color
                label={__('Color', 'user-grid')}
                color={social_color}
                onChange={(social_color) => setAttributes({social_color})}
            />
            {social_style !== 'social-default' &&
                <>
                    <Color
                        label={__('Background', 'user-grid')}
                        color={social_bg}
                        onChange={(social_bg) => setAttributes({social_bg})}
                    />

                    <Color
                        label={__('Border Color', 'user-grid')}
                        color={social_border_color}
                        onChange={(social_border_color) => setAttributes({social_border_color})}
                    />

                    <hr/>

                    <Color
                        label={__('Share Icon Bg', 'user-grid')}
                        color={social_share_bg}
                        onChange={(social_share_bg) => setAttributes({social_share_bg})}
                    />
                </>
            }
        </>}

        {styleTab === 'hover' && <>
            <Color
                label={__('Color : Hover', 'user-grid')}
                color={social_color_hover}
                onChange={(social_color_hover) => setAttributes({social_color_hover})}
            />
            {social_style !== 'social-default' &&
                <>
                    <Color
                        label={__('Background : Hover', 'user-grid')}
                        color={social_bg_hover}
                        onChange={(social_bg_hover) => setAttributes({social_bg_hover})}
                    />

                    <Color
                        label={__('Border Color : Hover', 'user-grid')}
                        color={social_border_color_hover}
                        onChange={(social_border_color_hover) => setAttributes({social_border_color_hover})}
                    />

                    <hr/>

                    <Color
                        label={__('Share Icon Bg : Hover', 'user-grid')}
                        color={social_share_bg_hover}
                        onChange={(social_share_bg_hover) => setAttributes({social_share_bg_hover})}
                    />
                </>
            }
        </>}

    </PanelBody>);
}

export default SocialShareSettings;
