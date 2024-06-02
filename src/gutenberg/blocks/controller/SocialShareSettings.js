import {__} from "@wordpress/i18n";
import {PanelBody, SelectControl} from '@wordpress/components';
import {Dimension, RangeDevice, Color} from "../../components/Components";
import {SOCIAL_STYLE} from "../../components/Constants";

function SocialShareSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        social_style,
        icon_font_size,
        social_spacing,
        social_color,
        social_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Social Share', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__("Button Style", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={social_style}
                options={SOCIAL_STYLE}
                onChange={(social_style) => {
                    setAttributes({social_style})
                    changeQuery()
                }}
            />
            <RangeDevice
                label={__('Icon Size')}
                responsive={true}
                value={icon_font_size}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({icon_font_size: val})}
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

        </PanelBody>
    );
}

export default SocialShareSettings;
