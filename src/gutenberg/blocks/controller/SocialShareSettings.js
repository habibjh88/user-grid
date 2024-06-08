import {__} from "@wordpress/i18n";
import {__experimentalNumberControl as NumberControl, PanelBody, SelectControl} from '@wordpress/components';
import {Dimension, Color} from "../../components/Components";
import {SOCIAL_POSITION, SOCIAL_STYLE} from "../../components/Constants";
import {isPlain} from "@wordpress/blocks/build/api/raw-handling/utils";

function SocialShareSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        hasPro,
        social_style,
        social_position,
        icon_font_size,
        social_spacing,
        social_color,
        social_color_hover,
        social_bg,
        social_bg_hover,
        social_border_color,
        social_border_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Social Share', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__("Icon Style", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={social_style}
                options={SOCIAL_STYLE}
                onChange={(social_style) => {
                    setAttributes({social_style})
                    changeQuery()
                }}
            />

            <SelectControl
                label={__("Icon Position", "user-grid")}
                className={`dowp-control-field label-inline dowp-expand ${hasPro ? '' : 'pro-field'}`}
                disable={true}
                value={social_position}
                options={SOCIAL_POSITION(hasPro)}
                onChange={(social_position) => {
                    setAttributes({social_position})
                    changeQuery()
                }}
            />

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
                className="dowp-control-field label-inline"
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={social_spacing}
                onChange={(value) => {
                    setAttributes({social_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={social_color}
                onChange={(social_color) => setAttributes({social_color})}
            />

            <Color
                label={__('Color - Hover', 'user-grid')}
                color={social_color_hover}
                onChange={(social_color_hover) => setAttributes({social_color_hover})}
            />

            <Color
                label={__('Background', 'user-grid')}
                color={social_bg}
                onChange={(social_bg) => setAttributes({social_bg})}
            />

            <Color
                label={__('Background - Hover', 'user-grid')}
                color={social_bg_hover}
                onChange={(social_bg_hover) => setAttributes({social_bg_hover})}
            />

            <Color
                label={__('Border Color', 'user-grid')}
                color={social_border_color}
                onChange={(social_border_color) => setAttributes({social_border_color})}
            />

            <Color
                label={__('Border - Hover', 'user-grid')}
                color={social_border_color_hover}
                onChange={(social_border_color_hover) => setAttributes({social_border_color_hover})}
            />

        </PanelBody>
    );
}

export default SocialShareSettings;
