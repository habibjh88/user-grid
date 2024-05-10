import {
    PanelBody,
} from '@wordpress/components';
import Color from "../../../components/Color";
import Dimension from "../../../components/Dimension";
import RangeDevice from "../../../components/RangeDevice";

const {__} = wp.i18n

function SocialShareSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        icon_font_size,
        social_spacing,
        social_color,
        social_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Social Share', 'user-grid')} initialOpen={false}>

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
